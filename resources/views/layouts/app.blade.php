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
    <footer class="bg-village-brown text-white">
        <div class="container mx-auto px-4 pt-12 pb-10">
            <div class="grid grid-cols-2 lg:grid-cols-12 gap-x-6 gap-y-10 lg:gap-8">
                <!-- Brand -->
                <div class="col-span-2 lg:col-span-4">
                    <div class="flex items-center gap-3">
                        <span class="flex-shrink-0 w-12 h-12 bg-white rounded-xl overflow-hidden flex items-center justify-center">
                            <img src="{{ asset('images/the-village-pillars-logo.png') }}" alt="" width="48" height="48" class="w-full h-full object-cover scale-[1.7]">
                        </span>
                        <p class="text-xl font-bold leading-tight">The Village Athletica</p>
                    </div>
                    <p class="mt-4 text-sm text-white/80 leading-relaxed max-w-xs">Your local fitness community dedicated to helping you achieve your goals.</p>
                    <a href="https://www.instagram.com/thevillageathletica" target="_blank" rel="noopener" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-white/90 hover:text-white transition">
                        <span class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center">
                            <svg aria-hidden="true" focusable="false" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </span>
                        Follow us on Instagram
                    </a>
                </div>

                <!-- Quick Links -->
                <div class="lg:col-span-2">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-white/70 mb-4">Quick Links</h2>
                    <nav aria-label="Footer">
                        <ul class="space-y-3 text-sm">
                            <li><a href="/" @if(request()->is('/')) aria-current="page" @endif class="text-white/90 hover:text-white hover:underline underline-offset-4 transition">Home</a></li>
                            <li><a href="/timetable" @if(request()->is('timetable')) aria-current="page" @endif class="text-white/90 hover:text-white hover:underline underline-offset-4 transition">Timetable</a></li>
                            <li><a href="/pricing" @if(request()->is('pricing')) aria-current="page" @endif class="text-white/90 hover:text-white hover:underline underline-offset-4 transition">Pricing</a></li>
                            <li><a href="/contact" @if(request()->is('contact')) aria-current="page" @endif class="text-white/90 hover:text-white hover:underline underline-offset-4 transition">Contact</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Contact Info (last on mobile so the two short columns sit side by side) -->
                <div class="col-span-2 order-last lg:order-none lg:col-span-3">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-white/70 mb-4">Contact Info</h2>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <svg aria-hidden="true" focusable="false" class="w-5 h-5 flex-shrink-0 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <a href="https://www.google.com/maps/search/?api=1&amp;query=84+Railway+Parade+Midland+WA+6056" target="_blank" rel="noopener" class="text-white/90 hover:text-white hover:underline underline-offset-4 transition">84 Railway Parade<br>Midland WA 6056</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg aria-hidden="true" focusable="false" class="w-5 h-5 flex-shrink-0 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:0449523937" class="text-white/90 hover:text-white hover:underline underline-offset-4 transition">0449 523 937</a>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg aria-hidden="true" focusable="false" class="w-5 h-5 flex-shrink-0 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:info@thevillageathletica.com.au" class="text-white/90 hover:text-white hover:underline underline-offset-4 transition break-all">info@thevillageathletica.com.au</a>
                        </li>
                    </ul>
                </div>

                <!-- Opening Hours (keep in sync with the contact page) -->
                <div class="lg:col-span-3">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-white/70 mb-4">Opening Hours</h2>
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="font-semibold">Monday to Friday</dt>
                            <dd class="text-white/80">5:30 AM to 10:30 AM<br>4:30 PM to 6:30 PM</dd>
                        </div>
                        <div>
                            <dt class="font-semibold">Saturday</dt>
                            <dd class="text-white/80">7:00 AM to 9:00 AM</dd>
                        </div>
                        <div>
                            <dt class="font-semibold">Sunday</dt>
                            <dd class="text-white/80">Closed</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-black/20">
            <div class="container mx-auto px-4 py-4 text-center text-xs text-white/70">
                <p>&copy; {{ date('Y') }} The Village Athletica. All rights reserved.</p>
            </div>
        </div>
    </footer>
@stack('scripts')    
</body>
</html>