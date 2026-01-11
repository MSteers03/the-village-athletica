@extends('layouts.app')

@section('title', 'Pricing - The Village Athletica')

@section('content')
<!-- Hero Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-gradient-to-br from-village-brown to-red-900 text-white py-20 mb-16">
    <div class="max-w-4xl mx-auto px-8 text-center">
        <h1 class="text-6xl font-bold mb-6">Join The Village Family</h1>
        <p class="text-xl text-red-100 leading-relaxed">No contracts. No joining fees. Just results.</p>
    </div>
</div>

<div x-data="{ 
    showModal: false, 
    selectedLevel: '',
    formData: { name: '', email: '', phone: '' },
    isSubmitting: false,
    submitStatus: { show: false, type: '', message: '' },
    async submitForm() {
        this.isSubmitting = true;
        this.submitStatus.show = false;
        
        try {
            const response = await fetch('{{ route('membership.inquiry') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: this.formData.name,
                    email: this.formData.email,
                    phone: this.formData.phone,
                    membership_level: this.selectedLevel
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.submitStatus = {
                    show: true,
                    type: 'success',
                    message: data.message
                };
                
                // Reset form
                this.formData = { name: '', email: '', phone: '' };
                
                // Close modal after 2 seconds
                setTimeout(() => {
                    this.showModal = false;
                    this.submitStatus.show = false;
                }, 2000);
            } else {
                this.submitStatus = {
                    show: true,
                    type: 'error',
                    message: data.message
                };
            }
        } catch (error) {
            this.submitStatus = {
                show: true,
                type: 'error',
                message: 'An error occurred. Please try again.'
            };
        } finally {
            this.isSubmitting = false;
        }
    }
}">

<!-- Intro Section -->
<div class="max-w-4xl mx-auto mb-20 px-4">
    <div class="text-center space-y-6 text-lg text-gray-700 leading-relaxed">
        <p>What do you get from a typical gym membership? You pay to use the equipment, that's it. And in some oversubscribed gyms, you may even need to wait for your turn to use the equipment.</p>
        <p>Here at The Village, your membership includes <span class="font-bold text-village-brown">professionally programmed workouts</span>, tailored specifically to your personal fitness needs. You'll receive professional coaching during every session, nutritional advice, and one-on-one help whenever you need it.</p>
        <p>When you become a member of The Village, you get access to our classes, open gym times, and specialty workshops.</p>
    </div>
</div>

<!-- Main Membership Levels -->
<div class="mb-24">
    <h2 class="text-4xl font-bold text-center mb-4 text-gray-900">Membership Options</h2>
    <p class="text-center text-gray-600 mb-12 text-lg">Choose the plan that fits your lifestyle</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto px-4">
        <!-- Level 1 -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl border border-gray-100 flex flex-col">
            <div class="bg-gradient-to-br from-village-grey to-gray-200 text-gray-800 py-8 px-6 text-center">
                <h3 class="text-2xl font-bold mb-2">Level 1</h3>
                <div class="text-6xl font-bold text-gray-900 mt-6">$49</div>
                <p class="text-gray-600 mt-2 text-lg">per week</p>
            </div>
            <div class="p-8 flex-grow flex flex-col">
                <ul class="space-y-4 mb-8 flex-grow">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">2 Sessions Per Week</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Access To Open Gym</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">No Lock-In Contracts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">No Joining Fee</span>
                    </li>
                </ul>
                <p class="text-sm text-gray-500 italic mb-6 text-center">Can use 2 HIRT Classes + 1 60min class</p>
                    <button @click="showModal = true; selectedLevel = 'Level 1'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
            </div>
        </div>

        <!-- Level 2 - Most Popular -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 hover:scale-105 border-4 border-village-brown relative flex flex-col focus:outline-none">
            <div class="bg-gradient-to-br from-village-brown to-red-900 text-white py-6 px-6 text-center">
                <h3 class="text-2xl font-bold mb-0.5">Level 2</h3>
                <p class="text-village-grey text-sm font-semibold mb-2">Best Seller</p>
                <div class="text-6xl font-bold mt-3">$59</div>
                <p class="text-red-100 mt-2 text-lg">per week</p>
            </div>
            <div class="p-8 flex-grow flex flex-col">
                <ul class="space-y-4 mb-8 flex-grow">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">3 Sessions per week</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Access To Open Gym</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">FREE Saturday Workshops</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">No Lock-In Contracts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">No Joining Fee</span>
                    </li>
                </ul>
                <p class="text-sm text-gray-500 italic mb-6 text-center">Can use 2 x HIRT classes as 1 session</p>
                    <button @click="showModal = true; selectedLevel = 'Level 2'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
            </div>
        </div>

        <!-- Level 3 -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl border border-gray-100 flex flex-col">
            <div class="bg-gradient-to-br from-village-grey to-gray-200 text-gray-800 py-8 px-6 text-center">
                <h3 class="text-2xl font-bold mb-2">Level 3</h3>
                <div class="text-6xl font-bold text-gray-900 mt-6">$69</div>
                <p class="text-gray-600 mt-2 text-lg">per week</p>
            </div>
            <div class="p-8 flex-grow flex flex-col">
                <ul class="space-y-4 mb-8 flex-grow">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Unlimited Sessions</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Access To Open Gym</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">FREE Saturday Workshops</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">No Lock-In Contracts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">No Joining Fee</span>
                    </li>
                </ul>
                <div class="mb-6 h-6"></div>
                    <button @click="showModal = true; selectedLevel = 'Level 3'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
            </div>
        </div>
    </div>
</div>

<!-- Additional Options -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-village-grey py-20 mb-24">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-4 text-gray-900">Additional Options</h2>
        <p class="text-center text-gray-600 mb-12 text-lg">Flexible training solutions for every schedule</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- HIRT -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl flex flex-col">
                <div class="bg-gradient-to-br from-village-brown to-red-800 text-white py-6 px-6 text-center">
                    <h3 class="text-2xl font-bold mb-2">HIRT</h3>
                    <div class="text-5xl font-bold mt-4">$39</div>
                    <p class="text-red-100 mt-2">per week</p>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="space-y-4 mb-8 text-gray-700 text-center leading-relaxed flex-grow">
                        <p class="font-semibold text-lg">Full access to all HIRT classes</p>
                        <p class="text-sm">(5:30 am - every day & 9 am Monday, Tuesday and Thursday)</p>
                        <div class="pt-4 space-y-2">
                            <p class="font-semibold text-village-brown">✓ No Lock In Contracts</p>
                            <p class="font-semibold text-village-brown">✓ No Joining Fee</p>
                        </div>
                    </div>
                    <button @click="showModal = true; selectedLevel = 'HIRT'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
                </div>
            </div>

            <!-- Personal Coaching -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl flex flex-col">
                <div class="bg-gradient-to-br from-village-brown to-red-800 text-white py-6 px-6 text-center">
                    <h3 class="text-2xl font-bold mb-2">Personal Coaching</h3>
                    <div class="text-5xl font-bold mt-4">$75</div>
                    <p class="text-red-100 mt-2">per session</p>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="space-y-4 mb-8 text-gray-700 text-center leading-relaxed flex-grow">
                        <p class="font-semibold text-lg">Private coaching sessions</p>
                        <p>Structured to suit your individual needs. In these one-on-one sessions, the trainers' attention is fully focused on you.</p>
                        <p class="text-village-brown font-semibold">Dive deeper into your goals</p>
                    </div>
                    <button @click="showModal = true; selectedLevel = 'Personal Coaching'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
                </div>
            </div>

            <!-- 10-Pack -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl flex flex-col">
                <div class="bg-gradient-to-br from-village-brown to-red-800 text-white py-6 px-6 text-center">
                    <h3 class="text-2xl font-bold mb-2">10-Pack</h3>
                    <div class="text-5xl font-bold mt-4">$250</div>
                    <p class="text-red-100 mt-2">Save $50</p>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <div class="space-y-4 mb-8 text-gray-700 text-center leading-relaxed flex-grow">
                        <p class="font-semibold text-lg">10 x Classes</p>
                        <p class="text-sm">[All Class Types]</p>
                        <div class="pt-4 space-y-2">
                            <p class="font-semibold text-village-brown">✓ No Lock In Contracts</p>
                            <p class="font-semibold text-village-brown">✓ No Joining Fee</p>
                            <p class="font-semibold text-village-brown">✓ 12 Week Expiry</p>
                        </div>
                    </div>
                    <button @click="showModal = true; selectedLevel = '10-Pack'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Key Features Section -->
<div class="mb-24 max-w-7xl mx-auto px-4">
    <h2 class="text-4xl font-bold text-center mb-4 text-gray-900">Why Choose The Village?</h2>
    <p class="text-center text-gray-600 mb-16 text-lg">More than just a gym membership</p>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <!-- No Lock-in Contracts -->
        <div class="text-center group">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-village-brown to-red-800 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-gray-900">NO LOCK-IN CONTRACTS</h3>
            <p class="text-gray-600 leading-relaxed">We don't believe in contracts. Stay because you love it and get results. Cancel anytime—no questions, no hassles.</p>
        </div>

        <!-- No Sign Up Fees -->
        <div class="text-center group">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-village-brown to-red-800 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-gray-900">NO SIGN UP FEES</h3>
            <p class="text-gray-600 leading-relaxed">Getting started with fitness can be tough. That's why we don't charge sign-up fees—making your journey as easy as possible.</p>
        </div>

        <!-- Community -->
        <div class="text-center group">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-village-brown to-red-800 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold mb-4 text-gray-900">INCREDIBLE COMMUNITY</h3>
            <p class="text-gray-600 leading-relaxed">You're more than a number. We're all on this journey together—becoming healthier, fitter, and simply loving life together.</p>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-village-grey py-20 mb-24">
    <div class="max-w-4xl mx-auto px-8">
        <h2 class="text-4xl font-bold text-center mb-4 text-gray-900">Frequently Asked Questions</h2>
        <p class="text-center text-gray-600 mb-12 text-lg">Everything you need to know</p>
        
        <div class="space-y-4">
            <!-- FAQ Item 1 -->
            <details class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <summary class="p-6 cursor-pointer font-semibold text-gray-800 hover:text-village-brown transition flex items-center justify-between list-none">
                    <span class="flex items-center text-lg">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        CAN I PAY WEEKLY, FORTNIGHTLY OR MONTHLY?
                    </span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    <p>To make life easy we use Ezi Debit and memberships come out on a fortnightly basis.</p>
                </div>
            </details>

            <!-- FAQ Item 2 -->
            <details class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <summary class="p-6 cursor-pointer font-semibold text-gray-800 hover:text-village-brown transition flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        CAN I PAY EFTPOS/CASH RATHER THAN DIRECT DEBIT?
                    </span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    <p>Unfortunately we don’t accept cash as a ongoing basis due to us sometime being forgetful and let’s face it…who enjoys asking for money? If Direct Debit is something you are not comfortable with though, we do have other options.</p>
                </div>
            </details>

            <!-- FAQ Item 3 -->
            <details class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <summary class="p-6 cursor-pointer font-semibold text-gray-800 hover:text-village-brown transition flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        IS THERE ANY TRANSACTION FEES ON TOP OF THE MEMBERSHIP?
                    </span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    <p>There are no little hidden fees, but! If your payment bounce you will be charge $1.65 for a “Missed Payment”</p>
                </div>
            </details>

            <!-- FAQ Item 4 -->
            <details class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <summary class="p-6 cursor-pointer font-semibold text-gray-800 hover:text-village-brown transition flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        CAN I PUT MY MEMBERSHIP ON HOLD IF I CAN'T MAKE IT AND HOW LONG FOR?
                    </span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    <p>Yes absolutely… This isn’t a home loan. All we ask is for the return date so we can set the pause up for you.</p>
                </div>
            </details>

            <!-- FAQ Item 5 -->
            <details class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <summary class="p-6 cursor-pointer font-semibold text-gray-800 hover:text-village-brown transition flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        WHAT'S THE PROCESS IF I NEED TO CANCEL?
                    </span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    <p>All we ask is for you to send us an email stating why you are cancelling and when you want to stop.</p>
                </div>
            </details>

            <!-- FAQ Item 6 -->
            <details class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 group">
                <summary class="p-6 cursor-pointer font-semibold text-gray-800 hover:text-village-brown transition flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        DO YOU OFFER FIFO MEMBERSHIPS?
                    </span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    <p>Yes we certainly do. We customise your membership payments to suit your FIFO roster. All you need to do is tell us the dates and we sort out the rest.</p>
                </div>
            </details>
        </div>
    </div>
</div>
    <div x-show="showModal" 
         x-cloak
         @keydown.escape.window="showModal = false"
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto">
        
        <!-- Semi-transparent background overlay - click to close -->
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="showModal = false"></div>
        
        <!-- Modal container - centered on screen -->
        <div class="flex items-center justify-center min-h-screen p-4">
            
            <!-- Actual modal content box -->
            <!-- @click.stop prevents clicks inside from closing the modal -->
            <div @click.stop class="relative bg-white rounded-lg shadow-xl max-w-lg w-full">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-4">
                                Get Started - <span x-text="selectedLevel"></span> Membership
                            </h3>
                            
                            <!-- Form -->
                            <form @submit.prevent="submitForm" class="space-y-4">
                                <!-- Success/Error Message -->
                                <div x-show="submitStatus.show" 
                                     x-transition
                                     :class="submitStatus.type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'"
                                     class="p-3 rounded-md border text-sm mb-4">
                                    <span x-text="submitStatus.message"></span>
                                </div>

                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                    <input type="text" 
                                           id="name" 
                                           name="name"
                                           x-model="formData.name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-village-brown focus:border-village-brown"
                                           placeholder="John Doe"
                                           required>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" 
                                           id="email" 
                                           name="email"
                                           x-model="formData.email"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-village-brown focus:border-village-brown"
                                           placeholder="john@example.com"
                                           required>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone"
                                           x-model="formData.phone"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-village-brown focus:border-village-brown"
                                           placeholder="0400 000 000"
                                           required>
                                </div>

                                <!-- Modal Footer with action buttons -->
                                <div class="bg-gray-50 -mx-4 sm:-mx-6 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3 mt-6">
                                    <button type="submit" 
                                            :disabled="isSubmitting"
                                            :class="isSubmitting ? 'opacity-50 cursor-not-allowed' : ''"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-village-brown text-base font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-village-brown sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                        <span x-show="!isSubmitting">Submit</span>
                                        <span x-show="isSubmitting">Sending...</span>
                                    </button>
                                    <button type="button" 
                                            @click="showModal = false; submitStatus.show = false"
                                            :disabled="isSubmitting"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-village-brown sm:mt-0 sm:w-auto sm:text-sm transition-colors">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endsection