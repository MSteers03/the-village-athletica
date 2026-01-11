@extends('layouts.app')

@section('title', 'Contact - The Village Athletica')

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen bg-gradient-to-br from-village-brown to-red-900 text-white py-20 mb-16">
    <div class="max-w-4xl mx-auto px-8 text-center">
        <h1 class="text-6xl font-bold mb-6">Get In Touch</h1>
        <p class="text-xl text-red-100 leading-relaxed">We'd love to hear from you</p>
    </div>
</div>

<div x-data="{
    formData: {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        interest: '',
        experience: '',
        referral: '',
        comments: '',
        no_promotions: false
    },
    isSubmitting: false,
    submitStatus: { show: false, type: '', message: '' },
    async submitForm() {
        this.isSubmitting = true;
        this.submitStatus.show = false;

        try {
            // Generate reCAPTCHA token
            const token = await grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                action: 'contact_form'
            });

            const response = await fetch('{{ route('contact.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    ...this.formData,
                    recaptcha_token: token
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
                this.formData = {
                    first_name: '',
                    last_name: '',
                    email: '',
                    phone: '',
                    interest: '',
                    experience: '',
                    referral: '',
                    comments: '',
                    no_promotions: false
                };

                // Scroll to the form to see success message
                const formElement = document.querySelector('form');
                if (formElement) {
                    formElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
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

<!-- Google Maps Section -->
<div class="relative left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] w-screen mb-16">
    <div class="relative h-96 bg-gray-200">
        <!-- Google Maps Embed -->
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2393.8513374492286!2d116.00295557808226!3d-31.891691725618404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a32b9bb61410b09%3A0xd69114e128638e60!2sThe%20Village%20Athletica!5e1!3m2!1sen!2sau!4v1768026809414!5m2!1sen!2sau"
            class="absolute inset-0 w-full h-full"
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        
        <!-- View in Google Maps Button -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <a href="https://maps.app.goo.gl/N52BHhFjw1nVDZjv6" target="_blank" class="inline-block bg-village-brown text-white px-8 py-4 rounded-lg font-bold hover:bg-red-800 transition shadow-xl">
                VIEW IN GOOGLE MAPS
            </a>
        </div>
    </div>
</div>

<!-- Contact Form and Info Section -->
<div class="max-w-7xl mx-auto mb-20 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Left Column - Contact Form (2/3 width) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-4xl font-bold text-village-brown mb-4">MESSAGE OUR TEAM</h2>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    If you're interested in joining or wanting to know more about The Village, feel free to contact us using the form below.
                </p>
                <p class="text-sm text-gray-500 mb-6">* indicates required fields</p>

                <form @submit.prevent="submitForm" class="space-y-6">
                    <!-- Success/Error Message -->
                    <div x-show="submitStatus.show" 
                         x-transition
                         :class="submitStatus.type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'"
                         class="p-4 rounded-lg border text-sm mb-6">
                        <span x-text="submitStatus.message"></span>
                    </div>
                    
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            First Name <span class="text-village-brown">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="first_name" 
                            name="first_name"
                            x-model="formData.first_name"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition"
                            placeholder="First Name"
                        >
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Last Name <span class="text-village-brown">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="last_name" 
                            name="last_name"
                            x-model="formData.last_name"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition"
                            placeholder="Last Name"
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-village-brown">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            x-model="formData.email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition"
                            placeholder="Email"
                        >
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Phone <span class="text-village-brown">*</span>
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone"
                            x-model="formData.phone"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition"
                            placeholder="Phone"
                        >
                    </div>

                    <!-- Interest Dropdown -->
                    <div>
                        <label for="interest" class="block text-sm font-semibold text-gray-700 mb-2">
                            What best describes your interest?
                        </label>
                        <select 
                            id="interest" 
                            name="interest"
                            x-model="formData.interest"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition bg-white"
                        >
                            <option value="">What best describes your interest?</option>
                            <option value="membership">Membership Information</option>
                            <option value="trial">Free Trial Class</option>
                            <option value="personal">Personal Training</option>
                            <option value="group">Group Classes</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Experience Level Dropdown -->
                    <div>
                        <label for="experience" class="block text-sm font-semibold text-gray-700 mb-2">
                            What describes your CrossFit/Fitness experience level best?
                        </label>
                        <select 
                            id="experience" 
                            name="experience"
                            x-model="formData.experience"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition bg-white"
                        >
                            <option value="">What describes your CrossFit experience level best?</option>
                            <option value="beginner">Beginner - New to fitness</option>
                            <option value="intermediate">Intermediate - Some experience</option>
                            <option value="advanced">Advanced - Regular training</option>
                            <option value="athlete">Athlete - Competitive level</option>
                        </select>
                    </div>

                    <!-- How Did You Hear Dropdown -->
                    <div>
                        <label for="referral" class="block text-sm font-semibold text-gray-700 mb-2">
                            How did you hear about us?
                        </label>
                        <select 
                            id="referral" 
                            name="referral"
                            x-model="formData.referral"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition bg-white"
                        >
                            <option value="">How did you hear about us?</option>
                            <option value="google">Google Search</option>
                            <option value="social">Social Media</option>
                            <option value="friend">Friend/Family Referral</option>
                            <option value="drove">Drove/Walked Past</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Comments -->
                    <div>
                        <label for="comments" class="block text-sm font-semibold text-gray-700 mb-2">
                            Your comments and questions
                        </label>
                        <textarea 
                            id="comments" 
                            name="comments"
                            x-model="formData.comments"
                            rows="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-village-brown focus:border-transparent transition resize-none"
                            placeholder="Your comments and questions"
                        ></textarea>
                    </div>

                    <!-- Opt-out Checkbox -->
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            id="no_promotions" 
                            name="no_promotions"
                            x-model="formData.no_promotions"
                            class="mt-1 h-4 w-4 text-village-brown focus:ring-village-brown border-gray-300 rounded"
                        >
                        <label for="no_promotions" class="ml-3 text-sm text-gray-600">
                            I DO NOT want to receive special offers and promotions from The Village Athletica
                        </label>
                    </div>

                    <!-- reCAPTCHA Placeholder -->
                    <div class="text-xs text-gray-500 text-center">
                        This site is protected by reCAPTCHA and the Google
                        <a href="https://policies.google.com/privacy" class="text-village-brown hover:underline" target="_blank">Privacy Policy</a> and
                        <a href="https://policies.google.com/terms" class="text-village-brown hover:underline" target="_blank">Terms of Service</a> apply.
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button 
                            type="submit"
                            :disabled="isSubmitting"
                            :class="isSubmitting ? 'opacity-50 cursor-not-allowed' : ''"
                            class="w-full bg-gradient-to-r from-village-brown to-red-800 text-white px-8 py-4 rounded-xl hover:from-red-800 hover:to-village-brown transition-all duration-300 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        >
                            <span x-show="!isSubmitting">SUBMIT</span>
                            <span x-show="isSubmitting">SENDING...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Column - Social and Contact Info (1/3 width) -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Get Social -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Get Social</h3>
                <div class="flex justify-center">
                    <a href="https://www.instagram.com/thevillageathletica" target="_blank" class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-500 text-white rounded-xl hover:scale-110 transition-transform duration-300 shadow-lg">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Info</h3>
                
                <div class="space-y-6">
                    <!-- Address -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-village-brown rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="text-gray-700">
                            <p class="font-semibold">84 Railway Parade</p>
                            <p>Midland WA 6056</p>
                            <p>Perth, Australia</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-village-brown rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <a href="tel:0449523937" class="text-gray-700 hover:text-village-brown transition font-semibold">
                                0449 523 937
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 bg-village-brown rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <a href="mailto:info@thevillageathetica.com.au" class="text-gray-700 hover:text-village-brown transition break-all">
                                info@thevillageathetica.com.au
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opening Hours -->
            <div class="bg-gradient-to-br from-village-brown to-red-900 text-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold mb-6">Opening Hours</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="font-semibold">Monday - Friday</span>
                        <span>5:30 AM - 7:30 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Saturday</span>
                        <span>7:00 AM - 12:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Sunday</span>
                        <span>Closed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endsection