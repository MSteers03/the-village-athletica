<!DOCTYPE html>
<html lang="en">
<head>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Village Athletica')</title>
    <link rel="icon" href="{{ asset('favicon-32x32.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-village-grey">
    <!-- Header -->
    <header class="bg-white text-village-brown shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold">The Village Athletica</div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/" class="hover:text-red-700 transition font-bold">Home</a></li>
                    <li><a href="/timetable" class="hover:text-red-700 transition font-bold">Timetable</a></li>
                    <li><a href="/pricing" class="hover:text-red-700 transition font-bold">Pricing</a></li>
                    <li><a href="/contact" class="hover:text-red-700 transition font-bold">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 pb-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-village-brown text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">The Village Athletica</h3>
                    <p>Your local fitness community dedicated to helping you achieve your goals.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-red-200 transition">Home</a></li>
                        <li><a href="/timetable" class="hover:text-red-200 transition">Timetable</a></li>
                        <li><a href="/pricing" class="hover:text-red-200 transition">Pricing</a></li>
                        <li><a href="/contact" class="hover:text-red-200 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Info</h3>
                    <p>84 Railway Parade</p>
                    <p>Midland, WA, 6056</p>
                    <p><a href="tel:0449523937">Phone: 0449 523 937</a></p>
                    <p><a href="mailto:info@thevillageathletica.com.au"> Email: info@thevillageathletica.com.au</a></p>
                </div>
            </div>
            <div class="border-t border-red-800 mt-8 pt-6 text-center">
                <p>&copy; {{ date('Y') }} The Village Athletica. All rights reserved.</p>
            </div>
        </div>
    </footer>
@stack('scripts')    
</body>
</html>