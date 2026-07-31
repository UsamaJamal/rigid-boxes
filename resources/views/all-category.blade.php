<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    @include('components.canonical')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Categories of Industries - Rigid Boxes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;900&family=DM+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        /* ==========================================================================
           ALL CATEGORIES OF INDUSTRIES - DESIGN SYSTEM IMPLEMENTATION
           ========================================================================== */

        /* CSS Reset & Base */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ==========================================================================
           01. COLOR PALETTE
           ========================================================================== */

        :root {
            /* Color System */
            --primary-color: #8D4445;
            --secondary-color: #F8EEEC;
            --background-color: #FAF8F8;
            --footer-color: #5F2D2F;
            --header-gradient: linear-gradient(278.74deg, #AB5A5B 0.2%, #8D4445 44.25%, #5B2829 88.3%);

            /* Typography Colors */
            --color-text-primary: #2D2D2D;
            --color-text-secondary: #666666;
            --color-text-tertiary: #999999;

            /* UI Colors */
            --color-border: #E5E5E5;
            --color-card-bg: #FFFFFF;
            --color-card-hover: #F5F0EF;

            /* Spacing Scale */
            --space-4: 4px;
            --space-8: 8px;
            --space-16: 16px;
            --space-24: 24px;
            --space-32: 32px;
            --space-48: 48px;
            --space-64: 64px;

            /* Grid System */
            --container-width: 1280px;
            --margin-sides: 55px;
            --gutter: 24px;
        }

        /* ==========================================================================
           02. TYPOGRAPHY SYSTEM
           ========================================================================== */

        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--background-color);
            color: var(--color-text-primary);
            line-height: 1.5;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Heading Scale - Open Sans */
        .heading-01 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-style: bold;
            font-size: 32px;
            line-height: 44px;
            letter-spacing: 0px;
            color: #000000;
        }

        .heading-02 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 40px;
            line-height: 1.25;
            letter-spacing: -0.01em;
            color: var(--color-text-primary);
        }

        .heading-03 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 1.3;
            color: var(--color-text-primary);
        }

        .heading-04 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 900;
            font-style: normal;
            font-size: 18px;
            line-height: 21.43px;
            letter-spacing: 0px;
            text-align: center;
            color: #000000;
        }

        /* Body Scale - DM Sans */
        .hero-body {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 16px;
            line-height: 21px;
            letter-spacing: 0px;
            text-align: center;
            color: #000000;
        }

        .body-regular {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
            color: var(--color-text-secondary);
        }

        /* ==========================================================================
           05. SPACING & LAYOUT SYSTEM
           ========================================================================== */

        .container {
            width: 100%;
            max-width: var(--container-width);
            margin: 0 auto;
            padding-left: var(--margin-sides);
            padding-right: var(--margin-sides);
            min-width: 0;
        }

        /* ==========================================================================
           MAIN LAYOUT COMPONENTS
           ========================================================================== */

        .industries-main {}

        /* Hero Section */
        .hero-section {
            background-color: var(--background-color);
            padding-top: 30px !important;
            padding-bottom: var(--space-8);
        }

        .hero-header {
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-header .heading-01 {
            margin-bottom: var(--space-8);
        }

        .hero-header .hero-body {
            max-width: 791px;
            margin: 0 auto;
        }

        /* Industries Grid Section */
        .industries-section {
            background-color: var(--background-color);
            padding-top: var(--space-8);
            padding-bottom: var(--space-64);
        }

        .industries-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--gutter);
            margin-top: 0;
        }

        /* ==========================================================================
           03. UI COMPONENTS - CARD ARCHITECTURE (IMAGE FIRST)
           ========================================================================== */

        .industry-card {
            background-color: transparent;
            border: none;
            border-radius: 0;
            padding: 0;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            min-width: 0;
            position: relative;
        }

        /* Card Image Wrapper */
        .card-img-wrapper {
            width: 100%;
            height: 322px;
            aspect-ratio: auto;
            border-radius: 12px;
            overflow: hidden;
            background-color: var(--color-card-bg);
            border: 1px solid rgba(0, 0, 0, 0.06);
            margin-bottom: 26px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            transition: box-shadow 0.3s ease;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            transition: transform 0.4s ease;
        }

        /* Card Hover State */
        .industry-card:hover .card-img-wrapper img {
            transform: scale(1.05);
        }

        .industry-card:hover .card-img-wrapper {
            box-shadow: 0 8px 24px rgba(141, 68, 69, 0.12);
        }

        /* Card Typography */
        .industry-card .heading-04 {
            position: relative;
            z-index: 2;
            transition: color 0.3s ease;
            font-size: 19px !important;
            font-weight: 700;
            color: var(--section-text-color, #191919);
            text-align: center;
            word-wrap: break-word;
            display: block;
        }

        .industry-card:hover .heading-04 {
            color: var(--primary-color);
        }

        /* ==========================================================================
           BULK PACKAGING SOLUTIONS SECTION
           ========================================================================== */

        .bulk-packaging-section {
            margin-top: -108px;
            padding-top: 80px;
            padding-bottom: 20px;
            background-color: var(--background-color);
            overflow: hidden;
        }

        .bulk-packaging-section .container {
            padding-left: var(--margin-sides);
            padding-right: var(--margin-sides);
            overflow: visible;
            position: relative;
        }

        .bulk-packaging-wrapper {
            display: flex;
            gap: 40px;
            align-items: flex-start;
            overflow: visible;
            position: relative;
            max-width: 100%;
        }

        /* Sustainable Container (Left) */
        .sustainable-container {
            width: 100%;
            flex: 1 1 65%;
            min-width: 0;
            min-height: 484px;
            background-color: var(--secondary-color);
            border-radius: 24px;
            padding: 40px;
        }

        .sustainable-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .sustainable-icon {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .sustainable-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 24px;
            font-weight: 700;
            font-style: normal;
            line-height: 28.8px;
            letter-spacing: 0px;
            color: #191919;
            margin: 0;
        }

        .sustainable-description {
            width: 100%;
            max-width: 495px;
            height: 72px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            font-style: normal;
            line-height: 24px;
            letter-spacing: 0.23px;
            color: #000000;
            margin-bottom: 32px;
        }

        .options-grid {
            margin-bottom: -22px;

            width: 100%;
            max-width: 598px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .option-card {
            background-color: transparent;
            border: 1px solid black;
            border-radius: 16px;
            padding: 24px;
        }

        .option-title {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            font-style: normal;
            line-height: 19.2px;
            letter-spacing: 0px;
            color: #191919;
            margin: 0 0 12px 0;
        }

        .option-text {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 400;
            font-style: normal;
            line-height: 18px;
            letter-spacing: 0.23px;
            color: #4A4A4A;
            margin: 0;
        }

        /* Bulk Info Container (Right) */
        .bulk-info-container {
            margin-top: 244px;

            flex: 1 1 35%;
            min-width: 0;
            margin-left: -10%;

            width: 100%;
            /* min-height: 390px; */
            background-color: var(--primary-color);
            border-radius: 39px 26px 39px 0px;
            padding: 40px;
        }

        @media (max-width: 1400px) {
            .bulk-info-container {
                margin-left: -8%;
            }
        }

        @media (max-width: 1200px) {
            .bulk-info-container {
                margin-left: -5%;
            }
        }

        .bulk-info-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 24px;
            font-weight: 700;
            line-height: 34px;
            letter-spacing: 0%;
            color: #FFFFFF;
            margin: 0 0 20px 0;
        }

        .bulk-info-description {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 26px;
            letter-spacing: 0%;
            color: #FFFFFF;
            margin: 0;
        }

        /* ==========================================================================
           RESPONSIVE DESIGN
           ========================================================================== */

        /* Responsive Design */
        @media (max-width: 1440px) {
            :root {
                --margin-sides: 55px;
            }
        }

        /* Medium Desktop - Keep 4 columns */
        @media (max-width: 1200px) and (min-width: 1025px) {
            :root {
                --margin-sides: 55px;
            }

            .industries-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .industry-card {
                padding: var(--space-32) var(--space-24);
            }
        }

        /* Medium Desktop - 3 columns */
        @media (max-width: 1024px) {
            :root {
                --margin-sides: 55px;
            }

            .industries-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Tablet */
        @media (max-width: 768px) {
            :root {
                --margin-sides: 20px;
            }

            .heading-01 {
                font-size: 36px;
            }

            .hero-body {
                font-size: 16px;
            }

            .industries-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--space-16);
            }

            .industry-card {
                width: 100%;
                max-width: 100%;
                min-width: 0;
                height: auto;
            }

            .card-img-wrapper {
                height: 220px;
            }

            .sustainable-single {
                display: none;
            }

            .options-grid {
                grid-template-columns: 1fr;
            }

            .sustainable-container,
            .bulk-info-container {
                padding: 24px;
            }

            .sustainable-description {
                height: auto;
                font-size: 14px;
                margin-bottom: 24px;
            }

            .sustainable-title {
                font-size: 18px;
            }

            .option-card {
                padding: 16px;
            }

            .options-grid {
                gap: 16px;
            }

            .bulk-packaging-wrapper {
                flex-direction: column;
            }

            .bulk-info-container {
                display: none;
            }

            .sustainable-container,
            .bulk-info-container {
                width: 100%;
            }

            .cta-wrapper {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .cta-content {
                width: 100%;
                flex: 1 1 auto;
            }

            .cta-image {
                width: 100%;
                flex: 1 1 auto;
                margin-left: 0;
                height: 300px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            :root {
                --margin-sides: 16px;
            }

            .hero-section .container,
            .industries-section .container,
            .bulk-packaging-section .container {
                padding-left: 16px;
                padding-right: 16px;
            }

            .cta-section .container {
                padding-left: 16px;
                padding-right: 16px;
            }

            .heading-01 {
                font-size: 28px;
            }

            .hero-body {
                font-size: 14px;
            }

            .hero-section {
                padding-top: 25px;
                padding-bottom: var(--space-8);
            }

            .industries-section {
                padding-top: var(--space-8);
                padding-bottom: var(--space-48);
            }

            .industries-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
                padding: 0;
                margin: 0;
            }

            .card-img-wrapper {
                height: 165px;
                border-radius: 10px;
                margin-bottom: 8px;
            }
        }

        /* ==========================================================================
           ACCESSIBILITY & PERFORMANCE
           ========================================================================== */

        /* Focus States */
        .industry-card:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            :root {
                --color-border: #000000;
                --color-text-secondary: #000000;
            }
        }

        /* Print Styles */
        @media print {
            .industry-card {
                break-inside: avoid;
                box-shadow: none;
                border: 2px solid var(--color-border);
            }
        }

        /* ==========================================================================
           CTA SECTION
           ========================================================================== */

        .cta-section {
            padding: 30px 0;
            background-color: var(--background-color);
            overflow: hidden;
            width: 100%;
        }

        .cta-section .container {
            padding-left: var(--margin-sides);
            padding-right: var(--margin-sides);
            max-width: var(--container-width);
            overflow: visible;
        }

        .cta-wrapper {
            display: flex;
            align-items: center;
            gap: 40px;
            position: relative;
            max-width: 100%;
        }

        /* CTA Content (Right) */
        .cta-content {
            height: 398px;
            flex: 1 1 60%;
            min-width: 0;
            background: url('{{ asset('images/Container.png') }}') no-repeat center center / cover, linear-gradient(135deg, #DB9E9F 0%, #8D4445 100%);
            border-radius: 0px;
            padding: 60px;
            color: #FFFFFF;
        }

        .cta-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 36px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 16px;
            color: #FFFFFF;
        }

        .cta-description {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin-bottom: 32px;
            color: rgba(255, 255, 255, 0.9);
            max-width: 400px;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 32px;
            background-color: #FFFFFF;
            color: #191919;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .cta-button svg {
            transition: transform 0.3s ease;
        }

        .cta-button:hover svg {
            transform: translateX(4px);
        }

        /* CTA Image (Left) */
        .cta-image {
            margin-left: -64px;
            flex: 1 1 40%;
            min-width: 0;
            max-width: 500px;
            height: 310px;
            border-radius: 0px;
            overflow: hidden;
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
        }

        .cta-box-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            display: block;
        }

        @media (max-width: 1400px) {
            .cta-content {
                padding: 50px;
            }

            .cta-image {
                max-width: 450px;
            }
        }

        @media (max-width: 1200px) {
            .cta-content {
                padding: 40px;
            }

            .cta-image {
                max-width: 400px;
                height: 280px;
            }
        }

        @media (max-width: 1024px) {
            .cta-content {
                padding: 40px;
                text-align: center;
            }

            .cta-description {
                max-width: 100%;
            }

            .cta-image {
                flex: 0 0 300px;
                max-width: 350px;
                height: 280px;
                margin-left: 0;
            }
        }

        @media (max-width: 900px) {
            .cta-wrapper {
                padding: 0;
            }

            .cta-image {
                margin-left: 0;
                max-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .cta-section {
                padding: 0;
            }

            .cta-section .container {
                padding-left: 12px;
                padding-right: 12px;
            }

            .cta-wrapper {
                margin-bottom: 22px;
                height: 568px;
                flex-direction: column;
                gap: 0;
            }

            .cta-image {
                width: 100%;
                max-width: 77%;
                height: 340px;
                margin-left: 0;
                margin-bottom: -116px;
                border-radius: 0;
                order: 1;
            }

            .cta-content {
                width: 100%;
                max-width: 100%;
                height: auto;
                order: 2;
                padding: 40px 32px 24px 32px;
                border-radius: 0;
                text-align: center;
            }

            .cta-title {
                font-size: 24px;
                line-height: 32px;
                margin-bottom: 16px;
            }

            .cta-description {
                font-size: 14px;
                line-height: 22px;
                max-width: 100%;
                margin-bottom: 24px;
            }

            .cta-button {
                width: auto;
                justify-content: center;
                padding: 14px 28px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .cta-image {
                height: 280px;
            }

            .cta-content {
                padding: 32px 24px;
            }

            .cta-wrapper {
                padding: 0;
            }

            .cta-title {
                margin-top: 96px;
                font-size: 22px;
                line-height: 30px;
            }

            .cta-description {
                font-size: 13px;
                line-height: 20px;
            }
        }
    </style>
</head>

<body>
    @include('components.header')
    <main class="industries-main">
        <!-- Header Section -->
        <section class="hero-section">
            <div class="container">
                <style>
                    .desktop-breadcrumb {
                        display: block;
                        text-align: left;
                        margin-bottom: 14px;
                        font-family: 'Open Sans', sans-serif;
                        font-size: 14px;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        color: var(--section-text-color, #191919);
                    }

                    .desktop-breadcrumb a {
                        color: inherit;
                        text-decoration: none;
                    }

                    .desktop-breadcrumb a:hover {
                        text-decoration: none;
                        color: var(--primary-color);
                    }

                    @media (max-width: 768px) {
                        .desktop-breadcrumb {
                            display: none !important;
                        }
                    }
                </style>
                <div class="desktop-breadcrumb">
                    <a href="/">HOME</a> /
                    <strong>{{ !empty($parentCategory['title']) ? strtoupper($parentCategory['title']) : 'ALL CATEGORIES' }}</strong>
                </div>
                <header class="hero-header">
                    <h1 class="heading-01">
                        {{ !empty($parentCategory['title']) ? $parentCategory['title'] : 'Packaging Solutions for Every Industry' }}
                    </h1>
                    <p class="hero-body">
                        {{ !empty($parentCategory['hero_description']) ? $parentCategory['hero_description'] : 'Custom packaging solutions designed to meet the unique demands of every industry, helping businesses protect products, strengthen branding, and create memorable customer experiences.' }}
                    </p>
                </header>
            </div>
        </section>

        <!-- Industries Grid Section -->
        <section class="industries-section">
            <div class="container">
                <div class="industries-grid">
                    @php
                        $allCats = !empty($categories) ? $categories : [];
                    @endphp
                    @foreach ($allCats as $cat)
                        @php
                            $resolveCategoryAsset = function ($path, $fallback = '') {
                                if (empty($path)) {
                                    return $fallback;
                                }
                                return \Illuminate\Support\Str::startsWith($path, ['storage/', 'uploads/', 'images/', 'http://', 'https://'])
                                    ? $path
                                    : 'storage/' . $path;
                            };
                            $cBanner = $resolveCategoryAsset(
                                $cat['banner_image'] ?? '',
                                $resolveCategoryAsset(
                                    $cat['image'] ?? '',
                                    'uploads/Gift-Boxes.webp'
                                )
                            );
                            $cSlug = $cat['slug'] ?? \Illuminate\Support\Str::slug($cat['title']);
                        @endphp
                        <a href="{{ url('/' . $cSlug) }}/" style="text-decoration:none; color:inherit;">
                            <article class="industry-card">
                                <div class="card-img-wrapper">
                                    <img src="{{ asset($cBanner) }}" alt="{{ $cat['title'] }}" loading="lazy"
                                        onerror="this.onerror=null;this.src='{{ asset('uploads/Gift-Boxes.webp') }}';">
                                </div>
                                <span class="heading-04" style="display: block;">{{ $cat['title'] }}</span>
                            </article>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Bulk Packaging Solutions Section -->
        <section class="bulk-packaging-section">
            <div class="container">
                <div class="bulk-packaging-wrapper">
                    <!-- First Container - Sustainable Options -->
                    <div class="sustainable-container">
                        <div class="sustainable-header">
                            <img src="{{ asset('images/sustainable-packaging-icon.png') }}" alt="Sustainable"
                                class="sustainable-icon" loading="lazy">
                            <h2 class="sustainable-title">Sustainable Bulk Packaging Options</h2>
                        </div>
                        <p class="sustainable-description">
                            Sustainable bulk packaging options using eco-friendly materials and responsible production
                            methods for reduced environmental impact.
                        </p>

                        <div class="options-grid">
                            <div class="option-card">
                                <span class="option-title">Fsc-Certified Materials</span>
                                <p class="option-text">Sourced from responsibly managed forests for sustainable
                                    packaging.</p>
                            </div>

                            <div class="option-card">
                                <span class="option-title">Recyclable Packaging Options</span>
                                <p class="option-text">Designed for easy recycling to reduce environmental waste.</p>
                            </div>

                            <div class="option-card">
                                <span class="option-title">PCR (Post-Consumer Recycled) Materials</span>
                                <p class="option-text">Made using recycled content to support a circular economy.</p>
                            </div>

                            <div class="option-card">
                                <span class="option-title">Eco-Conscious Production Methods</span>
                                <p class="option-text">Manufactured with reduced energy use and lower environmental
                                    impact.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Second Container - Bulk Packaging Info -->
                    <div class="bulk-info-container">
                        <span class="bulk-info-title" style="display: block;">Bulk Packaging Solutions For Enterprises
                            And Growing Brands</span>
                        <p class="bulk-info-description">
                            Looking for a packaging partner that can support your growth? Our bulk packaging solutions
                            combine wholesale pricing, premium quality, fast production, and full customization to help
                            brands streamline their supply chains, boost profitability, maintain consistency, and meet
                            large-scale demand with confidence.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-wrapper">
                    <div class="cta-content">
                        <span class="cta-title" style="display: block;">Get Your Custom Packaging Today</span>
                        <p class="cta-description">Deliver elegance, protection, and a memorable unboxing experience
                            with fully customized rigid box solutions.</p>
                        <a href="/request-quote/" class="cta-button">
                            Get Started Today
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L10 4M16 10L10 16" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                    <div class="cta-image">
                        <img src="{{ asset('uploads/allcategory-cta.webp') }}" alt="Custom Packaging Box"
                            class="cta-box-image" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Component -->
    @include('components.footer')
</body>

</html>
