<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New Contact Form Submission</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 1.6; color: #333333; background-color: #f4f4f4;">

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 10px;">

                {{-- Outer wrapper --}}
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 6px; overflow: hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #ad3925; padding: 30px 24px; text-align: center;">
                            <h1 style="margin: 0 0 8px 0; font-size: 24px; font-weight: bold; color: #ffffff; letter-spacing: 0.5px;">
                                New Contact Form Submission
                            </h1>
                            <p style="margin: 0; font-size: 15px; color: #f5cec8;">
                                Someone has reached out through the website
                            </p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="background-color: #ece8e7; padding: 30px 24px;">

                            <p style="margin: 0 0 20px 0; font-size: 15px; color: #555555;">
                                A new message has been submitted via the contact form on The Village Athletica website. 
                                Their details and enquiry are listed below.
                            </p>

                            {{-- Section: Contact Details --}}
                            <p style="margin: 0 0 10px 0; padding: 8px 14px; background-color: #ad3925; color: #ffffff; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px;">
                                Contact Details
                            </p>

                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 160px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Name</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ $formData['first_name'] }} {{ $formData['last_name'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 160px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Email</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <a href="mailto:{{ $formData['email'] }}" style="color: #ad3925; text-decoration: underline; font-size: 15px;">{{ $formData['email'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; width: 160px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Phone</span>
                                    </td>
                                    <td style="padding: 10px 0; vertical-align: top;">
                                        <a href="tel:{{ $formData['phone'] }}" style="color: #ad3925; text-decoration: underline; font-size: 15px;">{{ $formData['phone'] }}</a>
                                    </td>
                                </tr>
                            </table>

                            {{-- Section: Additional Information (conditional) --}}
                            @if(!empty($formData['interest']) || !empty($formData['experience']) || !empty($formData['referral']))

                            <p style="margin: 0 0 10px 0; padding: 8px 14px; background-color: #ad3925; color: #ffffff; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px;">
                                Additional Information
                            </p>

                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 20px;">

                                @if(!empty($formData['interest']))
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 160px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Interest</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ ucfirst($formData['interest']) }}</span>
                                    </td>
                                </tr>
                                @endif

                                @if(!empty($formData['experience']))
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 160px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Experience Level</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ ucfirst($formData['experience']) }}</span>
                                    </td>
                                </tr>
                                @endif

                                @if(!empty($formData['referral']))
                                <tr>
                                    <td style="padding: 10px 0; width: 160px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">How They Heard</span>
                                    </td>
                                    <td style="padding: 10px 0; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ ucfirst($formData['referral']) }}</span>
                                    </td>
                                </tr>
                                @endif

                            </table>
                            @endif

                            {{-- Section: Comments --}}
                            @if(!empty($formData['comments']))
                            <p style="margin: 0 0 10px 0; padding: 8px 14px; background-color: #ad3925; color: #ffffff; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px;">
                                Comments &amp; Questions
                            </p>
                            <p style="margin: 0 0 20px 0; padding: 14px; background-color: #ffffff; border-left: 4px solid #ad3925; border-radius: 0 4px 4px 0; font-size: 15px; color: #333333;">
                                {{ $formData['comments'] }}
                            </p>
                            @endif

                            {{-- Marketing opt-out warning --}}
                            @if(isset($formData['no_promotions']) && $formData['no_promotions'])
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 20px;">
                                <tr>
                                    <td style="background-color: #fff3cd; border: 1px solid #ffc107; border-radius: 4px; padding: 14px;">
                                        <p style="margin: 0; font-size: 14px; color: #664d03; font-weight: bold;">
                                            Marketing Opt-Out Notice
                                        </p>
                                        <p style="margin: 6px 0 0 0; font-size: 14px; color: #664d03;">
                                            This person has indicated they do NOT wish to receive promotional or marketing emails. Please ensure they are excluded from any mailing lists.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            {{-- Submitted timestamp --}}
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 2px solid #d4cece;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Submitted:</span>
                                        <span style="font-size: 14px; color: #555555; margin-left: 8px;">{{ now()->format('F j, Y \a\t g:i A') }}</span>
                                    </td>
                                </tr>
                            </table>

                            {{-- CTA --}}
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top: 24px;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $formData['email'] }}"
                                           style="display: inline-block; background-color: #ad3925; color: #ffffff; font-size: 15px; font-weight: bold; text-decoration: none; padding: 12px 32px; border-radius: 4px; letter-spacing: 0.5px;">
                                            Reply to {{ $formData['first_name'] }}
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #333333; padding: 20px 24px; text-align: center;">
                            <p style="margin: 0 0 6px 0; font-size: 13px; color: #aaaaaa;">
                                This is an automated notification from The Village Athletica website.
                            </p>
                            <p style="margin: 0; font-size: 13px; color: #aaaaaa;">
                                &copy; {{ now()->year }} The Village Athletica. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>