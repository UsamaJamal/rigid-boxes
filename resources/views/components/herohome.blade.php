<style>
    .category-hero-wrapper {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
        background: var(--header-gradient, linear-gradient(278.74deg, #AB5A5B 0.2%, #8D4445 44.25%, #5B2829 88.3%));
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .category-hero-wrapper::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        pointer-events: none;
        z-index: 0;
    }

    /* Diagonal artwork from the Figma hero. The image sits above this layer. */
    .hero-line {
        position: absolute;
        width: 450px;
        height: 0;
        border-top: 0.2px solid rgba(255, 255, 255, 0.28);
        transform-origin: left center;
        /* CSS uses the opposite visual direction to Figma's exported angle. */
        transform: rotate(52.86deg);
        top: 103px;
        pointer-events: none;
        z-index: 1;
    }
    .hero-line-1 { left: calc(50% - 720px + 345px); }
    .hero-line-2 { left: calc(50% - 720px + 422px); top: 104px; }
    .hero-line-3 { left: calc(50% - 720px + 499px); top: 104px; }
    .hero-line-4 { left: calc(50% - 720px + 576px); top: 104px; }
    .hero-line-5 { left: calc(50% - 720px + 653px); top: 104px; }
    .hero-line-6 { left: calc(50% - 720px + 730px); top: 104px; }

    .hero-section {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 8px 24px 0;
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 456px);
        align-items: center;
        gap: 70px;
        position: relative;
        z-index: 2;
        box-sizing: border-box;
    }

    .hero-content {
        max-width: 560px;
        position: relative;
        z-index: 2;
    }



    .hero-title {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: clamp(28px, 3.5vw, 50px);
        line-height: 65px;
        letter-spacing: 0%;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 14px;
        overflow-wrap: break-word;
    }

    .hero-title .highlight {
        color: #D4A872;
    }

    .hero-description {
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        max-width: 510px;
        margin-bottom: 32px;
        font-weight: 300;
    }

    .hero-btn {
        display: inline-block;
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        color: var(--primary-color, #8D4445);
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 700;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s, transform 0.2s;
    }

    .hero-btn:hover {
        background: var(--secondary-color, #F8EEEC);
        transform: translateY(-2px);
    }

    .hero-image-wrapper {
        display: flex;
        justify-content: flex-end;
        position: relative;
        z-index: 3;
    }

    .hero-image-wrapper img {
        width: 100%;
        max-width: 456px;
        height: 456px;
        border-radius: 16px;
        box-shadow: none;
        background-color: transparent;
        object-fit: contain;
        object-position: center;
    }

    @media (max-width: 1500px) and (min-width: 993px) {
        .hero-section {
            grid-template-columns: minmax(0, 1fr) minmax(320px, 38%);
            gap: 32px;
        }
        .hero-image-wrapper img {
            max-width: 100%;
            height: auto;
            aspect-ratio: 1 / 1;
        }
    }

    @media (max-width: 1200px) {
        .hero-line {
            display: none;
        }

        .hero-section {
            flex-direction: column;
            display: flex;
            padding: 30px 24px 24px;
            text-align: left;
            gap: 20px;
        }

        .hero-content {
            max-width: 100%;
        }

        .hero-title {
            font-size: 38px;
            line-height: 1.3;
        }

        .hero-image-wrapper {
            justify-content: center;
            width: 100%;
            margin-top: 10px;
        }

        .hero-image-wrapper img {
            width: 100%;
            height: auto;
            max-width: 450px;
            aspect-ratio: auto;
        }
    }

    @media (max-width: 576px) {

        .hero-section {
            padding: 24px 20px 16px;
            text-align: left;
        }

        .hero-title {
            font-size: 28px;
            line-height: 1.3;
            word-wrap: break-word;
        }

        .hero-description {
            font-size: 13px;
        }

    }
</style>

<!-- Hero Banner with gradient -->
<div class="category-hero-wrapper">
    <div class="hero-line hero-line-1" aria-hidden="true"></div>
    <div class="hero-line hero-line-2" aria-hidden="true"></div>
    <div class="hero-line hero-line-3" aria-hidden="true"></div>
    <div class="hero-line hero-line-4" aria-hidden="true"></div>
    <div class="hero-line hero-line-5" aria-hidden="true"></div>
    <div class="hero-line hero-line-6" aria-hidden="true"></div>


    <section class="hero-section">

        <div class="hero-content">
            <h1 class="hero-title">
                CUSTOM <span class="highlight">COSMETIC</span><br>PACKAGING BOXES
            </h1>

            <p class="hero-description">
                Crafted for prestige brands, our bespoke luxury boxes merge structural integrity with tactile sophistication. Redefining the unboxing experience through heritage craftsmanship and modern minimalism.
            </p>

            <a href="#" class="hero-btn">Design Custom Boxes</a>
        </div>

        <div class="hero-image-wrapper">
            <img src="{{ asset('uploads/hero-home-banner.png') }}" alt="Custom Cosmetic Packaging Boxes" onerror="this.src='https://placehold.co/600x500/222222/555555?text=Cosmetic+Boxes'">
        </div>
    </section>
</div>
