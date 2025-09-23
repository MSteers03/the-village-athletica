<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaintenanceContactForm extends Mailable
{
    use Queueable, SerializesModels;
    
    public $formData;
    
    public function __construct($formData)
    {
        $this->formData = $formData;
    }
    
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('New Contact Form Submission - Site Under Maintenance')
                    ->view('emails.maintenance-contact');
    }
}