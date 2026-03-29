<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New Membership Inquiry</title>
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
                                New Membership Inquiry
                            </h1>
                            <p style="margin: 0; font-size: 15px; color: #f5cec8;">
                                Someone is interested in joining The Village Athletica
                            </p>
                        </td>
                    </tr>

                    {{-- Membership level banner --}}
                    <tr>
                        <td style="background-color: #8c2d1d; padding: 14px 24px; text-align: center;">
                            <p style="margin: 0; font-size: 18px; font-weight: bold; color: #ffffff; letter-spacing: 1px;">
                                {{ strtoupper($formData['membership_level']) }} MEMBERSHIP
                            </p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="background-color: #ece8e7; padding: 30px 24px;">

                            <p style="margin: 0 0 20px 0; font-size: 15px; color: #555555;">
                                A new membership inquiry has been submitted via the website contact form. 
                                The details are listed below. Please follow up with this person as soon as possible.
                            </p>

                            {{-- Detail rows --}}
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">

                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 140px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Name</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ $formData['name'] }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 140px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Email</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <a href="mailto:{{ $formData['email'] }}" style="color: #ad3925; text-decoration: underline; font-size: 15px;">{{ $formData['email'] }}</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 140px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Phone</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <a href="tel:{{ $formData['phone'] }}" style="color: #ad3925; text-decoration: underline; font-size: 15px;">{{ $formData['phone'] }}</a>
                                    </td>
                                </tr>

                                @if(!empty($formData['message']))
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; width: 140px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Message</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #d4cece; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ $formData['message'] }}</span>
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <td style="padding: 10px 0; width: 140px; vertical-align: top;">
                                        <span style="font-weight: bold; color: #ad3925; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Submitted</span>
                                    </td>
                                    <td style="padding: 10px 0; vertical-align: top;">
                                        <span style="color: #333333; font-size: 15px;">{{ now()->format('F j, Y \a\t g:i A') }}</span>
                                    </td>
                                </tr>

                            </table>

                            {{-- CTA --}}
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top: 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $formData['email'] }}"
                                           style="display: inline-block; background-color: #ad3925; color: #ffffff; font-size: 15px; font-weight: bold; text-decoration: none; padding: 12px 32px; border-radius: 4px; letter-spacing: 0.5px;">
                                            Reply to {{ $formData['name'] }}
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