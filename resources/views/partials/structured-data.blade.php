@php
    $siteUrl = config('seo.url');
    $business = config('seo.business');

    $graph = [
        [
            '@type' => 'ExerciseGym',
            '@id' => $siteUrl . '/#gym',
            'name' => $business['name'],
            'url' => $siteUrl . '/',
            'description' => config('seo.default_description'),
            'image' => $seoImage,
            'telephone' => $business['telephone'],
            'email' => $business['email'],
            'priceRange' => $business['price_range'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $business['street_address'],
                'addressLocality' => $business['locality'],
                'addressRegion' => $business['region'],
                'postalCode' => $business['postal_code'],
                'addressCountry' => $business['country'],
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $business['latitude'],
                'longitude' => $business['longitude'],
            ],
            'hasMap' => $business['map_url'],
            'areaServed' => ['Midland', 'Perth'],
            'sameAs' => $business['same_as'],
        ],
        [
            '@type' => 'WebSite',
            '@id' => $siteUrl . '/#website',
            'url' => $siteUrl . '/',
            'name' => config('seo.site_name'),
            'inLanguage' => 'en-AU',
            'publisher' => ['@id' => $siteUrl . '/#gym'],
        ],
    ];

    // Breadcrumb trail for inner pages, e.g. Home > Pricing.
    if (request()->path() !== '/' && isset($breadcrumb)) {
        $graph[] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteUrl . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $breadcrumb, 'item' => $seoCanonical],
            ],
        ];
    }

    $graph = array_map(fn ($node) => array_filter($node, fn ($value) => $value !== []), $graph);

    // "@" . "context" stops Blade compiling the key as its @context directive.
    $structuredData = json_encode(
        ['@' . 'context' => 'https://schema.org', '@graph' => $graph],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_PRETTY_PRINT
    );
@endphp
<script type="application/ld+json">
{!! $structuredData !!}
</script>
