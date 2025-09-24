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
        .field { margin-bottom: 10px; }
        .label { font-weight: bold; color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
            <p>Site Under Maintenance</p>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">Name:</span> {{ $formData['name'] }}
            </div>
            <div class="field">
                <span class="label">Email:</span> {{ $formData['email'] }}
            </div>
            <div class="field">
                <span class="label">Phone:</span> {{ $formData['phone'] ?? 'Not provided' }}
            </div>
            <div class="field">
                <span class="label">Query Type:</span> {{ ucfirst($formData['query_type']) }}
            </div>
            <div class="field">
                <span class="label">Message:</span><br>
                {{ $formData['message'] ?? 'No message provided' }}
            </div>
            <div class="field">
                <span class="label">Submitted:</span> {{ now()->format('F j, Y \a\t g:i A') }}
            </div>
        </div>
    </div>
</body>
</html>