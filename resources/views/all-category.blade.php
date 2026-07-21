<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Categories of Industries - Rigid Boxes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;900&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
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
            --container-width: 1400px;
            --margin-sides: 20px;
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
            max-width: var(--container-width);
            margin: 0 auto;
            padding-left: var(--margin-sides);
            padding-right: var(--margin-sides);
        }

        /* ==========================================================================
           MAIN LAYOUT COMPONENTS
           ========================================================================== */

        .industries-main {
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            background-color: var(--background-color);
            padding-top: var(--space-64);
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
           03. UI COMPONENTS - CARD ARCHITECTURE (8PX RADIUS)
           ========================================================================== */

        .industry-card {
            background-color: var(--secondary-color);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            padding: var(--space-48) var(--space-32);
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-width: 200px;
            aspect-ratio: 1;
            position: relative;
            overflow: hidden;
        }

        /* Hover Background Image */
        .industry-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('{{ asset('images/Gift-boxes.webp') }}') no-repeat center center / cover;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .industry-card:hover::before {
            opacity: 1;
        }

        /* Card Content */
        .card-icon,
        .heading-04 {
            position: relative;
            z-index: 2;
        }

        /* Card Hover State */
        .industry-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(141, 68, 69, 0.12);
            border-color: rgba(141, 68, 69, 0.2);
        }

        .industry-card:hover .card-icon svg {
            color: #FFFFFF;
            transform: scale(1.05);
        }

        .industry-card:hover .card-icon .card-image {
            filter: brightness(0) invert(1);
        }

        .industry-card:hover .heading-04 {
            color: #FFFFFF;
        }

        /* Card Icon */
        .card-icon {
            width: 64px;
            height: 64px;
            margin-bottom: var(--space-24);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            transition: opacity 0.3s ease;
        }

        .card-icon svg {
            color: var(--color-text-secondary);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-image {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .industry-card:hover .card-icon {
            opacity: 0;
            display: none;
        }

        .industry-card:hover .card-image {
            transform: scale(1.05);
        }

        /* Card Typography */
        .industry-card .heading-04 {
            position: relative;
            z-index: 2;
        }

        .industry-card:hover .heading-04 {
            color: #FFFFFF;
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
            flex: 1 1 60%;
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

            flex: 1 1 40%;
            min-width: 0;
            margin-left: -15%;
            
            width: 100%;
            /* min-height: 390px; */
            background-color: var(--primary-color);
            border-radius: 39px 26px 39px 0px;
            padding: 40px;
        }

        @media (max-width: 1400px) {
            .bulk-info-container {
                margin-left: -12%;
            }
        }

        @media (max-width: 1200px) {
            .bulk-info-container {
                margin-left: -10%;
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
                --margin-sides: 80px;
            }
        }

        /* Medium Desktop - Keep 4 columns */
        @media (max-width: 1200px) and (min-width: 1025px) {
            :root {
                --margin-sides: 60px;
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
                --margin-sides: 60px;
            }
            
            .industries-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Tablet */
        @media (max-width: 768px) {
            :root {
                --margin-sides: 40px;
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
                padding: var(--space-32) var(--space-24);
                min-height: 150px;
                min-width: 0;
                width: auto;
                height: auto;
            }
            
            .sustainable-single {
                display: none;
            }
            
            .card-icon {
                width: 48px;
                height: 48px;
                margin-bottom: var(--space-16);
            }
            
            .card-icon svg {
                width: 32px;
                height: 32px;
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
                --margin-sides: 25px;
            }
            
            .hero-section .container,
            .industries-section .container,
            .bulk-packaging-section .container {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            .cta-section .container {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            .heading-01 {
                font-size: 28px;
            }
            
            .hero-body {
                font-size: 14px;
            }
            
            .hero-section {
                padding-top: var(--space-48);
                padding-bottom: var(--space-8);
            }
            
            .industries-section {
                padding-top: var(--space-8);
                padding-bottom: var(--space-48);
            }
            
            .industries-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 6px;
                padding: 0;
                margin: 0;
            }
            
            .industry-card {
                padding: 8px 6px;
                min-height: auto;
                min-width: 0;
                width: 100%;
                aspect-ratio: 1;
                background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/Gift-boxes.webp') }}') no-repeat center center / cover;
                border: none;
                box-sizing: border-box;
            }
            
            .industry-card .heading-04 {
                font-size: 11px;
                color: #FFFFFF;
            }
            
            .industry-card .card-icon,
            .industry-card .card-image,
            .card-icon,
            .card-image {
                display: none !important;
                opacity: 0 !important;
                visibility: hidden !important;
                width: 0 !important;
                height: 0 !important;
                overflow: hidden !important;
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
            gap: 0;
            position: relative;
            max-width: 100%;
        }

        /* CTA Content (Left) */
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

        /* CTA Image (Right) */
        .cta-image {
            flex: 1 1 40%;
            min-width: 0;
            max-width: 500px;
            height: 310px;
            border-radius: 0px;
            overflow: hidden;
            position: relative;
            margin-left: -40px;
            z-index: 10;
            display: flex;
            align-items: center;
        }

        .cta-box-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }

        @media (max-width: 1400px) {
            .cta-content {
                padding: 50px;
            }
            
            .cta-image {
                margin-left: -30px;
                max-width: 450px;
            }
        }

        @media (max-width: 1200px) {
            .cta-content {
                padding: 40px;
            }
            
            .cta-image {
                margin-left: -20px;
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
                <header class="hero-header">
                    <h1 class="heading-01">Packaging Solutions for Every Industry</h1>
                    <p class="hero-body">Custom packaging solutions designed to meet the unique demands of every industry, helping businesses protect products, strengthen branding, and create memorable customer experiences.</p>
                </header>
            </div>
        </section>

        <!-- Industries Grid Section -->
        <section class="industries-section">
            <div class="container">
                <div class="industries-grid">
                    <!-- Row 1 -->
                    <article class="industry-card apparel-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-apparel-icon.png') }}" alt="Apparel" class="card-image">
                        </div>
                        <h3 class="heading-04">Apparel</h3>
                    </article>

                    <article class="industry-card cosmetics-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-cosmetics-icon.png') }}" alt="Cosmetics" class="card-image">
                        </div>
                        <h3 class="heading-04">Cosmetics</h3>
                    </article>

                    <article class="industry-card food-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-food-icon.png') }}" alt="Food" class="card-image">
                        </div>
                        <h3 class="heading-04">Food</h3>
                    </article>

                    <article class="industry-card gift-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-gift-icon.png') }}" alt="Gift" class="card-image">
                        </div>
                        <h3 class="heading-04">Gift</h3>
                    </article>

                    <!-- Row 2 -->
                    <article class="industry-card ecommerce-card">
                        <div class="card-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor">
                                <rect x="6" y="14" width="28" height="20" rx="2" stroke-width="1.5"/>
                                <path d="M22 14V8C22 6.9 21.1 6 20 6C18.9 6 18 6.9 18 8V14" stroke-width="1.5"/>
                                <circle cx="20" cy="24" r="2" stroke-width="1.5"/>
                            </svg>
                        </div>
                        <h3 class="heading-04">E-Commerce</h3>
                    </article>

                    <article class="industry-card jewelry-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-jewelry-icon.png') }}" alt="Jewelry" class="card-image">
                        </div>
                        <h3 class="heading-04">Jewelry</h3>
                    </article>

                    <article class="industry-card perfume-card">
                        <div class="card-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor">
                                <rect x="12" y="18" width="16" height="16" rx="2" stroke-width="1.5"/>
                                <path d="M16 18V12C16 8.7 17.8 6 20 6C22.2 6 24 8.7 24 12V18" stroke-width="1.5"/>
                                <circle cx="20" cy="26" r="2" stroke-width="1.5"/>
                            </svg>
                        </div>
                        <h3 class="heading-04">Perfume</h3>
                    </article>

                    <article class="industry-card personalcare-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-personal-care-icon.png') }}" alt="Personal Care" class="card-image">
                        </div>
                        <h3 class="heading-04">Personal Care</h3>
                    </article>

                    <!-- Row 3 -->
                    <article class="industry-card pet-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-pet-icon.png') }}" alt="Pet" class="card-image">
                        </div>
                        <h3 class="heading-04">Pet</h3>
                    </article>

                    <article class="industry-card retail-card">
                        <div class="card-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor">
                                <rect x="6" y="10" width="28" height="24" rx="2" stroke-width="1.5"/>
                                <path d="M6 18L34 18" stroke-width="1.5"/>
                                <rect x="12" y="22" width="16" height="8" rx="1" stroke-width="1.5"/>
                            </svg>
                        </div>
                        <h3 class="heading-04">Retail</h3>
                    </article>


                    <article class="industry-card tea-card">
                        <div class="card-icon">
                            <img src="{{ asset('images/industry-tea-icon.png') }}" alt="Tea" class="card-image">
                        </div>
                        <h3 class="heading-04">Tea</h3>
                    </article>


                    
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
                            <img src="{{ asset('images/sustainable-packaging-icon.png') }}" alt="Sustainable" class="sustainable-icon">
                            <h2 class="sustainable-title">Sustainable Bulk Packaging Options</h2>
                        </div>
                        <p class="sustainable-description">
                            Sustainable bulk packaging options using eco-friendly materials and responsible production methods for reduced environmental impact.
                        </p>
                        
                        <div class="options-grid">
                            <div class="option-card">
                                <h3 class="option-title">Fsc-Certified Materials</h3>
                                <p class="option-text">Sourced from responsibly managed forests for sustainable packaging.</p>
                            </div>
                            
                            <div class="option-card">
                                <h3 class="option-title">Recyclable Packaging Options</h3>
                                <p class="option-text">Designed for easy recycling to reduce environmental waste.</p>
                            </div>
                            
                            <div class="option-card">
                                <h3 class="option-title">PCR (Post-Consumer Recycled) Materials</h3>
                                <p class="option-text">Made using recycled content to support a circular economy.</p>
                            </div>
                            
                            <div class="option-card">
                                <h3 class="option-title">Eco-Conscious Production Methods</h3>
                                <p class="option-text">Manufactured with reduced energy use and lower environmental impact.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Second Container - Bulk Packaging Info -->
                    <div class="bulk-info-container">
                        <h2 class="bulk-info-title">Bulk Packaging Solutions For Enterprises And Growing Brands</h2>
                        <p class="bulk-info-description">
                            Looking for a packaging partner that can support your growth? Our bulk packaging solutions combine wholesale pricing, premium quality, fast production, and full customization to help brands streamline their supply chains, boost profitability, maintain consistency, and meet large-scale demand with confidence.
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
                        <h2 class="cta-title">Get Your Custom Packaging Today</h2>
                        <p class="cta-description">Deliver elegance, protection, and a memorable unboxing experience with fully customized rigid box solutions.</p>
                        <a href="#" class="cta-button">
                            Get Started Today
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4 10H16M16 10L10 4M16 10L10 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div class="cta-image">
                        <img src="{{ asset('images/figure.png') }}" alt="Custom Packaging Box" class="cta-box-image">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Component -->
    @include('components.footer')
</body>
</html>