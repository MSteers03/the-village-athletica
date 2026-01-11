@extends('layouts.app')

@section('title', 'Timetable - The Village Athletica')

@section('content')
<!-- Hero Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-gradient-to-br from-village-brown to-red-900 text-white py-20 mb-16">
    <div class="max-w-4xl mx-auto px-8 text-center">
        <h1 class="text-6xl font-bold mb-6">Class Timetable</h1>
        <p class="text-xl text-red-100 leading-relaxed">Find your perfect training time</p>
    </div>
</div>

<!-- Intro Section -->
<div class="max-w-4xl mx-auto mb-16 px-4">
    <div class="text-center space-y-4 text-lg text-gray-700 leading-relaxed">
        <p>Our professionally coached classes are designed to help you achieve your fitness goals, no matter your experience level.</p>
        <p class="font-bold text-village-brown">All classes include expert coaching, personalized attention, and an incredible community atmosphere.</p>
    </div>
</div>

<!-- Timetable Table -->
<div class="max-w-7xl mx-auto mb-16 overflow-x-auto px-4">
    <div class="px-4">
        <table class="w-full bg-white shadow-2xl rounded-2xl overflow-hidden">
        <!-- Table Header - Days of Week -->
        <thead>
            <tr class="bg-gradient-to-r from-village-grey to-gray-200">
                <th class="py-5 px-4 text-left font-bold text-gray-800 border-r-2 border-white text-lg">TIME</th>
                <th class="py-5 px-4 text-center font-bold text-gray-800 border-r-2 border-white text-lg">MONDAY</th>
                <th class="py-5 px-4 text-center font-bold text-gray-800 border-r-2 border-white text-lg">TUESDAY</th>
                <th class="py-5 px-4 text-center font-bold text-gray-800 border-r-2 border-white text-lg">WEDNESDAY</th>
                <th class="py-5 px-4 text-center font-bold text-gray-800 border-r-2 border-white text-lg">THURSDAY</th>
                <th class="py-5 px-4 text-center font-bold text-gray-800 border-r-2 border-white text-lg">FRIDAY</th>
                <th class="py-5 px-4 text-center font-bold text-gray-800 text-lg">SATURDAY</th>
            </tr>
        </thead>
        <tbody>
            <!-- 5:30 AM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">5:30 AM</td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center bg-white">
                    <span class="text-gray-400">—</span>
                </td>
            </tr>

            <!-- 6:00 AM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">6:00 AM</td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center bg-white">
                    <span class="text-gray-400">—</span>
                </td>
            </tr>

            <!-- 7:00 AM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">7:00 AM</td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">BARBELL CLUB / GYMNASTICS</div>
                </td>
            </tr>

            <!-- 8:00 AM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">8:00 AM</td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
            </tr>

            <!-- 9:00 AM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">9:00 AM</td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center bg-whtiey border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-grey to-gray-200 text-village-brown font-bold py-3 px-3 rounded-lg text-sm shadow-sm hover:shadow-md transition-shadow">HIRT</div>
                </td>
                <td class="py-4 px-3 text-center bg-white border-r-2 border-white">
                    <span class="text-gray-400">—</span>
                </td>
                <td class="py-4 px-3 text-center bg-white">
                    <span class="text-gray-400">—</span>
                </td>
            </tr>

            <!-- 9:30 AM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">9:30 AM</td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center bg-white">
                    <span class="text-gray-400">—</span>
                </td>
            </tr>

            <!-- 4:30 PM -->
            <tr class="border-b-2 border-village-grey">
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">4:30 PM</td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center bg-white">
                    <span class="text-gray-400">—</span>
                </td>
            </tr>

            <!-- 5:30 PM -->
            <tr>
                <td class="py-4 px-3 font-semibold text-gray-700 bg-village-grey border-r-2 border-white whitespace-nowrap">5:30 PM</td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center border-r-2 border-white">
                    <div class="bg-gradient-to-br from-village-brown to-red-800 text-white font-bold py-3 px-3 rounded-lg text-xs shadow-md hover:shadow-lg transition-all hover:scale-105">FUNCTIONAL FITNESS</div>
                </td>
                <td class="py-4 px-3 text-center bg-white">
                    <span class="text-gray-400">—</span>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>

<!-- Legend -->
<div class="max-w-7xl mx-auto mb-20 px-4">
    <div class="bg-gradient-to-br from-white to-village-grey p-8 rounded-2xl shadow-xl">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Class Types</h3>
        <div class="flex flex-wrap justify-center gap-8">
            <div class="flex items-center bg-white px-6 py-3 rounded-xl shadow-md">
                <div class="w-8 h-8 bg-gradient-to-br from-village-grey to-gray-200 rounded-lg mr-3"></div>
                <span class="font-bold text-gray-700">HIRT <span class="text-sm text-gray-500">(30 min)</span></span>
            </div>
            <div class="flex items-center bg-white px-6 py-3 rounded-xl shadow-md">
                <div class="w-8 h-8 bg-gradient-to-br from-village-brown to-red-800 rounded-lg mr-3"></div>
                <span class="font-bold text-gray-700">FUNCTIONAL FITNESS <span class="text-sm text-gray-500">(60 min)</span></span>
            </div>
        </div>
    </div>
</div>

<!-- Class Descriptions -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-village-grey py-20 mb-20">
    <div class="max-w-6xl mx-auto px-8">
        <h2 class="text-4xl font-bold text-center mb-4 text-gray-900">What To Expect</h2>
        <p class="text-center text-gray-600 mb-16 text-lg">Learn about our class types</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Functional Fitness -->
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-village-brown to-red-800 rounded-xl flex items-center justify-center mr-4">
                        <span class="text-2xl">💪</span>
                    </div>
                    <h3 class="text-2xl font-bold text-village-brown">FUNCTIONAL FITNESS</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">60-minute full-body workout focusing on functional movements that improve your everyday life. Suitable for all fitness levels.</p>
            </div>

            <!-- HIRT -->
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-village-brown to-red-800 rounded-xl flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-village-brown">⚡</span>
                    </div>
                    <h3 class="text-2xl font-bold text-village-brown">HIRT</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">High Intensity Resistance Training - A 30-minute workout combining strength and cardio for maximum results in minimum time.</p>
            </div>



            <!-- Barbell Club -->
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-village-brown to-red-800 rounded-xl flex items-center justify-center mr-4">
                        <span class="text-2xl">🏋️</span>
                    </div>
                    <h3 class="text-2xl font-bold text-village-brown">BARBELL CLUB</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">Specialized class focusing on Olympic lifting techniques and barbell movements to build strength and power.</p>
            </div>

            <!-- Gymnastics -->
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-village-brown to-red-800 rounded-xl flex items-center justify-center mr-4">
                        <span class="text-2xl">🤸</span>
                    </div>
                    <h3 class="text-2xl font-bold text-village-brown">GYMNASTICS</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">Work on body control, flexibility, and skills like handstands, muscle-ups, and more in this specialized session.</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="text-center py-20 max-w-4xl mx-auto px-4">
    <h2 class="text-5xl font-bold text-gray-900 mb-6">Ready to Start Training?</h2>
    <p class="text-2xl text-gray-600 mb-10 leading-relaxed">Join us for a class and experience The Village difference!</p>
    <a href="/contact" class="inline-block bg-gradient-to-r from-village-brown to-red-900 text-white px-12 py-5 rounded-2xl font-bold hover:from-red-900 hover:to-village-brown transition-all duration-300 text-xl shadow-2xl hover:shadow-3xl transform hover:scale-105">
        Contact Us Now →
    </a>
</div>
@endsection