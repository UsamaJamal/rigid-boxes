<style>
    .testimonial-section {
        background: var(--secondary-color);
        padding: 20px 0;
        position: relative;
        font-family: 'DM Sans', sans-serif;
        overflow: visible;
    }
    .testimonial-container {
        max-width: 1440px;
        margin: 0 auto;
        position: relative;
        padding: 0 5%;
        overflow: visible;
    }
    .testimonial-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .testimonial-title {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        line-height: 100%;
        text-transform: capitalize;
        color: #111;
        margin-bottom: 12px;
    }
    .testimonial-subtitle {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 1.5;
        text-align: center;
        color: #333;
        max-width: 620px;
        margin: 0 auto;
    }

    /* Wrapper holds buttons + slider so buttons stay at edges of content area */
    .testimonial-slider-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        height: 250px;
        overflow: visible;
        width: 100%;
    }

    .testimonial-slider {
        display: flex;
        justify-content: center;
        gap: 30px;
        align-items: center;
        box-sizing: border-box;
        overflow: visible;
    }
    .testimonial-card {
        width: 512px;
        height: 206px;
        background: #0B0B0B;
        border-radius: 8px;
        position: relative;
        display: flex;
        align-items: center;
        padding: 20px 20px 20px 210px;
        color: #FFF;
        /* top+bottom margin = half the image overflow on each side:
           image 250px, card 206px → overflows 22px top + 22px bottom */
        /* Portrait overlaps above the card only; its bottom stays flush with the card. */
        margin: 44px 0 0;
        flex-shrink: 0;
        overflow: visible;
    }
    .testimonial-img {
        position: absolute;
        left: 30px;
        top: -44px;
        transform: none;
        width: 160px;
        height: 250px;
        border-radius: 16px 16px 0 0;
        object-fit: cover;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        /* sits above card's z context */
        z-index: 3;
    }
    .testimonial-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        position: relative;
        width: 100%;
    }
    .testimonial-stars {
        color: #F5C518;
        font-size: 14px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .testimonial-stars span {
        color: #CCC;
        font-size: 11px;
        margin-left: 8px;
    }
    .testimonial-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        line-height: 1.5;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 15px;
    }
    .testimonial-author {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        color: #FFF;
        margin-bottom: 4px;
    }
    .testimonial-role {
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        color: #999;
    }
    .testimonial-dots-icon {
        position: absolute;
        right: -20px;
        top: 28%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        background: #FFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        z-index: 2;
    }

    /* Buttons are siblings inside the wrapper, not inside the slider */
    .nav-btn {
        position: relative;
        margin-top: 44px; /* matches the card's margin to vertically align with the card center */
        width: 56px;
        height: 56px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFF;
        border: none;
        cursor: pointer;
        z-index: 10;
        transition: opacity 0.3s;
        flex-shrink: 0;
    }
    .nav-btn:hover {
        opacity: 0.8;
    }

    .pagination-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 50px;
    }
    .page-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #333;
        background: transparent;
        cursor: pointer;
    }
    .page-dot.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
    }

    /* Tablet — single card, hide second card */
    @media (max-width: 1200px) {
        .testimonial-slider {
            padding: 0;
            gap: 20px;
        }
        .testimonial-card {
            width: 100%;
            max-width: 512px;
        }
        .desktop-only {
            display: none !important;
        }
    }

    /* Mobile layout follows the supplied Figma single-card composition. */
    @media (max-width: 768px) {
        .testimonial-section { padding: 46px 0 36px; }
        .testimonial-container { padding: 0 5.5%; }
        .testimonial-header { margin-bottom: 67px; }
        .testimonial-title { font-size: 30px; line-height: 1.2; margin-bottom: 12px; }
        .testimonial-subtitle { max-width: 420px; font-size: 20px; line-height: 1.45; }
        .testimonial-slider-wrapper { height: auto; }
        .nav-btn { display: none; }
        .testimonial-slider { padding: 0; flex-direction: column; }
        .testimonial-card {
            width: 100%; max-width: 100%; height: 197px; min-height: 0;
            padding: 16px 15px 14px 196px; margin: 31px 0 0; box-sizing: border-box;
        }
        .testimonial-img { width: 145px; height: 228px; left: 22px; top: -31px; border-radius: 14px 14px 0 0; }
        .testimonial-dots-icon { right: -10px; top: 23%; width: 24px; height: 24px; }
        .testimonial-dots-icon svg { width: 12px; height: 3px; }
        .testimonial-text { font-size: 14px; line-height: 1.4; margin: 0 0 10px; }
        .testimonial-stars { font-size: 14px; margin-bottom: 9px; gap: 3px; }
        .testimonial-stars span { font-size: 11px; margin-left: 4px; }
        .testimonial-author { font-size: 15px; margin-bottom: 1px; }
        .testimonial-role { font-size: 11px; }
        .pagination-dots { gap: 6px; margin-top: 34px; }
        .page-dot { width: 14px; height: 14px; border-width: 2px; }
    }
</style>

<section class="testimonial-section">
    <div class="testimonial-container">
        <div class="testimonial-header">
            <h2 class="testimonial-title">What Our Clients Say</h2>
            <p class="testimonial-subtitle">Trusted by brands that value premium quality, reliable production, and luxury packaging that leaves a lasting impression.</p>
        </div>

        <div class="testimonial-slider-wrapper">
            <button class="nav-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>

            <div class="testimonial-slider">
            <!-- Card 1 -->
            <div class="testimonial-card">
                <img src="{{ asset('uploads/profile-image.jfif') }}" alt="Elisa Grant" class="testimonial-img">

                <div class="testimonial-content">
                    <div class="testimonial-stars">
                        ★ ★ ★ ★ ★ <span>5.0 rating</span>
                    </div>
                    <p class="testimonial-text">Excellent packaging quality and fast production. Our luxury product line now looks much more premium.</p>
                    <div class="testimonial-author">Elisa Grant</div>
                    <div class="testimonial-role">CEO, Urban Apparel</div>
                </div>

                <div class="testimonial-dots-icon">
                    <svg width="16" height="4" viewBox="0 0 16 4" fill="currentColor"><circle cx="2" cy="2" r="2"/><circle cx="8" cy="2" r="2"/><circle cx="14" cy="2" r="2"/></svg>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="testimonial-card desktop-only">
                <img src="{{ asset('uploads/profile-image.jfif') }}" alt="Elisa Grant" class="testimonial-img">

                <div class="testimonial-content">
                    <div class="testimonial-stars">
                        ★ ★ ★ ★ ★ <span>5.0 rating</span>
                    </div>
                    <p class="testimonial-text">Excellent packaging quality and fast production. Our luxury product line now looks much more premium.</p>
                    <div class="testimonial-author">Elisa Grant</div>
                    <div class="testimonial-role">CEO, Urban Apparel</div>
                </div>

                <div class="testimonial-dots-icon">
                    <svg width="16" height="4" viewBox="0 0 16 4" fill="currentColor"><circle cx="2" cy="2" r="2"/><circle cx="8" cy="2" r="2"/><circle cx="14" cy="2" r="2"/></svg>
                </div>
            </div>
            </div><!-- end .testimonial-slider -->

            <button class="nav-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </div><!-- end .testimonial-slider-wrapper -->

        <div class="pagination-dots">
            <div class="page-dot active"></div>
            <div class="page-dot"></div>
            <div class="page-dot"></div>
        </div>
    </div>
</section>
