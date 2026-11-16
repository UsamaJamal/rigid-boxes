<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting The Rigid Boxes</title>
</head>
<body style="margin: 0; padding: 25px 0; background-color: #f7f5f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.6; -webkit-font-smoothing: antialiased;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 18px rgba(141, 68, 69, 0.08); border: 1px solid #ebdada;">
        
        {{-- Header with Exact Header Brand Logo on Clean White Background --}}
        <tr>
            <td style="background: #ffffff; padding: 26px 20px 22px 20px; text-align: center;">
                @php
                    $logoPath = (function_exists('app') && method_exists(app(), 'basePath'))
                        ? base_path('public/uploads/rigidboxes-header-logo-official.png')
                        : (dirname(__DIR__, 2) . '/uploads/rigidboxes-header-logo-official.png');
                    $logoUrl = (isset($message) && is_object($message) && method_exists($message, 'embed') && file_exists($logoPath))
                        ? $message->embed($logoPath)
                        : 'https://therigidboxes.com/images/The%20Rigid%20Boxes%20Logo%201.png';
                @endphp
                <a href="https://therigidboxes.com" target="_blank" style="text-decoration: none; display: inline-block;">
                    <img src="{{ $logoUrl }}" alt="The Rigid Boxes" width="190" style="display: block; margin: 0 auto; width: 190px; max-width: 100%; height: auto; border: 0;">
                </a>
            </td>
        </tr>

        {{-- Brand Burgundy Accent Bar (Matching Logo & Header) --}}
        <tr>
            <td style="height: 4px; background: #8D4445; line-height: 4px; font-size: 4px;">&nbsp;</td>
        </tr>

        {{-- Main Body Content --}}
        <tr>
            <td style="padding: 30px 26px 24px 26px;">
                
                {{-- Status Pill --}}
                <div style="margin-bottom: 14px;">
                    <span style="display: inline-block; background: #fbf0f0; border: 1px solid #ecd4d4; color: #8D4445; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px;">
                        ✉️ Message Received
                    </span>
                </div>

                {{-- Greeting --}}
                <h1 style="margin: 0 0 10px 0; font-size: 21px; font-weight: 700; color: #231617; line-height: 1.3;">
                    Thank You, {{ trim($data['name'] ?? '') ?: 'Valued Customer' }}!
                </h1>
                
                <p style="margin: 0 0 22px 0; font-size: 14px; color: #475569; line-height: 1.65;">
                    Thank you for reaching out to The Rigid Boxes. We have received your inquiry and our packaging support team will get back to you shortly.
                </p>

                {{-- Submitted Details Card --}}
                <div style="background: #ffffff; border: 1px solid #f0dede; border-radius: 8px; overflow: hidden; margin-bottom: 24px;">
                    <div style="background: #8D4445; padding: 12px 18px; color: #ffffff;">
                        <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #ffffff;">
                            📋 Your Submitted Details
                        </span>
                    </div>

                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse: collapse; font-size: 13px;">
                        <tbody>
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e; width: 38%;">Name:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 600;">{{ $data['name'] ?? '—' }}</td>
                            </tr>

                            @if(!empty($data['email']))
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Email:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $data['email'] }}</td>
                            </tr>
                            @endif

                            @if(!empty($data['phone']))
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Phone:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $data['phone'] }}</td>
                            </tr>
                            @endif

                            @if(!empty($data['product_name']) && $data['product_name'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Product of Interest:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 600;">{{ $data['product_name'] }}</td>
                            </tr>
                            @endif

                            @if(!empty($data['subject']))
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Subject:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $data['subject'] }}</td>
                            </tr>
                            @endif

                            @if(!empty($data['message']))
                            <tr style="background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e; vertical-align: top;">Message:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500; white-space: pre-line;">{!! nl2br(e($data['message'])) !!}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Need Support / Help Box --}}
                <div style="background: #ffffff; border: 1px dashed #d6c0c1; border-radius: 8px; padding: 20px; text-align: center;">
                    <p style="margin: 0 0 6px 0; font-size: 14px; font-weight: 700; color: #231617;">
                        Need Immediate Assistance?
                    </p>
                    <p style="margin: 0 0 14px 0; font-size: 13px; color: #64748b;">
                        Simply reply directly to this email or speak with our packaging specialists:
                    </p>
                    <div>
                        <a href="mailto:support@therigidboxes.com" style="display: inline-block; background: #8D4445; color: #ffffff; text-decoration: none; padding: 9px 18px; border-radius: 6px; font-size: 13px; font-weight: 600; margin: 3px 4px;">
                            ✉️ support@therigidboxes.com
                        </a>
                        @php
                            $supportPhone = null;
                            try {
                                $rawPh = \Illuminate\Support\Facades\DB::table('homepage_contents')->where('field_key', 'company_phone')->value('value');
                                if (!empty($rawPh) && strlen(trim($rawPh)) >= 7 && trim($rawPh) !== '01233') {
                                    $supportPhone = trim($rawPh);
                                }
                            } catch (\Exception $e) {}
                        @endphp
                        @if(!empty($supportPhone))
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $supportPhone) }}" style="display: inline-block; background: #ffffff; border: 1.5px solid #8D4445; color: #8D4445; text-decoration: none; padding: 8px 18px; border-radius: 6px; font-size: 13px; font-weight: 600; margin: 3px 4px;">
                            📞 {{ $supportPhone }}
                        </a>
                        @endif
                    </div>
                </div>

            </td>
        </tr>

        {{-- Footer Matching Website Brand Footer Colors (#5F2D2F) --}}
        <tr>
            <td style="background: #5F2D2F; padding: 26px 20px 22px 20px; text-align: center; color: #ffffff;">
                <p style="margin: 0 0 6px 0; color: #ffffff; font-weight: 700; font-size: 14px; letter-spacing: 0.3px;">
                    The Rigid Boxes
                </p>
                <p style="margin: 0 0 10px 0; color: #f2dcdc; font-size: 12px; line-height: 1.5;">
                    Premium Custom Rigid Boxes & Luxury Packaging Solutions
                </p>
                <p style="margin: 0 0 12px 0; color: #e5bebf; font-size: 11px; letter-spacing: 0.4px;">
                    ★ Free Shipping &nbsp;|&nbsp; ★ Free Digital Proofs & CAD Sample &nbsp;|&nbsp; ★ Wholesale Volume Pricing
                </p>
                <p style="margin: 0; font-size: 11px; color: #f2dcdc; line-height: 1.6;">
                    Inquiry Ref: <strong style="color: #ffffff;">#{{ $data['ref_code'] ?? ('RB-' . strtoupper(substr(uniqid(), -6))) }}</strong> &nbsp;|&nbsp; © {{ date('Y') }} <a href="https://therigidboxes.com" target="_blank" style="color: #ffffff; text-decoration: underline; font-weight: 600;">The Rigid Boxes</a>. All rights reserved.
                </p>
                <span style="display:none; max-height:0px; overflow:hidden; font-size:0px; line-height:0px; color:#5F2D2F; mso-hide:all;">[ID:{{ md5(uniqid(microtime(), true)) }}]</span>
            </td>
        </tr>

    </table>
</body>
</html>
