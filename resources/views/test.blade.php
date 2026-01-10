@extends('layouts.app')

@section('title', 'TEST - The Village Athletica')

@section('content')
<!-- Hero Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-gradient-to-br from-village-brown to-red-900 text-white py-20 mb-16">
    <div class="max-w-4xl mx-auto px-8 text-center">
        <h1 class="text-6xl font-bold mb-6">Test Page</h1>
        <p class="text-xl text-red-100 leading-relaxed">This page is for testing only.</p>
    </div>
</div>

<!-- 
    IMPORTANT: x-data is now on a wrapper div that contains BOTH the cards AND the modal
    This allows the modal to be positioned independently while still accessing the same data
    selectedLevel: tracks which membership level button was clicked
    formData: stores the form input values
    isSubmitting: prevents double submissions
    submitStatus: tracks success/error messages
-->
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
                    
                    <!-- Button triggers modal and sets the selected level -->
                    <button @click="showModal = true; selectedLevel = 'Level 1'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
                </div>
            </div>

            <!-- Level 2 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl border border-gray-100 flex flex-col">
                <div class="bg-gradient-to-br from-village-grey to-gray-200 text-gray-800 py-8 px-6 text-center">
                    <h3 class="text-2xl font-bold mb-2">Level 2</h3>
                    <div class="text-6xl font-bold text-gray-900 mt-6">$59</div>
                    <p class="text-gray-600 mt-2 text-lg">per week</p>
                </div>
                <div class="p-8 flex-grow flex flex-col">
                    <ul class="space-y-4 mb-8 flex-grow">
                        <li class="flex items-start">
                            <svg class="h-6 w-6 text-village-brown mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">3 Sessions Per Week</span>
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
                    <p class="text-sm text-gray-500 italic mb-6 text-center">Can use 3 HIRT Classes + 2 60min classes</p>
                    
                    <!-- Button triggers modal and sets the selected level -->
                    <button @click="showModal = true; selectedLevel = 'Level 2'" class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Now OUTSIDE the grid, at the root level -->
    <!-- This prevents any positioning conflicts with the card layout -->
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

<!-- Prevent flash of unstyled content -->
<style>
    [x-cloak] { 
        display: none !important; 
    }
</style>
@endsection