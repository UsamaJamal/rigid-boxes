<style>
    /* ─────────────────────────────────────────
       CTA BANNER SECTION
    ───────────────────────────────────────── */
    .cta-section {
        background: var(--background-color);
        padding: 0 0 80px;
    }

    .cta-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 5%;
    }

    .cta-banner {
        width: 100%;
        display: flex;
        position: relative;
    }

    .cta-text-card {
        width: 100%;
        min-height: 449px;
        background: linear-gradient(177.63deg, #DB9E9F 1.99%, #8D4445 93.3%);
        border-radius: 40px;
        padding: 47px 86px 47px 640px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Large circle — bottom right, partially off-edge */
    .cta-text-card::before {
        display: none;
    }

    /* Smaller circle — above the large one, right side */
    .cta-text-card::after {
        display: none;
    }

    .cta-ellipse {
        position: absolute;
        pointer-events: none;
        user-select: none;
    }

    /* Ellipse-793: large, bottom-right, partially clipped off right edge */
    .cta-ellipse-1 {
        width: 240px;
        height: 240px;
        bottom: -70px;
        right: -60px;
    }

    /* Ellipse-794: smaller, sits on top of the large circle */
    .cta-ellipse-2 {
        width: 140px;
        height: 140px;
        bottom: 10px;
        right: 20px;
    }

    .cta-heading {
        font-family: 'Open Sans', sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .cta-desc {
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.6;
        margin-bottom: 32px;
        max-width: 480px;
    }

    .cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: var(--section-text-color);
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        font-weight: 700;
        padding: 14px 28px;
        border-radius: 4px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        width: fit-content;
        align-self: flex-start;
        flex-shrink: 0;
        transition: opacity 0.2s;
    }

    .cta-btn:hover {
        opacity: 0.9;
    }

    .cta-image-wrapper {
        position: absolute;
        left: 86px;
        top: 47px;
        width: 512px;
        height: 355px;
        overflow: hidden;
    }

    .cta-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
    }

    @media (max-width: 1100px) {
        .cta-text-card {
            padding: 47px 40px 47px 460px;
        }
        .cta-image-wrapper {
            left: 40px;
            top: 47px;
            width: 380px;
            height: 263px;
        }
    }

    @media (max-width: 992px) {
        .cta-banner {
            flex-direction: column;
            max-width: 412px;
            margin: 0 auto;
        }
        /* Single card layout: image top, text bottom */
        .cta-image-wrapper {
            position: relative;
            left: auto;
            top: auto;
            width: 100%;
            height: 280px;
            order: 1;
            z-index: 1;
            margin-bottom: 0;
        }
        .cta-text-card {
            order: 2;
            padding: 36px 32px 40px;
            border-radius: 0 0 40px 40px;
            min-height: unset;
            align-self: stretch;
        }
        /* Mobile circles repositioned */
        .cta-ellipse-1 {
            width: 200px;
            height: 200px;
            bottom: -60px;
            right: -50px;
        }
        .cta-ellipse-2 {
            width: 120px;
            height: 120px;
            bottom: 20px;
            right: 10px;
        }
    }

    @media (max-width: 576px) {
        .cta-section {
            padding: 0 0 50px;
        }
        .cta-banner {
            max-width: 100%;
        }
        .cta-image-wrapper {
            width: 100%;
            height: 260px;
        }
        .cta-text-card {
            padding: 28px 24px 36px;
        }
        .cta-ellipse-1 {
            width: 170px;
            height: 170px;
            bottom: -50px;
            right: -40px;
        }
        .cta-ellipse-2 {
            width: 100px;
            height: 100px;
            bottom: 16px;
            right: 8px;
        }
        .cta-heading {
            font-size: 26px;
        }
        .cta-desc {
            font-size: 14px;
        }
    }
</style>

<section class="cta-section">
    <div class="cta-container">
        <div class="cta-banner">
            <div class="cta-text-card">
                <img src="{{ asset('uploads/Ellipse-793.png') }}" alt="" class="cta-ellipse cta-ellipse-1">
                <img src="{{ asset('uploads/Ellipse-794.png') }}" alt="" class="cta-ellipse cta-ellipse-2">
                <h2 class="cta-heading">Get Your Custom Packaging<br>Today</h2>
                <p class="cta-desc">Deliver elegance, protection, and a memorable unboxing experience with fully customized rigid box solutions.</p>
                <a href="#" class="cta-btn">
                    Get Started Today
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 8h10M9 4l4 4-4 4"/>
                    </svg>
                </a>
            </div>
            <div class="cta-image-wrapper">
                <img src="{{ asset('uploads/image-frame.png') }}" alt="Image Frame" onerror="this.src='https://placehold.co/512x355/2a2a2a/888888?text=Custom+Packaging'">
            </div>
        </div>
    </div>
</section>
