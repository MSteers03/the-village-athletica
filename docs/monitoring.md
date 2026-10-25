# Uptime monitoring

The site exposes three endpoints for Uptime Kuma (or any uptime checker).
All of them sit outside the maintenance-mode middleware and send
`Cache-Control: no-store`, so every check reaches PHP on Vercel.

| Endpoint | Auth | What it proves |
| --- | --- | --- |
| `GET /up` | none | Laravel booted (Laravel's built-in health route). |
| `GET /health` | none | The app is healthy and correctly configured. No outbound calls, ~50 ms. |
| `GET /health/deep` | token | Everything in `/health`, plus Resend and reCAPTCHA accept the site's keys. |

Each returns `200` with `"status": "ok"` when every check passes, and `503`
with `"status": "fail"` when any check fails.

## Checks

| Check | Fails when |
| --- | --- |
| `app_key` | `APP_KEY` is missing (every request would error). |
| `maintenance_mode` | `MAINTENANCE_MODE` is on, so public pages return 503. |
| `cloudinary_config` | `CLOUDINARY_URL` is missing, so the home page video (and the home page) breaks. |
| `assets` | The Vite build manifest or the built CSS/JS is missing, so pages are unstyled. |
| `views` | The home, pricing, timetable or contact page throws while rendering. |
| `mail_config` | `MAIL_MAILER` isn't `resend` (e.g. `log` silently drops form emails), the Resend key is missing, or `MAIL_FROM_ADDRESS` isn't real. |
| `recaptcha_config` | Either reCAPTCHA key is missing, so the contact form rejects every submission. |
| `resend` (deep) | Resend rejects the API key, or the sending domain is no longer verified. |
| `recaptcha` (deep) | Google rejects the reCAPTCHA secret key. |

The public response only shows `true`/`false` per check. Send the token to
see the failure message and timing for each check, plus the deployed commit:

```json
{
  "status": "fail",
  "checks": {
    "mail_config": { "ok": false, "message": "MAIL_MAILER is \"log\", form emails are not being sent", "ms": 0 }
  },
  "commit": "952a087",
  "time": "2026-10-25T14:00:00+08:00"
}
```

## Setup

1. Generate a token, e.g. `openssl rand -hex 32`.
2. Add it in Vercel as `HEALTH_CHECK_TOKEN` (Production, Sensitive) and redeploy.
   Without it, `/health/deep` returns 404.
3. Send it from Uptime Kuma as a header, either
   `{"Authorization": "Bearer <token>"}` or `{"X-Health-Token": "<token>"}`.
   It is not accepted in the query string, so it never ends up in access logs.

## Recommended Uptime Kuma monitors

| # | Name | Type | URL / target | Settings |
| --- | --- | --- | --- | --- |
| 1 | Site health | HTTP(s) - Json Query | `https://thevillageathletica.com.au/health` | Json query `status`, expected value `ok`. Headers with the token (for messages in the alert). Interval 60 s, retries 2. |
| 2 | Form email + reCAPTCHA | HTTP(s) - Json Query | `https://thevillageathletica.com.au/health/deep` | Json query `status`, expected `ok`. Token header. Interval 300 s, retries 1. |
| 3 | Home page | HTTP(s) - Keyword | `https://thevillageathletica.com.au/` | Keyword `84 Railway Parade` (footer, so the whole page rendered). Interval 60 s, retries 2. Turn on certificate expiry notification. |
| 4 | Pricing page | HTTP(s) - Keyword | `/pricing` | Keyword `Gym Membership Pricing`. Interval 300 s. |
| 5 | Timetable page | HTTP(s) - Keyword | `/timetable` | Keyword `Class Timetable`. Interval 300 s. |
| 6 | Contact page | HTTP(s) - Keyword | `/contact` | Keyword `recaptcha/api.js`. Interval 300 s. |
| 7 | www redirect | HTTP(s) | `https://www.thevillageathletica.com.au/` | Max redirects 0, accepted status codes `300-399`. Interval 600 s. Catches a broken www domain in Vercel. |
| 8 | DNS | DNS | `thevillageathletica.com.au` | Record type A (or CNAME), resolver `1.1.1.1`. Interval 600 s. |
| 9 | Umami | HTTP(s) | `https://stats.steersfam.com/api/heartbeat` | Interval 300 s. Analytics only, so a lower-priority notification is fine. |

Notes:

- Monitors 1 to 6 go through Vercel's edge, so they also cover domain, TLS
  and routing problems, not just the app.
- The site runs as a Vercel serverless function, so the first request after
  idle can take a couple of seconds. Keep the request timeout at 20 s or more
  and use retries rather than alerting on a single slow response.
- `/health/deep` makes one call each to Resend and Google, so keep it at
  five minutes or slower. That is about 290 calls a day to each, well inside
  both services' limits.
- Turning maintenance mode on makes monitors 1 and 3 to 6 go down. Pause them
  in Uptime Kuma (or use a maintenance window) while it's on on purpose.
- Put every monitor in an Uptime Kuma status page group if you want a single
  view to share with the gym.
