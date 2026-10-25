<?php

use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config([
        'mail.default' => 'resend',
        'mail.from.address' => 'info@thevillageathletica.com.au',
        'services.resend.key' => 're_test',
        'services.recaptcha.site_key' => 'site',
        'services.recaptcha.secret_key' => 'secret',
        'services.health.token' => 'kuma-token',
    ]);
});

it('reports ok without details to the public', function () {
    $this->getJson('/health')
        ->assertOk()
        ->assertJsonPath('status', 'ok')
        ->assertJsonPath('checks.views', true)
        ->assertHeader('Cache-Control', 'no-store, private');
});

it('fails when form emails would be dropped', function () {
    config(['mail.default' => 'log']);

    $this->getJson('/health', ['Authorization' => 'Bearer kuma-token'])
        ->assertStatus(503)
        ->assertJsonPath('status', 'fail')
        ->assertJsonPath('checks.mail_config.ok', false)
        ->assertJsonPath('checks.mail_config.message', 'MAIL_MAILER is "log", form emails are not being sent');
});

it('hides the deep check without a valid token', function () {
    $this->getJson('/health/deep')->assertNotFound();
    $this->getJson('/health/deep', ['Authorization' => 'Bearer wrong'])->assertNotFound();

    config(['services.health.token' => null]);
    $this->getJson('/health/deep', ['Authorization' => 'Bearer '])->assertNotFound();
});

it('passes the deep check when Resend and reCAPTCHA accept the keys', function () {
    Http::fake([
        'api.resend.com/*' => Http::response(['data' => [['name' => 'thevillageathletica.com.au', 'status' => 'verified']]]),
        'www.google.com/recaptcha/*' => Http::response(['success' => false, 'error-codes' => ['invalid-input-response']]),
    ]);

    $this->getJson('/health/deep', ['Authorization' => 'Bearer kuma-token'])
        ->assertOk()
        ->assertJsonPath('checks.resend.ok', true)
        ->assertJsonPath('checks.recaptcha.ok', true);
});

it('accepts a sending-only Resend key', function () {
    Http::fake([
        'api.resend.com/*' => Http::response(['name' => 'restricted_api_key'], 401),
        'www.google.com/recaptcha/*' => Http::response(['success' => false, 'error-codes' => ['invalid-input-response']]),
    ]);

    $this->getJson('/health/deep', ['X-Health-Token' => 'kuma-token'])
        ->assertOk()
        ->assertJsonPath('checks.resend.ok', true);
});

it('fails the deep check when a key is revoked or the domain unverified', function () {
    Http::fake([
        'api.resend.com/*' => Http::response(['data' => [['name' => 'thevillageathletica.com.au', 'status' => 'failed']]]),
        'www.google.com/recaptcha/*' => Http::response(['success' => false, 'error-codes' => ['invalid-input-secret']]),
    ]);

    $this->getJson('/health/deep', ['Authorization' => 'Bearer kuma-token'])
        ->assertStatus(503)
        ->assertJsonPath('checks.resend.message', 'Sending domain thevillageathletica.com.au is failed in Resend, not verified')
        ->assertJsonPath('checks.recaptcha.message', 'reCAPTCHA rejected the secret key');
});

it('reports maintenance mode', function () {
    putenv('MAINTENANCE_MODE=true');

    try {
        $this->getJson('/health')->assertStatus(503)->assertJsonPath('checks.maintenance_mode', false);
    } finally {
        putenv('MAINTENANCE_MODE');
    }
});
