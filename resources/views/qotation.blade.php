@include('components.header')
<body style="font-family: 'DM Sans', sans-serif;">
    

    <style>
        .quote-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px 60px;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: center;
        }
        .quote-form-card {
            flex: 1 1 650px;
            max-width: 750px;
            width: 100%;
            background-color: #F8F4F2;
            padding: 40px;
            border-radius: 16px;
            box-sizing: border-box;
        }
        .quote-sidebar {
            width: 350px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-sizing: border-box;
        }
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
        }
        .form-grid-4 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 992px) {
            .quote-form-card {
                max-width: 100%;
            }
            .form-grid-4 {
                grid-template-columns: 1fr 1fr;
            }
            .form-grid-3 {
                grid-template-columns: 1fr 1fr;
            }
            .quote-sidebar {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .quote-container {
                padding: 0 15px 40px;
                gap: 20px;
            }
            .quote-form-card {
                padding: 24px 16px;
                width: 100%;
            }
            .form-grid-2,
            .form-grid-3,
            .form-grid-4 {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }
    </style>

    <main class="main-content">
        <div style="max-width: 1400px; margin: 0 auto; padding: 15px 20px; text-align: center;">
            <div style="text-align: left; margin-bottom: 40px; font-size: 12px; font-weight: 700; color: var(--primary-color, #8D4445); letter-spacing: 0.1em; text-transform: uppercase;">
                HOME / <span style="color: var(--section-text-color, #000000);">GET INSTANT QUOTE</span>
            </div>
            <h1 style="color: var(--section-text-color, #000000); font-weight: 800; margin-bottom: 16px;">
                Request Your Free Custom Quote
            </h1>
            <p style="color: var(--section-text-color, #000000); font-size: 15px; max-width: 550px; margin: 0 auto 40px; line-height: 1.6;">
                Fill in the details below and receive a tailored estimate within minutes. No steps, just straightforward.
            </p>
        </div>
        <div class="quote-container">
            <!-- Left form section -->
            <div class="quote-form-card">
                <h2 style="font-size: 28px; font-weight: 800; text-align: center; margin-bottom: 30px;">Instant Quotes, Quick Service!</h2>
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- Row 1 -->
                    <div class="form-grid-2">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Name *</label>
                            <input type="text" placeholder="Enter your name" oninput="this.value = this.value.replace(/[0-9]/g, '')" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Email Address *</label>
                            <input type="email" placeholder="Enter your email" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                    </div>
                    <!-- Row 2 -->
                    <div class="form-grid-2">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Phone *</label>
                            <input type="tel" placeholder="Enter your number" oninput="this.value = this.value.replace(/[^0-9+\- ]/g, '')" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Physical Address</label>
                            <input type="text" placeholder="Enter your address" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                    </div>
                    <!-- Row 3 -->
                    <div class="form-grid-4">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Width *</label>
                            <input type="text" placeholder="Width" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Length *</label>
                            <input type="text" placeholder="Length" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Depth *</label>
                            <input type="text" placeholder="Depth" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Units *</label>
                            <select style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                                <option value="mm">mm</option>
                                <option value="cm">cm</option>
                                <option value="inches">inches</option>
                            </select>
                        </div>
                    </div>
                    <!-- Row 4 -->
                    <div class="form-grid-3">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Select Material</label>
                            <select style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                                <option value="">Choose option</option>
                            </select>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Color Options</label>
                            <select style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                                <option value="">Color Options</option>
                                <option value="1 Color">1 Color</option>
                                <option value="2 Colors">2 Colors</option>
                                <option value="3 Colors">3 Colors</option>
                                <option value="Full Color">Full Color</option>
                            </select>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Turn Around Time</label>
                            <select style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                                <option value="">Choose option</option>
                            </select>
                        </div>
                    </div>
                    <!-- Row 5 -->
                    <div class="form-grid-2">
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Quantity *</label>
                            <input type="number" placeholder="Enter quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label style="font-size: 14px; font-weight: 600;">Upload File Here</label>
                            <div style="display: flex; align-items: center; border: 1px solid #E2D9D5; border-radius: 8px; overflow: hidden; background: transparent;">
                                <input type="text" placeholder="No file choosen" readonly style="flex: 1; padding: 12px 16px; border: none; font-size: 14px; background: transparent; outline: none; color: #666;">
                                <button type="button" style="background-color: var(--primary-color, #8D4445); color: white; border: none; padding: 12px 24px; font-size: 14px; font-weight: 600; cursor: pointer; height: 100%;">Upload</button>
                            </div>
                        </div>
                    </div>
                    <!-- Row 6 -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label style="font-size: 14px; font-weight: 600;">Message</label>
                        <textarea rows="4" placeholder="Enter your message" style="padding: 12px 16px; border: 1px solid #E2D9D5; border-radius: 8px; font-size: 14px; background: transparent; resize: vertical;"></textarea>
                    </div>
                    
                    <!-- Submit -->
                    <div style="text-align: center; margin-top: 10px;">
                        <button type="submit" style="background-color: var(--primary-color, #8D4445); color: white; border: none; border-radius: 4px; padding: 14px 40px; font-size: 16px; font-weight: 700; width: 100%; max-width: 300px; cursor: pointer;">Get a Quote</button>
                    </div>
                </form>
            </div>

            <!-- Right sidebar section -->
            <div class="quote-sidebar">
                <!-- Box 1 -->
                <div style="background-color: #F5F5F5; padding: 24px; border-radius: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 12px;">Why Request a Quote?</h3>
                    <p style="font-size: 14px; color: #555; line-height: 1.5; margin: 0;">No obligation. No pressure. Just a detailed proposal that helps you make an informed decision backed by 500+ successful brand partnerships.</p>
                </div>

                <!-- Box 2 -->
                <div style="background-color: #F5F5F5; padding: 24px; border-radius: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 16px;">What Happens Next</h3>
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">1</div>
                            <p style="font-size: 14px; color: #555; margin: 0; line-height: 1.4;">We review your request within 4 business hours.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">2</div>
                            <p style="font-size: 14px; color: #555; margin: 0; line-height: 1.4;">A dedicated packaging specialist reaches out to clarify details.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">3</div>
                            <p style="font-size: 14px; color: #555; margin: 0; line-height: 1.4;">You receive a tailored quote with 3D mockups within 24 hours.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="background-color: var(--primary-color, #8D4445); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">4</div>
                            <p style="font-size: 14px; color: #555; margin: 0; line-height: 1.4;">We ship a complimentary sample kit for your evaluation.</p>
                        </div>
                    </div>
                </div>

                <!-- Box 3 -->
                <div style="background-color: #F5F5F5; padding: 24px; border-radius: 12px;">
                    <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 16px;">Need Help Immediately?</h3>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary-color, #8D4445)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span style="font-size: 14px; color: #555;">1800-518-9441</span>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--primary-color, #8D4445)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span style="font-size: 14px; color: #555;">example@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>
</html>
