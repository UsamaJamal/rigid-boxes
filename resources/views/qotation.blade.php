<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    @include('components.canonical')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Instant Quote | The Rigid Boxes</title>
    <meta name="description" content="Request your free custom quote for luxury rigid packaging boxes. Fast estimates & high quality custom boxes.">
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <style>
        :root {
            --primary-color: #8D4445;
            --secondary-color: #F8EEEC;
            --background-color: #FAF8F8;
            --footer-color: #5F2D2F;
            --header-gradient: linear-gradient(278.74deg, #AB5A5B 0.2%, #8D4445 44.25%, #5B2829 88.3%);
            --section-text-color: #000000;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--background-color, #FAF8F8);
            color: #2D2D2D;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Open Sans', sans-serif;
            color: #000000;
        }

        .iq-page-hero {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 30px 55px 20px 55px;
            text-align: center;
            box-sizing: border-box;
        }

        .iq-breadcrumb {
            text-align: left;
            margin-bottom: 24px;
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-color, #8D4445);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-family: 'Open Sans', sans-serif;
        }

        .iq-breadcrumb a {
            color: var(--primary-color, #8D4445);
            text-decoration: none;
        }

        .iq-breadcrumb span {
            color: #000000;
        }

        .iq-page-hero h1 {
            font-size: clamp(26px, 4vw, 38px);
            font-weight: 800;
            color: #000000;
            margin-bottom: 12px;
            line-height: 1.25;
        }

        .iq-page-hero p {
            color: #000;
            font-size: 15px;
            max-width: 580px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        .iq-page-container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 55px 60px 55px;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: center;
            box-sizing: border-box;
        }

        .iq-page-form-card {
            flex: 0 1 750px;
            max-width: 750px;
            width: 100%;
            background-color: #F8F4F2;
            padding: 40px;
            border-radius: 16px;
            box-sizing: border-box;
            min-width: 0;
            border: 1px solid #EFEAE7;
        }

        .iq-page-form-card h2 {
            font-size: clamp(22px, 3vw, 28px);
            font-weight: 800;
            text-align: center;
            margin-bottom: 28px;
            color: #111111;
        }

        .iq-page-sidebar {
            flex: 0 0 350px;
            width: 350px;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-sizing: border-box;
        }

        .iq-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .iq-form-group label {
            font-family: 'Open Sans', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: #2D2D2D;
        }

        .iq-form-group input[type="text"],
        .iq-form-group input[type="email"],
        .iq-form-group input[type="tel"],
        .iq-form-group input[type="number"],
        .iq-form-group select,
        .iq-form-group textarea {
            width: 100%;
            height: 44px;
            padding: 0 14px;
            border: 1px solid #E2D9D5;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            background-color: #FFFFFF !important;
            color: #2D2D2D;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .iq-form-group textarea {
            height: auto;
            padding: 12px 14px;
            resize: vertical;
        }

        .iq-form-group input:focus,
        .iq-form-group select:focus,
        .iq-form-group textarea:focus {
            border-color: var(--primary-color, #8D4445) !important;
            box-shadow: 0 0 0 3px rgba(141, 68, 69, 0.12) !important;
        }

        .iq-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .iq-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .iq-grid-4 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 12px;
        }

        .iq-sidebar-card {
            background-color: #F0F0F0;
            padding: 24px;
            border-radius: 12px;
            border: 1px solid #E8E2DF;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }

        .iq-sidebar-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #111111;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .iq-page-container {
                padding: 0 20px 50px;
            }
            .iq-page-form-card {
                max-width: 100%;
                flex: 1 1 100%;
                padding: 32px 24px;
            }
            .iq-page-sidebar {
                flex: 1 1 100%;
                width: 100%;
                max-width: 100%;
            }
        }

        @media (max-width: 600px) {
            .iq-page-hero {
                padding: 20px 20px 16px;
            }
            .iq-breadcrumb {
                margin-bottom: 16px;
            }
            .iq-page-container {
                padding: 0 20px 40px;
                gap: 20px;
            }
            .iq-page-form-card {
                padding: 22px 16px;
                border-radius: 12px;
            }
            .iq-grid-2,
            .iq-grid-3 {
                grid-template-columns: 1fr;
                gap: 14px;
            }
            .iq-grid-4 {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 400px) {
            .iq-grid-4 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    @include('components.header')

    <main class="main-content">
        <div class="iq-page-hero">
            <div class="iq-breadcrumb">
                <a href="/">HOME</a> / <span>GET INSTANT QUOTE</span>
            </div>
            <h1>Request Your Free Custom Quote</h1>
            <p>Fill in the details below and receive a tailored estimate within minutes. No steps, just straightforward.</p>
        </div>

        <div class="iq-page-container">
            <!-- Left form section -->
            <div class="iq-page-form-card">
                <h2>Instant Quotes, Quick Service!</h2>
                @if(session('success'))
                    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ url('/submit-quote') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 16px;">
                    @csrf
                    <!-- Row 1 -->
                    <div class="iq-grid-2">
                        <div class="iq-form-group">
                            <label>Name *</label>
                            <input type="text" name="name" placeholder="Enter your name" oninput="this.value = this.value.replace(/[0-9]/g, '')" required>
                        </div>
                        <div class="iq-form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="iq-grid-2">
                        <div class="iq-form-group">
                            <label>Phone *</label>
                            <input type="tel" name="phone" placeholder="Enter your number" oninput="this.value = this.value.replace(/[^0-9+\- ]/g, '')" required>
                        </div>
                        <div class="iq-form-group">
                            <label>Physical Address</label>
                            <input type="text" name="physical_address" placeholder="Enter your address">
                        </div>
                    </div>

                    <!-- Row 3: Dimensions -->
                    <div class="iq-grid-4">
                        <div class="iq-form-group">
                            <label>Width *</label>
                            <input type="text" name="width" placeholder="Width" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                        </div>
                        <div class="iq-form-group">
                            <label>Length *</label>
                            <input type="text" name="length" placeholder="Length" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                        </div>
                        <div class="iq-form-group">
                            <label>Depth *</label>
                            <input type="text" name="depth" placeholder="Depth" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                        </div>
                        <div class="iq-form-group">
                            <label>Units *</label>
                            <select name="units" required>
                                <option value="mm">mm</option>
                                <option value="cm">cm</option>
                                <option value="inches">inches</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Select options -->
                    <div class="iq-grid-3">
                        <div class="iq-form-group">
                            <label>Select Material</label>
                            <select name="material">
                                <option value="">Choose option</option>
                                <option value="Rigid Board">Rigid Board</option>
                                <option value="Cardboard">Cardboard</option>
                                <option value="Kraft Paper">Kraft Paper</option>
                                <option value="Corrugated">Corrugated</option>
                            </select>
                        </div>
                        <div class="iq-form-group">
                            <label>Color Options</label>
                            <select name="color">
                                <option value="">Color Options</option>
                                <option value="1 Color">1 Color</option>
                                <option value="2 Colors">2 Colors</option>
                                <option value="3 Colors">3 Colors</option>
                                <option value="Full Color">Full Color</option>
                            </select>
                        </div>
                        <div class="iq-form-group">
                            <label>Turn Around Time</label>
                            <select name="turn_around_time">
                                <option value="">Choose option</option>
                                <option value="Standard (8-10 Days)">Standard (8-10 Days)</option>
                                <option value="Rush (4-6 Days)">Rush (4-6 Days)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 5: Quantity & File Upload -->
                    <div class="iq-grid-2">
                        <div class="iq-form-group">
                            <label>Quantity *</label>
                            <input type="number" name="quantity" placeholder="Enter quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        </div>
                        <div class="iq-form-group">
                            <label>Upload File Here</label>
                            <div style="display: flex; align-items: center; border: 1px solid #E2D9D5; border-radius: 8px; overflow: hidden; background: #FFFFFF; height: 44px;">
                                <input type="file" name="quote_file" id="quote-file-input" style="display: none;" onchange="document.getElementById('quote-file-name').value = this.files[0] ? this.files[0].name : ''">
                                <input type="text" id="quote-file-name" placeholder="No file chosen" readonly style="flex: 1; padding: 0 14px; border: none; font-size: 14px; background: transparent; outline: none; color: #666; height: 100%;">
                                <button type="button" onclick="document.getElementById('quote-file-input').click()" style="background-color: var(--primary-color, #8D4445); color: white; border: none; padding: 0 20px; font-size: 14px; font-weight: 600; cursor: pointer; height: 100%; font-family: 'DM Sans', sans-serif;">Upload</button>
                            </div>
                        </div>
                    </div>

                    <!-- Row 6: Message -->
                    <div class="iq-form-group">
                        <label>Message</label>
                        <textarea name="message" rows="4" placeholder="Enter your message"></textarea>
                    </div>
                    
                    <!-- Submit button -->
                    <div style="text-align: center; margin-top: 10px;">
                        <button type="submit" style="background-color: var(--primary-color, #8D4445); color: white; border: none; border-radius: 6px; padding: 14px 40px; font-size: 16px; font-weight: 700; font-family: 'Open Sans', sans-serif; width: 100%; max-width: 320px; cursor: pointer; transition: background-color 0.2s ease;" onmouseover="this.style.backgroundColor='#6E3435'" onmouseout="this.style.backgroundColor='var(--primary-color, #8D4445)'">Get a Quote</button>
                    </div>
                </form>
            </div>

            <!-- Right sidebar section -->
            <div class="iq-page-sidebar">
                <!-- Box 1 -->
                <div class="iq-sidebar-card">
                    <h3>Why Request a Quote?</h3>
                    <p style="font-size: 14px; color: #000; line-height: 1.5; margin: 0;">No obligation. No pressure. Just a detailed proposal that helps you make an informed decision backed by 500+ successful brand partnerships.</p>
                </div>

                <!-- Box 2 -->
                <div class="iq-sidebar-card">
                    <h3 style="margin-bottom: 16px;">What Happens Next</h3>
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">1</div>
                            <p style="font-size: 14px; color: #000; margin: 0; line-height: 1.4;">We review your request within 4 business hours.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">2</div>
                            <p style="font-size: 14px; color: #000; margin: 0; line-height: 1.4;">A dedicated packaging specialist reaches out to clarify details.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">3</div>
                            <p style="font-size: 14px; color: #000; margin: 0; line-height: 1.4;">You receive a tailored quote with 3D mockups within 24 hours.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">4</div>
                            <p style="font-size: 14px; color: #000; margin: 0; line-height: 1.4;">We ship a complimentary sample kit for your evaluation.</p>
                        </div>
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="iq-sidebar-card">
                    <h3 style="margin-bottom: 16px;">Need Help Immediately?</h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary-color, #8D4445)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span style="font-size: 14px; color: #000;">1800-518-9441</span>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary-color, #8D4445)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span style="font-size: 14px; color: #000;">example@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')

</body>
</html>
