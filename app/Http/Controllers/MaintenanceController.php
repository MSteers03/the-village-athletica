<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaintenanceContactForm;

class MaintenanceController extends Controller
{
    public function show()
    {
        return view('maintenance');
    }
    
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'query_type' => 'required|in:general,membership,classes,other',
            'message' => 'nullable|string|max:1000',
        ]);
        
        try {
            // Send email using Resend
            Mail::to('mitchellsteers@gmail.com')
                ->send(new MaintenanceContactForm($request->all()));
            
            return redirect()->back()->with('success', 'Thank you! We have received your message and will contact you soon.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sorry, there was an error sending your message. Please try again.');
        }
    }
}