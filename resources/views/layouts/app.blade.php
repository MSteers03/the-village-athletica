<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoTitle = html_entity_decode(trim($__env->yieldContent('title', config('seo.site_name'))), ENT_QUOTES);
        $seoDescription = html_entity_decode(trim($__env->yieldContent('meta_description', config('seo.default_description'))), ENT_QUOTES);
        $seoCanonical = config('seo.url') . (request()->path() === '/' ? '/' : '/' . request()->path());
        $seoImage = config('seo.url') . '/' . config('seo.share_image.path');
        // Keep test/preview hostnames (e.g. village.steersfam.com) out of search results.
        // The www. variant counts as the live site in case Vercel serves both.
        $seoIsCanonicalHost = preg_replace('/^www\./', '', request()->getHost()) === preg_replace('/^www\./', '', parse_url(config('seo.url'), PHP_URL_HOST));
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoIsCanonicalHost ? trim($__env->yieldContent('robots', 'index, follow, max-image-preview:large')) : 'noindex, nofollow' }}">
    <link rel="canonical" href="{{ $seoCanonical }}">
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}">
    <meta name="google-site-verification" content="VYg7uGfxroJc3ALMhSe3_OcnGkH9TlOvFvbYTrVzoaw" />

    <!-- Open Graph / social sharing -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('seo.site_name') }}">
    <meta property="og:locale" content="{{ config('seo.locale') }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:image:width" content="{{ config('seo.share_image.width') }}">
    <meta property="og:image:height" content="{{ config('seo.share_image.height') }}">
    <meta property="og:image:alt" content="{{ config('seo.site_name') }} logo">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    <link rel="preconnect" href="https://res.cloudinary.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400..700&display=swap">

    @include('partials.structured-data', ['breadcrumb' => trim($__env->yieldContent('breadcrumb')) ?: null])
    @stack('structured-data')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q0ZF6X4CSB"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-Q0ZF6X4CSB');
    </script>
</head>
<body class="font-sans bg-village-grey">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[60] focus:bg-white focus:text-village-brown focus:px-4 focus:py-2 focus:rounded focus:shadow-lg font-bold">Skip to main content</a>

    <!-- Header with Mobile Menu -->
    <header class="bg-white text-village-brown shadow-lg sticky top-0 z-50" x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="text-xl md:text-2xl font-bold">
                    The Village<br class="md:hidden"> Athletica
                </div>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:block" aria-label="Main">
                    <ul class="flex space-x-6">
                        <li><a href="/" @if(request()->is('/')) aria-current="page" @endif class="hover:text-red-700 transition font-bold">Home</a></li>
                        <li><a href="/timetable" @if(request()->is('timetable')) aria-current="page" @endif class="hover:text-red-700 transition font-bold">Timetable</a></li>
                        <li><a href="/pricing" @if(request()->is('pricing')) aria-current="page" @endif class="hover:text-red-700 transition font-bold">Pricing</a></li>
                        <li><a href="/contact" @if(request()->is('contact')) aria-current="page" @endif class="hover:text-red-700 transition font-bold">Contact</a></li>
                    </ul>
                </nav>

                <!-- Mobile Menu Button -->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" :aria-expanded="mobileMenuOpen.toString()" aria-expanded="false" aria-controls="mobile-menu" aria-label="Menu" class="md:hidden p-2">
                    <svg x-show="!mobileMenuOpen" aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <nav id="mobile-menu"
                 aria-label="Mobile"
                 x-show="mobileMenuOpen"
                 x-cloak
                 x-transition
                 class="md:hidden mt-4 pb-4">
                <ul class="space-y-2">
                    <li><a href="/" @if(request()->is('/')) aria-current="page" @endif class="block py-2 hover:text-red-700 transition font-bold">Home</a></li>
                    <li><a href="/timetable" @if(request()->is('timetable')) aria-current="page" @endif class="block py-2 hover:text-red-700 transition font-bold">Timetable</a></li>
                    <li><a href="/pricing" @if(request()->is('pricing')) aria-current="page" @endif class="block py-2 hover:text-red-700 transition font-bold">Pricing</a></li>
                    <li><a href="/contact" @if(request()->is('contact')) aria-current="page" @endif class="block py-2 hover:text-red-700 transition font-bold">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content" tabindex="-1" class="container mx-auto px-4 focus:outline-none">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-village-brown text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h2 class="text-xl font-bold mb-4">The Village Athletica</h2>
                    <p class="text-sm">Your local fitness community dedicated to helping you achieve your goals.</p>
                </div>
                <div>
                    <h2 class="text-xl font-bold mb-4">Quick Links</h2>
                    <nav aria-label="Footer">
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" @if(request()->is('/')) aria-current="page" @endif class="hover:text-red-200 transition">Home</a></li>
                        <li><a href="/timetable" @if(request()->is('timetable')) aria-current="page" @endif class="hover:text-red-200 transition">Timetable</a></li>
                        <li><a href="/pricing" @if(request()->is('pricing')) aria-current="page" @endif class="hover:text-red-200 transition">Pricing</a></li>
                        <li><a href="/contact" @if(request()->is('contact')) aria-current="page" @endif class="hover:text-red-200 transition">Contact</a></li>
                    </ul>
                    </nav>
                </div>
                <div>
                    <h2 class="text-xl font-bold mb-4">Contact Info</h2>
                    <p class="text-sm">84 Railway Parade</p>
                    <p class="text-sm">Midland, WA, 6056</p>
                    <p class="text-sm"><a href="tel:0449523937" class="hover:text-red-200">0449 523 937</a></p>
                    <p class="text-sm break-all"><a href="mailto:info@thevillageathletica.com.au" class="hover:text-red-200">info@thevillageathletica.com.au</a></p>
                </div>
            </div>
            <div class="border-t border-red-800 mt-8 pt-6 text-center">
                <p class="text-sm">&copy; {{ date('Y') }} The Village Athletica. All rights reserved.</p>
            </div>
        </div>
    </footer>
@stack('scripts')    
</body>
</html>