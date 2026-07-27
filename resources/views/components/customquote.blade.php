<style>
    .quote-section {
        background: var(--primary-color);
        width: 100%;
        padding: 20px 0 54px;
        font-family: 'DM Sans', sans-serif;
        position: relative;
        overflow: hidden;
        margin-top: 20px;
    }

    .quote-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
        display: flex;
        align-items: stretch;
        gap: 40px;
        position: relative;
        z-index: 2;
    }

    /* ── Left column: form card ── */
    .quote-form-card {
        width: 739px;
        min-height: 712px;
        flex-shrink: 0;
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 46px 46px 46px 46px;
        box-sizing: border-box;
    }

    .quote-form-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: var(--section-text-color);
        text-align: center;
        margin-bottom: 28px;
    }

    /* Section labels */
    .form-section-label {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 15px;
        color: var(--primary-color);
        margin-bottom: 10px;
        margin-top: 22px;
    }
    .form-section-label:first-of-type {
        margin-top: 0;
    }

    /* Input rows */
    .form-row {
        display: flex;
        gap: 12px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-row input,
    .form-row select,
    .form-row textarea {
        flex: 1;
        min-width: 0;
        height: 44px;
        border: 1px solid var(--primary-color);
        border-radius: 6px;
        padding: 0 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        background: #FAFAFA;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
        appearance: none;
        -webkit-appearance: none;
    }

    .form-row input::placeholder,
    .form-row textarea::placeholder {
        color: #AAAAAA;
    }
    .form-row input:focus,
    .form-row select:focus,
    .form-row textarea:focus {
        border-color: var(--primary-color);
        background: #fff;
    }

    /* Select with custom arrow */
    .select-wrapper {
        flex: 1;
        min-width: 0;
        position: relative;
    }

    .select-wrapper select {
        width: 100%;
        min-width: 0;
        height: 44px;
        border: 1px solid var(--primary-color);
        border-radius: 6px;
        padding: 0 36px 0 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        background: #FAFAFA;
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s;
        box-sizing: border-box;
        appearance: none;
        -webkit-appearance: none;
    }
    .pref-input {
        width: 100%;
        min-width: 0;
        height: 44px;
        border: 1px solid var(--primary-color);
        border-radius: 6px;
        padding: 0 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        background: #FAFAFA;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }
    .pref-input:focus {
        border-color: var(--primary-color);
        background: #fff;
    }

    .select-wrapper::after {
        content: '';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid #666;
        pointer-events: none;
    }

    /* Box specs row: Width, Length, Depth + unit dropdown */
    .specs-row {
        display: flex;
        gap: 12px;
        width: 100%;
        box-sizing: border-box;
    }

    .specs-row input {
        flex: 1;
        min-width: 0;
        height: 44px;
        border: 1px solid var(--primary-color);
        border-radius: 6px;
        padding: 0 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        background: #FAFAFA;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .specs-row input::placeholder {
        color: #AAAAAA;
    }

    .specs-row input:focus {
        border-color: var(--primary-color);
        background: #fff;
    }

    .specs-unit {
        position: relative;
        width: 72px;
        flex-shrink: 0;
    }

    .specs-unit select {
        width: 100%;
        height: 44px;
        border: 1px solid var(--primary-color);
        border-radius: 6px;
        padding: 0 24px 0 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        background: #FAFAFA;
        outline: none;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        box-sizing: border-box;
    }

    .specs-unit::after {
        content: '';
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid #666;
        pointer-events: none;
    }

    .preferences-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        width: 100%;
    }

    /* Textarea row */
    .textarea-row {
        width: 100%;
    }

    .textarea-row textarea {
        width: 100%;
        height: 128px;
        border: 1px solid var(--primary-color);
        border-radius: 8px;
        padding: 12px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #333;
        background: #FAFAFA;
        outline: none;
        resize: vertical;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .textarea-row textarea::placeholder {
        color: #AAAAAA;
    }

    .textarea-row textarea:focus {
        border-color:0.4px var(--primary-color);
        background: #fff;
    }

    /* Submit button */
    .quote-btn-wrap {
        display: flex;
        justify-content: center;
        margin-top: 24px;
    }

    .quote-submit-btn {
        width: 284px;
        height: 50px;
        background: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 12px 20px;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.2s;
        letter-spacing: 0.3px;
    }

    .quote-submit-btn:hover {
        opacity: 0.88;
    }

    /* ── Right column: steps ── */
    .quote-steps {
        flex: 1;
        padding-top: 57px;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .quote-step {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        /* padding-bottom removed */
        position: relative;
    }

    .quote-step:not(:last-child) {
        flex-grow: 1;
        padding-bottom: 40px;
    }

    .quote-step:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 36px;
        top: 73px;
        bottom: 0;
        width: 1px;
        background: rgba(255, 255, 255, 0.15);
        z-index: 0;
    }

    /* Vertical connecting line through all steps */
    .quote-steps-inner {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .step-number-block {
        position: relative;
        flex-shrink: 0;
        width: 117px;
    }

    /* White box with step number */
    .step-num-box {
        width: 73.33px;
        height: 73.33px;
        angle: 0 deg;
          opacity: 1;
           background: #fff;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-color);
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }

    /* Ghost number — sits directly behind the box, slightly to the right */
    .step-ghost-num {
        position: absolute;
        left: 85px;
        top: -12px;
        font-family: 'Open Sans', sans-serif;
        font-size: 80px;
        font-weight: 900;
        color: rgba(255, 255, 255, 0.15);
        line-height: 1;
        pointer-events: none;
        z-index: 1;
        user-select: none;
    }

    .step-text {
        flex: 1;
        padding-top: 6px;
    }

    .step-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 18px;
        font-weight: 800;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .step-desc {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.75);
    }

    /* ── Responsive ── */
    @media (max-width: 1280px) {
        .quote-container {
            padding: 0 24px;
            gap: 30px;
        }
        .quote-form-card {
            width: 600px;
        }
        .quote-steps {
            width: auto;
            flex: 1;
        }
    }

    @media (max-width: 992px) {
        .quote-section {
            padding: 40px 0 50px;
            margin-top: 0;
        }
        .quote-container {
            flex-direction: column-reverse;
            padding: 0 24px;
            align-items: stretch;
        }
        .quote-form-card {
            width: 100%;
            min-height: unset;
        }
        .quote-steps {
            width: 100%;
            padding-top: 0;
            padding-bottom: 40px;
        }
        .quote-steps-inner {
            height: auto;
        }
        .quote-step {
            padding-bottom: 28px;
        }
    }

    @media (max-width: 576px) {
        .quote-section {
            padding: 30px 0;
        }
        .quote-container {
            padding: 0 20px;
        }
        .quote-form-card {
            padding: 10px 14px 16px;
            border-radius: 18px;
        }
        .quote-form-title {
            font-size: 19px;
            line-height: 1.3;
            margin: 0 0 10px;
        }
        .form-section-label {
            font-size: 14px;
            margin: 11px 0 8px;
        }
        .form-row {
            flex-direction: column;
            gap: 11px;
        }
        .form-row input,
        .textarea-row textarea {
            width: 100%;
        }
        .specs-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 11px 8px;
        }
        .specs-row input,
        .specs-unit {
            width: 100%;
        }
        .preferences-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 11px 8px;
        }
        .form-row input,
        .form-row select,
        .specs-row input,
        .specs-unit select,
        .preferences-grid select {
            height: 37px;
            padding-left: 12px;
            font-size: 12px;
        }
        .form-row input,
        .form-row select,
        .form-row textarea {
            flex: 0 0 37px;
        }
        .specs-unit,
        .select-wrapper {
            width: 100%;
        }
        .select-wrapper::after {
            right: 10px;
        }
        .textarea-row textarea {
            height: 66px;
            padding: 11px 12px;
            font-size: 12px;
        }
        .quote-btn-wrap {
            margin-top: 13px;
        }
        .quote-submit-btn {
            width: 90%;
            height: 38px;
            font-size: 13px;
        }
        .step-title {
            font-size: 16px;
        }
        .step-ghost-num {
            font-size: 64px;
        }
    }</style>

<section class="quote-section">
    <div class="quote-container">

        <!-- Left: Form Card -->
        <div class="quote-form-card">
            <form action="{{ url('/submit-quote') }}" method="POST">
                @csrf
            <h2 class="quote-form-title">Get Custom Quote</h2>

            <!-- Contact Information -->
            <p class="form-section-label">Contact Information</p>
            <div class="form-row">
                <input type="text" name="name" placeholder="Enter your name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="tel" name="phone" placeholder="Enter your number" oninput="this.value = this.value.replace(/[^0-9+\-\s()]/g, '')" required>
            </div>

            <!-- Box Specifications -->
            <p class="form-section-label">Box Specifications</p>
            <div class="specs-row">
                <input type="number" name="width" placeholder="Width" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                <input type="number" name="length" placeholder="Length" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                <input type="number" name="depth" placeholder="Depth" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                <div class="specs-unit">
                    <select name="units" required>
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="in">in</option>
                    </select>
                </div>
            </div>

            <!-- Packaging Preferences -->
            <p class="form-section-label">Packaging Preferences</p>
            <div class="preferences-grid">
                <div class="select-wrapper">
                    @php
                        $boxStyleParent = \Illuminate\Support\Facades\DB::table('admin_categories')->where('slug', 'box-by-style')->first();
                        $boxStyles = $boxStyleParent ? \Illuminate\Support\Facades\DB::table('admin_categories')->where('parent_id', $boxStyleParent->id)->get() : [];
                    @endphp
                    <select name="box_style">
                        <option value="" disabled selected>Select Your Box Style</option>
                        @foreach($boxStyles as $style)
                            <option value="{{ $style->title }}">{{ $style->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-wrapper">
                    <select name="material">
                        <option value="" disabled selected>Select Paper Stock</option>
                        <option>12pt Cardboard Stock</option>
                        <option>14pt Cardboard Stock</option>
                        <option>16pt Cardboard Stock</option>
                        <option>18pt Cardboard Stock</option>
                        <option>20pt Cardboard Stock</option>
                        <option>22pt Cardboard Stock</option>
                        <option>24pt Cardboard Stock</option>
                        <option>Kraft Stock</option>
                        <option>Recycled BuxBoard</option>
                        <option>Corrugated Stock</option>
                        <option>No Printing Required</option>
                    </select>
                </div>
                <div class="select-wrapper">
                    <select name="color">
                        <option value="" disabled selected>Select Color</option>
                        <option>1 color</option>
                        <option>2 color</option>
                        <option>3 color</option>
                        <option>4 color</option>
                        <option>4/1 color</option>
                        <option>4/2 color</option>
                        <option>4/3 color</option>
                        <option>4/4 color</option>
                    </select>
                </div>
                <div class="select-wrapper">
                    <select name="paper_coating">
                        <option value="" disabled selected>Select Paper Coating</option>
                        <option>Aqueous Coating</option>
                        <option>Semi Gloss</option>
                        <option>Gloss UV</option>
                        <option>Matte UV</option>
                        <option>Semi Matte</option>
                    </select>
                </div>
                <div class="select-wrapper">
                    <select name="cad_sample">
                        <option value="" disabled selected>Select CAD Sample</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="input-wrapper" style="flex: 1; min-width: 0;">
                    <input type="number" name="quantity" class="pref-input" placeholder="Enter Units (Quantity)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>
            </div>

            <!-- Additional Details -->
            <p class="form-section-label">Additional Details</p>
            <div class="textarea-row">
                <textarea name="message" placeholder="Enter your message"></textarea>
            </div>

            <!-- Submit -->
            <div class="quote-btn-wrap">
                <button type="submit" class="quote-submit-btn">Get Free Quote</button>
            </div>
            </form>
        </div>

        <!-- Right: Steps -->
        <div class="quote-steps">
            <div class="quote-steps-inner">

                <div class="quote-step">
                    <div class="step-number-block">
                        <div class="step-num-box">01</div>
                        <span class="step-ghost-num">1</span>
                    </div>
                    <div class="step-text">
                        <div class="step-title">Share Requirements</div>
                        <p class="step-desc">Share your box style, size, quantity, and design preferences. Our team will recommend the best packaging solution for your needs.</p>
                    </div>
                </div>

                <div class="quote-step">
                    <div class="step-number-block">
                        <div class="step-num-box">02</div>
                        <span class="step-ghost-num">2</span>
                    </div>
                    <div class="step-text">
                        <div class="step-title">Approve Design</div>
                        <p class="step-desc">Receive a custom artwork and 3D mockup for review. Once approved, we'll prepare everything for production.</p>
                    </div>
                </div>

                <div class="quote-step">
                    <div class="step-number-block">
                        <div class="step-num-box">03</div>
                        <span class="step-ghost-num">3</span>
                    </div>
                    <div class="step-text">
                        <div class="step-title">Production</div>
                        <p class="step-desc">Your packaging is produced using premium materials and carefully inspected to ensure exceptional quality and flawless finishing.</p>
                    </div>
                </div>

                <div class="quote-step">
                    <div class="step-number-block">
                        <div class="step-num-box">04</div>
                        <span class="step-ghost-num">4</span>
                    </div>
                    <div class="step-text">
                        <div class="step-title">Fast Delivery</div>
                        <p class="step-desc">Your custom packaging is securely packed and delivered to your doorstep on time.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
