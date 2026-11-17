<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Request Received - The Rigid Boxes</title>
</head>
<body style="margin: 0; padding: 25px 0; background-color: #f7f5f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b; line-height: 1.6; -webkit-font-smoothing: antialiased;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 18px rgba(141, 68, 69, 0.08); border: 1px solid #ebdada;">
        
        {{-- Header with Exact Brand Logo on Brand Burgundy (#8D4445) - Visible in Both Light & Dark Mode --}}
        <tr>
            <td bgcolor="#8D4445" style="background-color: #8D4445; padding: 22px 20px 20px 20px; text-align: center; border-top-left-radius: 9px; border-top-right-radius: 9px;">
                <a href="https://therigidboxes.com" target="_blank" style="text-decoration: none; display: inline-block;">
                    <img src="https://therigidboxes.com/images/The%20Rigid%20Boxes%20Logo%201.png" alt="The Rigid Boxes" width="189" height="96" style="display: block; margin: 0 auto; width: 189px; max-width: 100%; height: auto; border: 0;">
                </a>
            </td>
        </tr>

        {{-- Brand Accent Divider Bar (#5B2829) --}}
        <tr>
            <td bgcolor="#5B2829" style="height: 3px; background-color: #5B2829; line-height: 3px; font-size: 3px;">&nbsp;</td>
        </tr>

        {{-- Main Body Content --}}
        <tr>
            <td style="padding: 30px 26px 24px 26px;">
                
                {{-- Status Pill --}}
                <div style="margin-bottom: 14px;">
                    <span style="display: inline-block; background: #fbf0f0; border: 1px solid #ecd4d4; color: #8D4445; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px;">
                        ✓ Quote Request Received
                    </span>
                </div>

                {{-- Greeting --}}
                <h1 style="margin: 0 0 10px 0; font-size: 21px; font-weight: 700; color: #231617; line-height: 1.3;">
                    Thank You, {{ trim($quoteData['name'] ?? '') ?: 'Valued Customer' }}!
                </h1>
                
                <p style="margin: 0 0 22px 0; font-size: 14px; color: #475569; line-height: 1.65;">
                    We have successfully received your quotation request. Our packaging specialists are reviewing your specifications and preparing a competitive wholesale quote tailored to your project.
                </p>

                {{-- Submitted Specifications Card --}}
                <div style="background: #ffffff; border: 1px solid #f0dede; border-radius: 8px; overflow: hidden; margin-bottom: 24px;">
                    <div style="background: #8D4445; padding: 12px 18px; color: #ffffff;">
                        <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #ffffff;">
                            📋 Your Submitted Specifications
                        </span>
                    </div>

                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse: collapse; font-size: 13px;">
                        <tbody>
                            {{-- Product Name / Box Style --}}
                            @php
                                $displayProduct = !empty($quoteData['product_name']) && $quoteData['product_name'] !== 'N/A' && $quoteData['product_name'] !== '—'
                                    ? $quoteData['product_name']
                                    : (!empty($quoteData['box_style']) && $quoteData['box_style'] !== 'N/A' ? $quoteData['box_style'] : 'Custom Rigid Box');
                            @endphp
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e; width: 38%;">Product / Style:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 700;">{{ $displayProduct }}</td>
                            </tr>

                            {{-- Dimensions --}}
                            @if(!empty($quoteData['length']) && !empty($quoteData['width']) && !empty($quoteData['depth']))
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Dimensions (L × W × D):</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 600;">
                                    {{ $quoteData['length'] }} × {{ $quoteData['width'] }} × {{ $quoteData['depth'] }} {{ $quoteData['units'] ?? 'Inches' }}
                                </td>
                            </tr>
                            @endif

                            {{-- Quantity --}}
                            @if(!empty($quoteData['quantity']))
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Quantity:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 700;">{{ number_format((int)$quoteData['quantity']) }} pcs</td>
                            </tr>
                            @endif

                            {{-- Paper Stock / Material --}}
                            @if(!empty($quoteData['material']) && $quoteData['material'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Paper Stock / Material:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['material'] }}</td>
                            </tr>
                            @endif

                            {{-- Color --}}
                            @if(!empty($quoteData['color']) && $quoteData['color'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Color:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['color'] }}</td>
                            </tr>
                            @endif

                            {{-- Paper Coating --}}
                            @if(!empty($quoteData['paper_coating']) && $quoteData['paper_coating'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Paper Coating:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['paper_coating'] }}</td>
                            </tr>
                            @endif

                            {{-- CAD Sample --}}
                            @if(!empty($quoteData['cad_sample']) && $quoteData['cad_sample'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">CAD Sample:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['cad_sample'] }}</td>
                            </tr>
                            @endif

                            {{-- Turnaround Time --}}
                            @if(!empty($quoteData['turn_around_time']) && $quoteData['turn_around_time'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Turnaround Time:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['turn_around_time'] }}</td>
                            </tr>
                            @endif

                            {{-- Company --}}
                            @if(!empty($quoteData['company_name']) && $quoteData['company_name'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Company:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['company_name'] }}</td>
                            </tr>
                            @endif

                            {{-- Website --}}
                            @if(!empty($quoteData['website']) && $quoteData['website'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Website:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['website'] }}</td>
                            </tr>
                            @endif

                            {{-- Physical Address --}}
                            @if(!empty($quoteData['physical_address']) && $quoteData['physical_address'] !== 'N/A')
                            <tr style="border-bottom: 1px solid #f6eeee; background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Delivery Address:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500;">{{ $quoteData['physical_address'] }}</td>
                            </tr>
                            @endif

                            {{-- Attachment --}}
                            @if(!empty($quoteData['quote_file_name']))
                            <tr style="border-bottom: 1px solid #f6eeee; background: #ffffff;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e;">Artwork File:</td>
                                <td style="padding: 11px 16px; color: #8D4445; font-weight: 600;">📎 {{ $quoteData['quote_file_name'] }} (Attached)</td>
                            </tr>
                            @endif

                            {{-- Message / Instructions --}}
                            @if(!empty($quoteData['message']) && $quoteData['message'] !== 'N/A')
                            <tr style="background: #faf6f6;">
                                <td style="padding: 11px 16px; font-weight: 600; color: #694d4e; vertical-align: top;">Message / Notes:</td>
                                <td style="padding: 11px 16px; color: #231617; font-weight: 500; white-space: pre-line;">{!! nl2br(e($quoteData['message'])) !!}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- What Happens Next (Timeline) --}}
                <div style="background: #faf6f6; border: 1px solid #ebdada; border-left: 4px solid #8D4445; border-radius: 6px; padding: 18px 20px; margin-bottom: 0;">
                    <h3 style="margin: 0 0 12px 0; font-size: 13px; font-weight: 700; color: #8D4445; text-transform: uppercase; letter-spacing: 0.6px;">
                        ⚡ Next Steps in Your Order
                    </h3>
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding-bottom: 9px; font-size: 13px; color: #334155; line-height: 1.5;">
                                <strong style="color: #8D4445;">1. Reviewing Specs:</strong> Our structural engineers verify your box dimensions, paperboard thickness & finishes.
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 9px; font-size: 13px; color: #334155; line-height: 1.5;">
                                <strong style="color: #8D4445;">2. Custom Quote:</strong> We send you competitive wholesale pricing with turnaround options.
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; color: #334155; line-height: 1.5;">
                                <strong style="color: #8D4445;">3. Free Digital Proof & CAD:</strong> We provide precise 2D/3D proofs before physical manufacturing starts.
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- Auto-generated Notice --}}
                <div style="margin-top: 20px; padding: 13px 18px; background-color: #faf6f6; border: 1px solid #ebdada; border-radius: 6px; text-align: center;">
                    <p style="margin: 0; font-size: 12px; color: #64748b; line-height: 1.5;">
                        ℹ️ <strong style="color: #475569;">Please Note:</strong> This is an automatically generated email. Please do not reply directly to this message.
                    </p>
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
                    Quote Ref: <strong style="color: #ffffff;">#{{ $quoteData['ref_code'] ?? ('RB-' . strtoupper(substr(uniqid(), -6))) }}</strong> &nbsp;|&nbsp; © {{ date('Y') }} <a href="https://therigidboxes.com" target="_blank" style="color: #ffffff; text-decoration: underline; font-weight: 600;">The Rigid Boxes</a>. All rights reserved.
                </p>
                <span style="display:none; max-height:0px; overflow:hidden; font-size:0px; line-height:0px; color:#5F2D2F; mso-hide:all;">[ID:{{ md5(uniqid(microtime(), true)) }}]</span>
            </td>
        </tr>

    </table>
</body>
</html>
