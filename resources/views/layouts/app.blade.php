<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Village Athletica')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add any additional CSS or fonts here -->
    @vite('resources/css/app.css')
</head>
<body class="font-sans bg-village-grey">
    <!-- Header -->
    <header class="bg-white text-village-brown shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold">The Village Athletica</div>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="/" class="hover:text-blue-200 transition font-bold">Home</a></li>
                    <li><a href="/timetable" class="hover:text-blue-200 transition font-bold">Timetable</a></li>
                    <li><a href="/pricing" class="hover:text-blue-200 transition font-bold">Pricing</a></li>
                    <li><a href="/contact" class="hover:text-blue-200 transition font-bold">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
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
                        <li><a href="/" class="hover:text-blue-300 transition">Home</a></li>
                        <li><a href="/timetable" class="hover:text-blue-300 transition">Timetable</a></li>
                        <li><a href="/pricing" class="hover:text-blue-300 transition">Pricing</a></li>
                        <li><a href="/contact" class="hover:text-blue-300 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Info</h3>
                    <p>123 Fitness Street</p>
                    <p>Healthville, HV 12345</p>
                    <p>Phone: (555) 123-4567</p>
                    <p>Email: info@villagegym.com</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p>&copy; {{ date('Y') }} The Village Athletica. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script type="module">
        import { injectSpeedInsights } from '@vercel/speed-insights';

        injectSpeedInsights();
    </script>
</body>
</html>