<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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
        ]);
        
        try {
            // Send email using Resend
            Mail::to('mitchellsteers@gmail.com')
                // ->cc('mitchellsteers@gmail.com')
                ->send(new ContactFormSubmission($request->all()));
            
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