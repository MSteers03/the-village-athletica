<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #ad3925; color: white; padding: 20px; text-align: center; }
        .content { background: #ece8e7; padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #333; }
        .section-title {
            background: #ad3925;
            color: white;
            padding: 8px 12px;
            margin: 20px 0 10px 0;
            border-radius: 5px;
            font-size: 16px;
        }
        .opt-out {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 New Contact Form Submission</h1>
            <p>Someone has reached out through the website</p>
        </div>
        <div class="content">
            <div class="section-title">Contact Details</div>
            
            <div class="field">
                <span class="label">Name:</span> {{ $formData['first_name'] }} {{ $formData['last_name'] }}
            </div>
            <div class="field">
                <span class="label">Email:</span> 
                <a href="mailto:{{ $formData['email'] }}">{{ $formData['email'] }}</a>
            </div>
            <div class="field">
                <span class="label">Phone:</span> 
                <a href="tel:{{ $formData['phone'] }}">{{ $formData['phone'] }}</a>
            </div>

            @if(!empty($formData['interest']) || !empty($formData['experience']) || !empty($formData['referral']))
            <div class="section-title">Additional Information</div>
            
            @if(!empty($formData['interest']))
            <div class="field">
                <span class="label">Interest:</span> {{ ucfirst($formData['interest']) }}
            </div>
            @endif

            @if(!empty($formData['experience']))
            <div class="field">
                <span class="label">Experience Level:</span> {{ ucfirst($formData['experience']) }}
            </div>
            @endif

            @if(!empty($formData['referral']))
            <div class="field">
                <span class="label">How They Heard About Us:</span> {{ ucfirst($formData['referral']) }}
            </div>
            @endif
            @endif

            @if(!empty($formData['comments']))
            <div class="section-title">Comments & Questions</div>
            <div class="field">
                {{ $formData['comments'] }}
            </div>
            @endif

            @if(isset($formData['no_promotions']) && $formData['no_promotions'])
            <div class="opt-out">
                <strong>⚠️ Marketing Opt-Out:</strong> This person does NOT want to receive promotional emails.
            </div>
            @endif

            <div class="field" style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #ccc;">
                <span class="label">Submitted:</span> {{ now()->format('F j, Y \a\t g:i A') }}
            </div>
        </div>
    </div>
</body>
</html>