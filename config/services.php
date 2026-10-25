<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],

    // Self-hosted Umami analytics. The tracker is only rendered when both the
    // script URL and website ID are set, so local and test builds stay quiet.
    'umami' => [
        'script_url' => env('UMAMI_SCRIPT_URL'),
        'website_id' => env('UMAMI_WEBSITE_ID'),
        // Optional: where events are sent, if not the same host as the script.
        'host_url' => env('UMAMI_HOST_URL'),
        // Optional: comma-separated hostnames to track, e.g. "thevillageathletica.com.au".
        'domains' => env('UMAMI_DOMAINS'),
    ],

];
