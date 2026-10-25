<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Health endpoints for uptime monitoring (Uptime Kuma).
 *
 * GET /health       Fast, public. Checks the app can render its pages and is
 *                   configured to deliver form emails. No outbound calls.
 * GET /health/deep  Token protected. Also checks Resend and reCAPTCHA accept
 *                   the site's keys, so a revoked key is caught before a
 *                   customer's enquiry is lost.
 *
 * Both return 200 with "status": "ok" when every check passes, and 503 with
 * "status": "fail" otherwise. Check details are only shown to token holders.
 */
class HealthController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return $this->respond($request, $this->localChecks());
    }

    public function deep(Request $request): JsonResponse
    {
        if (! $this->hasValidToken($request)) {
            abort(404);
        }

        return $this->respond($request, array_merge($this->localChecks(), [
            'resend' => $this->checkResend(),
            'recaptcha' => $this->checkRecaptcha(),
        ]));
    }

    private function localChecks(): array
    {
        return [
            'app_key' => $this->check(fn () => filled(config('app.key')), 'APP_KEY is not set'),
            'maintenance_mode' => $this->check(fn () => ! env('MAINTENANCE_MODE', false), 'MAINTENANCE_MODE is on, public pages return 503'),
            'cloudinary_config' => $this->check(
                fn () => filled(parse_url((string) config('cloudinary.cloud_url'), PHP_URL_HOST)),
                'CLOUDINARY_URL is not set, the home page video cannot render'
            ),
            'assets' => $this->checkAssets(),
            'views' => $this->checkViews(),
            'mail_config' => $this->checkMailConfig(),
            'recaptcha_config' => $this->check(
                fn () => filled(config('services.recaptcha.site_key')) && filled(config('services.recaptcha.secret_key')),
                'RECAPTCHA_SITE_KEY or RECAPTCHA_SECRET_KEY is not set, the contact form will reject every submission'
            ),
        ];
    }

    /**
     * A missing or stale Vite manifest leaves every page unstyled.
     */
    private function checkAssets(): array
    {
        return $this->check(function () {
            $manifestPath = public_path('build/manifest.json');
            if (! is_file($manifestPath)) {
                return 'public/build/manifest.json is missing';
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
            foreach (['resources/css/app.css', 'resources/js/app.js'] as $entry) {
                $file = $manifest[$entry]['file'] ?? null;
                if (! $file || ! is_file(public_path('build/'.$file))) {
                    return "Built asset for {$entry} is missing";
                }
            }

            return true;
        });
    }

    /**
     * Render each public page so a Blade error shows up here, not on the site.
     */
    private function checkViews(): array
    {
        return $this->check(function () {
            foreach (['home', 'pricing', 'timetable', 'contact'] as $view) {
                view($view)->render();
            }

            return true;
        });
    }

    /**
     * The "log" mailer is Laravel's default and silently drops every email.
     */
    private function checkMailConfig(): array
    {
        return $this->check(function () {
            if (config('mail.default') !== 'resend') {
                return 'MAIL_MAILER is "'.config('mail.default').'", form emails are not being sent';
            }
            if (blank($this->resendKey())) {
                return 'RESEND_API_KEY (or RESEND_KEY) is not set';
            }
            $from = (string) config('mail.from.address');
            if (! filter_var($from, FILTER_VALIDATE_EMAIL) || str_ends_with($from, '@example.com')) {
                return 'MAIL_FROM_ADDRESS is not set to a real address';
            }

            return true;
        });
    }

    /**
     * Confirm the API key is accepted and the sending domain is still verified.
     */
    private function checkResend(): array
    {
        return $this->check(function () {
            if (blank($this->resendKey())) {
                return 'RESEND_API_KEY (or RESEND_KEY) is not set';
            }

            $response = Http::withToken($this->resendKey())
                ->timeout(5)
                ->get('https://api.resend.com/domains');

            // A sending-only key can't list domains, but being told so proves
            // Resend recognises it.
            if ($response->status() === 401 && $response->json('name') === 'restricted_api_key') {
                return true;
            }
            if (! $response->successful()) {
                return 'Resend rejected the API key (HTTP '.$response->status().')';
            }

            $fromDomain = strtolower(substr(strrchr((string) config('mail.from.address'), '@'), 1));
            $domain = collect($response->json('data', []))->firstWhere('name', $fromDomain);
            if (! $domain) {
                return "Sending domain {$fromDomain} is not set up in Resend";
            }
            if (($domain['status'] ?? null) !== 'verified') {
                return "Sending domain {$fromDomain} is {$domain['status']} in Resend, not verified";
            }

            return true;
        });
    }

    /**
     * Verify a dummy token. Google rejects the token either way, but only says
     * "invalid-input-secret" when the secret key itself is wrong.
     */
    private function checkRecaptcha(): array
    {
        return $this->check(function () {
            $response = Http::asForm()->timeout(5)->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => 'uptime-health-check',
            ]);

            if (! $response->successful()) {
                return 'reCAPTCHA returned HTTP '.$response->status();
            }

            $errors = $response->json('error-codes', []);
            if (array_intersect($errors, ['invalid-input-secret', 'missing-input-secret'])) {
                return 'reCAPTCHA rejected the secret key';
            }

            return true;
        });
    }

    /**
     * Run a check that returns true on success, or false or a message on failure.
     */
    private function check(callable $callback, string $failureMessage = 'Check failed'): array
    {
        $started = microtime(true);

        try {
            $result = $callback();
        } catch (Throwable $e) {
            $result = class_basename($e).': '.$e->getMessage();
        }

        return [
            'ok' => $result === true,
            'message' => $result === true ? null : (is_string($result) ? $result : $failureMessage),
            'ms' => (int) round((microtime(true) - $started) * 1000),
        ];
    }

    private function respond(Request $request, array $checks): JsonResponse
    {
        $ok = collect($checks)->every(fn ($check) => $check['ok']);
        $showDetails = $this->hasValidToken($request);

        $body = [
            'status' => $ok ? 'ok' : 'fail',
            'checks' => collect($checks)->map(fn ($check) => $showDetails ? $check : $check['ok'])->all(),
            'commit' => $showDetails ? (substr((string) env('VERCEL_GIT_COMMIT_SHA', ''), 0, 7) ?: null) : null,
            'time' => now()->toIso8601String(),
        ];

        return response()
            ->json(array_filter($body, fn ($value) => $value !== null), $ok ? 200 : 503)
            ->header('Cache-Control', 'no-store')
            ->header('X-Robots-Tag', 'noindex');
    }

    private function hasValidToken(Request $request): bool
    {
        $expected = (string) config('services.health.token');
        $given = (string) ($request->bearerToken() ?? $request->header('X-Health-Token'));

        return $expected !== '' && $given !== '' && hash_equals($expected, $given);
    }

    private function resendKey(): ?string
    {
        // Same precedence as resend/resend-laravel's mail transport.
        return config('resend.api_key') ?: config('services.resend.key');
    }
}
