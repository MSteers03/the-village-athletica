NEW MEMBERSHIP INQUIRY — THE VILLAGE ATHLETICA
===============================================

A new membership inquiry has been submitted through the website.

MEMBERSHIP LEVEL: {{ strtoupper($formData['membership_level']) }}

CONTACT DETAILS
---------------
Name:      {{ $formData['name'] }}
Email:     {{ $formData['email'] }}
Phone:     {{ $formData['phone'] }}
@if(!empty($formData['message']))
Message:
{{ $formData['message'] }}
@endif

Submitted: {{ now()->format('F j, Y \a\t g:i A') }}

-----------------------------------------------
This is an automated notification from The Village Athletica website.
© {{ now()->year }} The Village Athletica. All rights reserved.