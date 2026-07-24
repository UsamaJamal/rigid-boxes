@php
    $breadcrumb = 'ABOUT US';
    $subTitle = 'ABOUT US';
    $mainTitle = 'Welcome to The Rigid Boxes';
    $description = 'We are a premier packaging company dedicated to providing high-quality custom boxes tailored to your brand needs.';

    if (isset($page) && $page == 'whyChooseUs') {
        $breadcrumb = 'WHY CHOOSE US';
        $subTitle = 'WHY CHOOSE US';
        $description = 'From premium materials to precision craftsmanship, every box is designed to protect your products, strengthen your brand, and create unforgettable unboxing experiences.';
    }

    $desktopBg = asset('uploads/whychoose-us-banner.png');
    $mobileBg  = asset('uploads/whychoose-us-banner-mobile-view.png');
@endphp

<style>
    .inner-hero-section {
        background-image: url('{{ $desktopBg }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        color: #FFFFFF;
        font-family: 'Open Sans', sans-serif;
    }

    .inner-hero-section * {
        box-sizing: border-box;
    }

    .inner-hero-container {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 80px 5%;
        min-height: 400px;
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
        margin-bottom: 30px;
        color: #FFFFFF;
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

    @media (max-width: 991px) {
        .inner-hero-section {
            background-image: url('{{ $mobileBg }}') !important;
            background-position: bottom center !important;
            background-size: 100% auto !important;
            background-color: #6C2223;
            background-repeat: no-repeat;
        }

        .inner-hero-title {
            font-size: 32px;
        }

        .inner-hero-container {
            padding: 40px 5% 65vw 5%; /* 65vw gives enough space at the bottom for boxes on any mobile */
            min-height: 0;
            align-items: flex-start;
        }

        .inner-hero-content {
            text-align: center;
            margin: 0 auto;
        }

        .inner-hero-breadcrumb {
            margin-bottom: 15px;
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

            <p class="inner-hero-desc">{{ $description }}</p>

        </div>
    </div>
</section>
