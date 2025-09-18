@extends('layouts.app')

@section('title', 'Pricing - The Village Athletica')

@section('content')
<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-blue-800 mb-4">Join the Village</h1>
    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Choose the plan that works best for your fitness journey. All plans include access to our premium equipment and basic amenities.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Basic Plan -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
        <div class="bg-blue-600 text-white py-4 px-6">
            <h2 class="text-2xl font-bold">Basic</h2>
            <p class="text-blue-100">Perfect for casual gym-goers</p>
        </div>
        <div class="p-6">
            <p class="text-4xl font-bold text-gray-800 mb-4">$29<span class="text-lg text-gray-600">/month</span></p>
            <ul class="space-y-3 mb-6">
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Access to cardio equipment
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Free weights area
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Locker room access
                </li>
                <li class="flex items-center text-gray-400">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Group classes
                </li>
            </ul>
            <button class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Select Plan</button>
        </div>
    </div>

    <!-- Pro Plan -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-blue-600 transition-transform duration-300 hover:scale-105">
        <div class="bg-blue-800 text-white py-4 px-6">
            <h2 class="text-2xl font-bold">Pro</h2>
            <p class="text-blue-200">Our most popular plan</p>
        </div>
        <div class="p-6">
            <p class="text-4xl font-bold text-gray-800 mb-4">$49<span class="text-lg text-gray-600">/month</span></p>
            <ul class="space-y-3 mb-6">
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    All Basic features
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Unlimited group classes
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Free fitness assessment
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Towel service
                </li>
            </ul>
            <button class="w-full bg-blue-800 text-white py-2 rounded-md hover:bg-blue-900 transition">Select Plan</button>
        </div>
    </div>

    <!-- Premium Plan -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
        <div class="bg-blue-600 text-white py-4 px-6">
            <h2 class="text-2xl font-bold">Premium</h2>
            <p class="text-blue-100">For the serious fitness enthusiast</p>
        </div>
        <div class="p-6">
            <p class="text-4xl font-bold text-gray-800 mb-4">$79<span class="text-lg text-gray-600">/month</span></p>
            <ul class="space-y-3 mb-6">
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    All Pro features
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    24/7 access
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Personal trainer discount
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Bring a guest twice per month
                </li>
            </ul>
            <button class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Select Plan</button>
        </div>
    </div>
</div>
@endsection