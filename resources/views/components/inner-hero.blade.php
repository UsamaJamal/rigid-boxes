@php
    $breadcrumb = 'ABOUT US';
    $subTitle = 'ABOUT US';
    $mainTitle = 'More Than Boxes,<br><span class="gold-text">We Build Experiences.</span>';
    $description = "At The Rigid Boxes, we believe packaging is more than protection <br class=\"desktop-br\"> it's the first impression, the unboxing moment, and the story <br class=\"desktop-br\"> behind every brand.";

    if (isset($page) && $page == 'whyChooseUs') {
        $breadcrumb = 'WHY CHOOSE US';
        $subTitle = 'WHY CHOOSE US';
        $description = 'From premium materials to precision craftsmanship, every box is designed to protect your products, strengthen your brand, and create unforgettable unboxing experiences.';
        $desktopBg = asset('uploads/whychoose-us-banner.png');
        $mobileBg  = asset('uploads/whychoose-us-banner-mobile-view.png');
    } else {
        $desktopBg = asset('uploads/about-us-banner.webp');
        $mobileBg  = asset('uploads/whychoose-us-banner-mobile-view.png');
    }
@endphp

<style>
    .inner-hero-section {
        background: var(--header-gradient, #8D4445);
        background-image: url('{{ $desktopBg }}');
        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        color: #FFFFFF;
        font-family: 'Open Sans', sans-serif;
        max-width: 1440px;
        margin: 0 auto;
    }

    .inner-hero-section * {
        box-sizing: border-box;
    }

    .inner-hero-container {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 40px 55px;
        min-height: 0;
        display: flex;
        align-items: center;
    }

    .inner-hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
    }

    .inner-hero-breadcrumb {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        color: #FFFFFF;
        text-align:left !important
    }

    .inner-hero-breadcrumb span {
        color: #ffffff;
        font-weight: 700;
    }

    .inner-hero-subtitle {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        text-transform: uppercase;
        color: #ffffff;
    }

    .inner-hero-title {
        font-size: 42px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 20px;
        color: #ffffff;
    }

    .inner-hero-title span.gold-text {
        color: #DDA77B;
    }

    .inner-hero-desc {
        font-size: 16px;
        line-height: 1.6;
        color: #f0f0f0;
    }

    @media (max-width: 1100px) {
        .inner-hero-section {
            background-image: none !important;
            background: #6C2223;
        }
        
        .inner-hero-container {
            background-image: url('{{ $mobileBg }}') !important;
            background-position: bottom center !important;
            background-size: 100% auto !important;
            background-repeat: no-repeat;
            padding: 40px 24px 65vw 24px;
            min-height: 0;
            align-items: flex-start;
        }

        .inner-hero-title {
            font-size: 32px;
        }

        .inner-hero-content {
            text-align: center;
            margin: 0 auto;
        }

        br.desktop-br {
            display: none;
        }

        .inner-hero-breadcrumb {
            display: none;
        }
    }
</style>

<section class="inner-hero-section">
    <div class="inner-hero-container">
        <div class="inner-hero-content">

            <div class="inner-hero-breadcrumb">
                HOME / <span>{{ $breadcrumb }}</span>
            </div>

            <div class="inner-hero-subtitle">{{ $subTitle }}</div>

            @if (isset($page) && $page == 'whyChooseUs')
                <h1 class="inner-hero-title">
                    More Than Packaging,<br>
                    <span class="gold-text">We Deliver Confidence.</span>
                </h1>
            @else
                <h1 class="inner-hero-title">{!! $mainTitle !!}</h1>
            @endif

            <p class="inner-hero-desc">{!! $description !!}</p>

        </div>
    </div>
</section>
