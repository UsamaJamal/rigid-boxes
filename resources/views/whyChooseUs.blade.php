@include('components.header')
@include('components.inner-hero', ['page' => 'whyChooseUs'])
<style>
    /* =========================================
       Global Box Sizing (Fixes 100% overflow)
       ========================================= */
    .why-us-section *,
    .trust-us-section *,
    .sustainable-section * {
        box-sizing: border-box;
    }

    /* =========================================
       SECTION 1: Craftsmanship Meets Precision
       ========================================= */
    .why-us-section {
        padding: 20px 0 80px 0;
        background-color: #faf9f9;
        display: flex;
        justify-content: center;
        overflow: hidden;
    }

    .why-us-section .container {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 5%;
        overflow: hidden;
    }

    .why-us-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        flex-wrap: wrap;
        overflow: hidden;
    }

    .why-us-image {
        flex: 1;
        min-width: 0;
        display: flex;
        justify-content: flex-start;
    }

    .why-us-image img {
        width: 100%;
        max-width: 596px;
        height: auto;
        aspect-ratio: 596 / 552;
        border-radius: 20px;
        object-fit: cover;
    }

    .why-us-text {
        flex: 1;
        min-width: 0;
        max-width: 522px;
    }

    .why-us-text h2 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        line-height: 40px;
        letter-spacing: -0.32px;
        color: var(--section-text-color, #000);
        margin-top: 0;
        margin-bottom: 24px;
    }

    .why-us-text p {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        text-align: justify;
        color: var(--section-text-color, #000);
        margin: 0;
    }

    /* =========================================
       SECTION 2: Why Brands Trust Us
       ========================================= */
    .trust-us-section {
        background-color: var(--secondary-color);
        padding: 20px 0 80px 0; /* Padding top 20px */
    }

    .trust-us-container {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 5%;
    }

    .trust-us-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .trust-us-header h2 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        color: var(--section-text-color);
        margin-bottom: 15px;
        margin-top: 0;
    }

    .trust-us-header p {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        color: var(--section-text-color);
        margin: 0;
        line-height: 1.5;
    }

    .trust-us-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .trust-card {
        background: #FFFFFF;
        border: 0.5px solid #8D4445;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .trust-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(141, 68, 69, 0.1);
    }

    .trust-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: var(--secondary-color);
        margin-bottom: 24px;
    }

    .trust-icon img {
        max-width: 35px;
        max-height: 35px;
        object-fit: contain;
    }

    .trust-card h3 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        line-height: 19.2px;
        color: var(--section-text-color);
        margin-bottom: 12px;
        margin-top: 0;
    }

    .trust-card p {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 21.7px;
        letter-spacing: 0.23px;
        color: var(--section-text-color);
        margin: 0;
    }

    /* =========================================
       SECTION 3: Sustainable Packaging
       ========================================= */
    .sustainable-section {
        padding: 20px 0 80px 0; /* Padding top 20px */
        background-color: #ffffff;
        display: flex;
        justify-content: center;
    }

    .sustainable-section .container {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 5%;
    }

    .sustainable-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
        flex-wrap: wrap;
    }

    .sustainable-content {
        flex: 1;
        min-width: 0;
        max-width: 522px;
    }

    .sustainable-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }

    .sustainable-badge span {
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
        letter-spacing: 1.6px;
        text-transform: uppercase;
        color: #166534;
    }

    .sustainable-content h2 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        color: var(--section-text-color, #000);
        margin: 0 0 24px 0;
    }

    .sustainable-content p {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        text-align: justify;
        color: var(--section-text-color, #000);
        margin: 0;
    }

    .sustainable-icons {
        display: flex;
        gap: 32px;
        padding-top: 24px;
    }

    .icon-box {
        width: 64px;
        height: 64px;
        border: 1px solid rgba(116, 120, 120, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
        color: var(--section-text-color);
    }

    .sustainable-image {
        flex: 1;
        min-width: 0;
        display: flex;
        justify-content: flex-end;
    }

    .sustainable-image img {
        width: 100%;
        max-width: 493px;
        height: auto;
        aspect-ratio: 493 / 448;
        border-radius: 20px;
        object-fit: cover;
    }

    /* =========================================
       Responsive Styles
       ========================================= */
    @media (max-width: 991px) {
        .why-us-content, .sustainable-wrapper {
            flex-direction: column;
            text-align: left;
        }

        .sustainable-wrapper {
            flex-direction: column-reverse;
        }

        .why-us-image, .sustainable-image {
            justify-content: center;
            width: 100%;
            min-width: 0;
        }

        .why-us-image img,
        .sustainable-image img {
            max-width: 100%;
        }

        .why-us-text, .sustainable-content {
            max-width: 100%;
            min-width: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .why-us-text p, .sustainable-content p {
            text-align: left;
        }

        .trust-us-container {
            padding: 0 7.25%;
        }

        .trust-us-grid {
            grid-template-columns: 1fr;
        }

        .trust-card {
            width: 100%;
            aspect-ratio: 352.23 / 200.55;
            margin: 0 auto;
            border-radius: 13.25px;
            border-width: 0.47px;
            padding: 26.5px 20.82px 24.6px 20.82px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    }

    @media (max-width: 680px) {
        .trust-us-grid {
            grid-template-columns: 1fr !important;
            gap: 16px;
        }
    }

    @media (max-width: 767px) {
        /* Section 2: stack image + text, prevent overflow */
        .why-us-section .container,
        .sustainable-section .container {
            padding: 0 5%;
            overflow: hidden;
        }

        .why-us-content {
            gap: 32px;
        }

        .why-us-image {
            width: 100%;
            min-width: 0;
        }

        .why-us-image img {
            width: 100%;
            max-width: 100%;
            height: auto;
            border-radius: 12px;
        }

        .why-us-text {
            width: 100%;
            min-width: 0;
            max-width: 100%;
        }

        .why-us-text h2 {
            font-size: 24px;
            line-height: 32px;
            margin-bottom: 16px;
            text-align: left;
        }

        .why-us-text p {
            font-size: 15px;
            line-height: 24px;
            text-align: justify; /* Figma paragraph might be justified or left, usually paragraph looks better left/justify */
        }

        /* Trust cards: 1 per row */
        .trust-us-grid {
            grid-template-columns: 1fr !important;
            gap: 16px;
        }

        .trust-us-header h2 {
            font-size: 24px;
        }

        .trust-us-header p {
            font-size: 14px;
        }

        .trust-card {
            /* Inherit exact dimensions and padding from 991px */
        }

        .trust-icon {
            width: 76px;
            height: 76px;
            margin-bottom: 20px;
        }

        .trust-icon img {
            max-width: 40px;
            max-height: 40px;
        }

        .trust-card h3 {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
        }

        .trust-card p {
            font-size: 14px;
            line-height: 1.5;
            text-align: center;
        }

        .trust-us-header p br {
            display: none;
        }

        /* Section 3: sustainable */
        .sustainable-wrapper {
            gap: 32px;
        }

        .sustainable-content {
            min-width: 0;
            width: 100%;
        }

        .sustainable-content h2 {
            font-size: 24px;
        }

        .sustainable-content p {
            font-size: 15px;
            text-align: left;
        }

        .sustainable-icons {
            justify-content: flex-start;
        }
    }

    @media (max-width: 480px) {
        .why-us-text p,
        .sustainable-content p {
            font-size: 14px;
        }

        .why-us-text h2,
        .sustainable-content h2 {
            font-size: 22px;
        }
    }
</style>
<!-- Section 1: Craftsmanship -->
<section class="why-us-section">
    <div class="container">
        <div class="why-us-content">
            <div class="why-us-image">
                <img src="{{ asset('uploads/craftmenship.png') }}" alt="Why Us">
            </div>
            <div class="why-us-text">
                <h2>Craftsmanship Meets Scalable Precision</h2>
                <p>Unlike standard mass-production manufacturers, we approach every project with the creativity and attention to detail of a dedicated packaging studio. From the initial concept to final production, our experienced team works closely with you to develop custom packaging that reflects your brand's identity while meeting the highest quality standards. With in-house design support, competitive factory-direct pricing, flexible order quantities, and efficient production timelines, we deliver premium packaging solutions that grow alongside your business.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Why Brands Trust Us -->
<section class="trust-us-section">
    <div class="trust-us-container">
        <div class="trust-us-header">
            <h2>Why Brands Trust Us</h2>
            <p>Every advantage is designed to make your packaging procurement seamless,<br>cost-effective, and world-class.</p>
        </div>
        <div class="trust-us-grid">
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/no-die-plate-charges.svg') }}" alt="No Die & Plate Charges">
                </span>
                <h3>No Die & Plate Charges</h3>
                <p>No added tooling fees, just straightforward pricing</p>
            </div>

            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/customer-satisfaction.svg') }}" alt="Customer Satisfaction">
                </span>
                <h3>Customer Satisfaction</h3>
                <p>Built on trust, quality, and long term partnerships.</p>
            </div>

            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/low-minimum-order-quantity.svg') }}" alt="Low Minimum Order Quantity">
                </span>
                <h3>Low Minimum Order Quantity</h3>
                <p>Flexible quantities to suit every business stage.</p>
            </div>

            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/free-shipping.svg') }}" alt="Free Shipping">
                </span>
                <h3>Free Shipping</h3>
                <p>No shipping costs, no last-minute surprises.</p>
            </div>

            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/free-graphic-design.svg') }}" alt="Free Graphic Design">
                </span>
                <h3>Free Graphic Design</h3>
                <p>Professional designs at no extra cost.</p>
            </div>

            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/fast-turn-around.svg') }}" alt="Fast Turnaround Time">
                </span>
                <h3>Fast Turnaround Time</h3>
                <p>Quick production with consistent quality.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Sustainable Packaging (Footer Se Pehle) -->
<section class="sustainable-section">
    <div class="container">
        <div class="sustainable-wrapper">
            <div class="sustainable-content">
                <div class="sustainable-badge">
                    <img src="{{ asset('uploads/ethically-manufactured.svg') }}" alt="Ethically Manufactured" width="20" height="20">
                    <span>ETHICALLY MANUFACTURED</span>
                </div>
                <h2>Sustainable Packaging</h2>
                <p>Every box is produced with responsibly sourced materials, recyclable paperboard, and eco-friendly inks. We combine premium craftsmanship with sustainable practices to help your brand reduce its environmental impact without compromising on quality.</p>
                <div class="sustainable-icons">
                    <div class="icon-box">FSC</div>
                    <div class="icon-box">ISO</div>
                    <div class="icon-box">PEFC</div>
                </div>
            </div>
            <div class="sustainable-image">
                <img src="{{ asset('uploads/sustainable-packaging.png') }}" alt="Sustainable Packaging">
            </div>
        </div>
    </div>
</section>

@include('components.faq')
@include('components.cta')
@include('components.footer')
