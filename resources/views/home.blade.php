@extends('layouts.app')

@section('title', 'The Village Athletica')

@section('content')
<!-- Hero Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen overflow-hidden text-white py-16 md:py-32 mb-8 md:mb-16">
    <!-- Background Video -->
    <video 
        autoplay 
        muted 
        loop 
        playsinline
        preload="metadata"
        class="absolute inset-0 w-full h-full object-cover object-center"
    >
        <source src="{{ config('filesystems.disks.r2.url') }}/Monday_Madness.mov" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <!-- Dark Overlay for readability -->
    <div class="absolute inset-0 bg-black/60 z-[1]"></div>
    
    <!-- Optional: Gradient overlay for extra style -->
    <div class="absolute inset-0 bg-gradient-to-br from-village-brown/40 to-transparent z-[2]"></div>
    
    <!-- Content (positioned above video) -->
    <div class="relative z-10 max-w-6xl mx-auto px-4 md:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-4 md:mb-6 leading-tight drop-shadow-2xl">
            STOP EXERCISING<br>START TRAINING!
        </h1>
        <p class="text-lg md:text-xl lg:text-2xl text-gray-100 leading-relaxed max-w-3xl mx-auto drop-shadow-lg">
            It's not motivation, it's dedication.
        </p>
    </div>
</div>

<!-- About Section -->
<div class="max-w-7xl mx-auto mb-24 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Left Column - Text -->
        <div class="text-center lg:text-left">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Want To Get Fit?</h2>
            <h3 class="text-3xl font-bold text-village-brown mb-8">Join The Fittest Gym In Midland</h3>
            
            <p class="text-lg text-gray-700 leading-relaxed mb-6">
                The Village is an inclusive fitness community where your age, or fitness level does not define you. With commitment and diligence anyone can benefit from Functional Fitness and achieve their fitness goals.
            </p>
            
            <p class="text-lg text-gray-700 leading-relaxed mb-8">
                We coach our athletes to push past their often self-imposed physical and mental confines. Together, we learn the techniques, put in the hard work and build belief to overcome the obstacles. We want you to be the best version of yourself.
            </p>
            
            <p class="text-lg text-gray-700 leading-relaxed mb-8">
                Take that step today.
            </p>
            
            <a href="/contact" class="inline-block bg-black text-white px-10 py-4 rounded-lg font-bold hover:bg-gray-800 transition text-lg">
                CLICK HERE!
            </a>
        </div>
        
        <!-- Right Column - Video/Image Placeholder -->
        <div class="text-center lg:text-left">
            <h2 class="text-5xl font-bold text-gray-900 mb-8">MEMBERSHIPS</h2>
            
            <p class="text-lg text-gray-700 leading-relaxed mb-8">
                Your membership will be determined by how many sessions per week you'd like to attend. Each session is lead by one of our coaches to help you improve each time you attend a class.
            </p>
            
            <a href="/pricing" class="inline-flex items-center bg-black text-white px-8 py-4 rounded-lg font-bold hover:bg-gray-800 transition text-lg">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                I'M INTERESTED
            </a>
        </div>
    </div>
</div>


@php
    $athletes = [
        'jess', 'craig', 'kirk', 'tash', 'thor', 'tui', 'matt', 
        'blake', 'kyle', 'rob', 'gaz', 'kyle-g', 'athlete', 'castell'
    ];
@endphp

<div class="relative w-full overflow-hidden py-8">
    <!-- Carousel container -->
    <div id="athlete-carousel" class="flex gap-6 transition-transform duration-700 ease-in-out px-4">
        @foreach($athletes as $athlete)
        <div class="flex-shrink-0 w-64 md:w-80">
            <div class="relative h-96 md:h-[500px] rounded-lg overflow-hidden shadow-lg">
                <x-cloudinary::image public-id="{{ $athlete }}" class="w-full h-full object-cover" alt="Athlete {{ $loop->iteration }}"/>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button type="button" id="prev-btn" class="absolute left-2 top-1/2 -translate-y-1/2 z-30 flex items-center justify-center w-12 h-12 rounded-full bg-black/50 hover:bg-black/70 transition-colors focus:outline-none focus:ring-4 focus:ring-white/50">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        <span class="sr-only">Previous</span>
    </button>
    
    <button type="button" id="next-btn" class="absolute right-2 top-1/2 -translate-y-1/2 z-30 flex items-center justify-center w-12 h-12 rounded-full bg-black/50 hover:bg-black/70 transition-colors focus:outline-none focus:ring-4 focus:ring-white/50">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="sr-only">Next</span>
    </button>
</div>

<script src="{{ asset('js/carousel.js') }}"></script>

<!-- What You Get Section -->
<div class="max-w-7xl mx-auto mb-24 px-4">
    <div class="text-center mb-16">
        <h2 class="text-5xl font-bold text-gray-900 mb-4">You'll Love Training With Us</h2>
        <h3 class="text-3xl font-bold text-village-brown">What You Get At The Village</h3>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Tailored Programs -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-white border-4 border-village-brown rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-village-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">TAILORED FITNESS PROGRAMS</h3>
            <p class="text-gray-700 leading-relaxed">
                Every workout we offer is programmed and tailored specifically to your ability and fitness goals. That's right – every class! Whatever your fitness level, we'll tailor a program to help you to safely and steadily improve more on your fitness goals.
            </p>
        </div>

        <!-- Specialised Coaching -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-white border-4 border-village-brown rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-village-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">SPECIALISED COACHING EVERY SESSION</h3>
            <p class="text-gray-700 leading-relaxed">
                Our professionally trained and expert coaches actively coach each class that you attend. Personal coaching like this would normally cost a fortune in traditional gyms, but here at The Village, the coaching session is included in all our memberships.
            </p>
        </div>

        <!-- Functional Training -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-white border-4 border-village-brown rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-village-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">MULTIDISCIPLINARY FUNCTIONAL TRAINING</h3>
            <p class="text-gray-700 leading-relaxed">
                Our program uses functional movements that your body is naturally designed to do, combining elements of cardio, gymnastics, weightlifting, cycling, rowing, and more to improve your overall fitness in a balanced way.
            </p>
        </div>

        <!-- Friendship -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-white border-4 border-village-brown rounded-2xl flex items-center justify-center">
                    <svg class="w-12 h-12 text-village-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">FRIENDSHIP & ACCOUNTABILITY</h3>
            <p class="text-gray-700 leading-relaxed">
                At The Village, our community is our greatest strength. You'll make lifelong friends to help inspire, challenge and motivate you. We train together, socialise together, and inspire each other to do our best and achieve our best!
            </p>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-white py-20 mb-0">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- On Premises Café -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-village-brown rounded-2xl flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">ON PREMISES CAFÉ</h3>
                <p class="text-gray-700 leading-relaxed">
                    Love coffee as much as we do? We are lucky enough to share our complex with Midland's most popular café, The Crooked Spire. Sit back and enjoy a post-workout coffee with friends.
                </p>
            </div>

            <!-- Passionate Staff -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-village-brown rounded-2xl flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">PASSIONATE STAFF</h3>
                <p class="text-gray-700 leading-relaxed">
                    Every member of the team lives a healthy active lifestyle. Our vibrant and enthusiastic staff will definitely inspire you to make the change you've always wanted.
                </p>
            </div>

            <!-- Convenient Location -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-village-brown rounded-2xl flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">CONVENIENT LOCATION</h3>
                <p class="text-gray-700 leading-relaxed">
                    In the heart of Midland, we are located next to the main transport hub, with the Midland Gate only 750m away we're also conveniently centred in the business district.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="text-center py-20 max-w-4xl mx-auto px-4">
    <h2 class="text-5xl font-bold text-gray-900 mb-6">Ready to Join The Village?</h2>
    <p class="text-2xl text-gray-600 mb-10 leading-relaxed">Contact us today to get started on your fitness journey!</p>
    <a href="/contact" class="inline-block bg-gradient-to-r from-village-brown to-red-900 text-white px-12 py-5 rounded-2xl font-bold hover:from-red-900 hover:to-village-brown transition-all duration-300 text-xl shadow-2xl hover:shadow-3xl transform hover:scale-105">
        Contact Us Now →
    </a>
</div>

@endsection