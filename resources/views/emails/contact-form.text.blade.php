NEW CONTACT FORM SUBMISSION — THE VILLAGE ATHLETICA
====================================================

A new message has been submitted through the website contact form.

CONTACT DETAILS
---------------
Name:   {{ $formData['first_name'] }} {{ $formData['last_name'] }}
Email:  {{ $formData['email'] }}
Phone:  {{ $formData['phone'] }}

@if(!empty($formData['interest']) || !empty($formData['experience']) || !empty($formData['referral']))
ADDITIONAL INFORMATION
----------------------
@if(!empty($formData['interest']))
Interest:       {{ ucfirst($formData['interest']) }}
@endif
@if(!empty($formData['experience']))
Experience:     {{ ucfirst($formData['experience']) }}
@endif
@if(!empty($formData['referral']))
How They Heard: {{ ucfirst($formData['referral']) }}
@endif

@endif
@if(!empty($formData['comments']))
COMMENTS & QUESTIONS
--------------------
{{ $formData['comments'] }}

@endif
@if(isset($formData['no_promotions']) && $formData['no_promotions'])
*** MARKETING OPT-OUT ***
This person does NOT want to receive promotional or marketing emails.
Please ensure they are excluded from all mailing lists.

@endif
Submitted: {{ now()->format('F j, Y \a\t g:i A') }}

----------------------------------------------------
This is an automated notification from The Village Athletica website.
© {{ now()->year }} The Village Athletica. All rights reserved.