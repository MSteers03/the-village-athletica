<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Canonical Site URL
    |--------------------------------------------------------------------------
    |
    | The public domain search engines should index. Canonical links, Open
    | Graph URLs and structured data are built from this value so that other
    | hostnames serving the same app don't compete with it in search results.
    |
    */

    'url' => rtrim(env('SEO_SITE_URL', 'https://thevillageathletica.com.au'), '/'),

    'site_name' => 'The Village Athletica',

    'locale' => 'en_AU',

    'default_description' => 'The Village Athletica is a functional fitness gym in Midland, WA, offering coached classes, HIRT and personal training. No lock-in contracts or joining fee.',

    // Images in public/: the wordmark is shown when a page is shared on social
    // media, the square pillars mark is the logo Google shows for the business.
    'share_image' => [
        'path' => 'images/the-village-logo.png',
        'width' => 2000,
        'height' => 1201,
    ],
    'logo' => 'images/the-village-pillars-logo.png',

    'business' => [
        'name' => 'The Village Athletica',
        'telephone' => '+61449523937',
        'email' => 'info@thevillageathletica.com.au',
        'street_address' => '84 Railway Parade',
        'locality' => 'Midland',
        'region' => 'WA',
        'postal_code' => '6056',
        'country' => 'AU',
        'latitude' => -31.891692,
        'longitude' => 116.002956,
        'map_url' => 'https://maps.app.goo.gl/N52BHhFjw1nVDZjv6',
        'price_range' => '$$',
        'area_served' => [
            'Midland', 'Swan View', 'Guildford', 'Bellevue', 'Midvale', 'Woodbridge',
            'Viveash', 'Stratton', 'Jane Brook', 'Koongamia', 'Greenmount', 'Helena Valley',
            'Hazelmere', 'South Guildford', 'Middle Swan', 'Perth',
        ],
        // Public profile URLs (Instagram, Facebook, ...) for structured data.
        'same_as' => [],
    ],

];
