<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #ad3925; color: white; padding: 20px; text-align: center; }
        .content { background: #ece8e7; padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #333; }
        .membership-level { 
            background: #ad3925; 
            color: white; 
            padding: 10px; 
            text-align: center; 
            font-size: 18px;
            margin: 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 New Membership Inquiry!</h1>
            <p>Someone wants to Get Started</p>
        </div>
        <div class="content">
            <div class="membership-level">
                {{ $formData['membership_level'] }} Membership
            </div>
            
            <div class="field">
                <span class="label">Name:</span> {{ $formData['name'] }}
            </div>
            <div class="field">
                <span class="label">Email:</span> 
                <a href="mailto:{{ $formData['email'] }}">{{ $formData['email'] }}</a>
            </div>
            <div class="field">
                <span class="label">Phone:</span> 
                <a href="tel:{{ $formData['phone'] }}">{{ $formData['phone'] }}</a>
            </div>
            @if(!empty($formData['message']))
            <div class="field">
                <span class="label">Message:</span><br>
                {{ $formData['message'] }}
            </div>
            @endif
            <div class="field">
                <span class="label">Submitted:</span> {{ now()->format('F j, Y \a\t g:i A') }}
            </div>
        </div>
    </div>
</body>
</html>