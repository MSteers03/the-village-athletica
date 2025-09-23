<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Under Maintenance - The Village Athletica</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- <style>
        :root {
            --village-brown: #ad3925;
            --village-grey: #ece8e7;
        }
        .bg-village-brown { background-color: var(--village-brown); }
        .text-village-brown { color: var(--village-brown); }
        .bg-village-grey { background-color: var(--village-grey); }
    </style> -->
</head>
<body class="bg-village-grey min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-village-brown text-white p-6 text-center">
                <h1 class="text-2xl font-bold">🚧 Site Under Maintenance</h1>
                <p class="mt-2">We're working hard to improve your experience</p>
            </div>
            
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                <p class="text-gray-600 mb-6">
                    Our website is currently undergoing maintenance. We apologize for any inconvenience. 
                    Please leave your contact details below and we'll get back to you as soon as we're back online.
                </p>
                
                <form action="{{ route('maintenance.contact') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Full Name *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-village-brown">
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-village-brown">
                    </div>
                    
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-village-brown">
                    </div>
                    
                    <div class="mb-4">
                        <label for="query_type" class="block text-gray-700 font-medium mb-2">Query Type *</label>
                        <select id="query_type" name="query_type" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-village-brown">
                            <option value="">Please select...</option>
                            <option value="general">General Inquiry</option>
                            <option value="membership">Membership Information</option>
                            <option value="classes">Class Schedule</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-village-brown"
                                  placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-village-brown text-white py-3 px-4 rounded-md hover:bg-red-700 transition duration-200 font-medium">
                        Submit Inquiry
                    </button>
                </form>
            </div>
            
            <div class="bg-gray-100 px-6 py-4 text-center text-gray-600 text-sm">
                <p>&copy; {{ date('Y') }} The Village Athletica. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>