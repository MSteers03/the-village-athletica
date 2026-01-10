<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;  // Add this import
use App\Mail\MembershipInquiry;

class MembershipInquiryController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'membership_level' => 'required|string',
        ]);
        
        try {
            // Send email using Resend
            Mail::to('mitchellsteers@gmail.com')
                // ->cc('mitchellsteers@gmail.com')
                ->send(new MembershipInquiry($request->all()));
            
            return response()->json([
                'success' => true,
                'message' => 'Thank you! We have received your inquiry and will contact you soon.'
            ]);
        } catch (\Exception $e) {
            Log::error('Membership inquiry failed: ' . $e->getMessage());  // Now it works
            
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error. Please try again or call us directly.'
            ], 500);
        }
    }
}