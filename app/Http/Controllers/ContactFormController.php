<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Mail\ContactFormSubmission;

class ContactFormController extends Controller
{
    public function show()
    {
        return view('contact');
    }
    
    public function submit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'interest' => 'nullable|string',
            'experience' => 'nullable|string',
            'referral' => 'nullable|string',
            'comments' => 'nullable|string|max:2000',
            'no_promotions' => 'nullable|boolean',
            'recaptcha_token' => 'required|string',
        ]);
        
        // Verify reCAPTCHA
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->recaptcha_token,
            'remoteip' => $request->ip()
        ]);
        
        $recaptchaData = $recaptchaResponse->json();
        
        // Check if reCAPTCHA verification failed
        if (!$recaptchaData['success'] || $recaptchaData['score'] < 0.5) {
            Log::warning('reCAPTCHA verification failed', [
                'score' => $recaptchaData['score'] ?? 'N/A',
                'errors' => $recaptchaData['error-codes'] ?? []
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please try again.'
            ], 422);
        }
        
        try {
            // Send email using Resend
            Mail::to('info@thevillageathletica.com.au')
                ->cc('mitchellsteers@gmail.com')
                ->send(new ContactFormSubmission($request->except('recaptcha_token')));
            
            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! We will get back to you soon.'
            ]);
        } catch (\Exception $e) {
            Log::error('Contact form submission failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again or call us directly.'
            ], 500);
        }
    }
}