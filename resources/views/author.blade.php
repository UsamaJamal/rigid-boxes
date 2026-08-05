<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    @include('components.canonical')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author - {{ $author['title'] }} - Rigid Boxes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Open+Sans:wght@300;400;600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ==========================================================================
           AUTHOR PAGE - RESPONSIVE DESIGN SYSTEM
           ========================================================================== */

        /* CSS Reset & Base */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        *:focus, *:active {
            outline: none !important;
            box-shadow: none !important;
            -webkit-tap-highlight-color: transparent;
        }

        /* ==========================================================================
           COLOR & SPACING SYSTEM
           ========================================================================== */

        :root {
            /* Colors */
            --color-hero-bg: #F8EEEC;
            --color-content-bg: #FFFFFF;
            --color-text-primary: #000000;
            --color-text-secondary: #666666;
            --color-border: #E5E5E5;
            --color-link: #8D4445;
            --color-link-hover: #5F2D2F;

            /* Spacing */
            --container-max-width: 1240px;
            --container-padding: 20px;
            --section-spacing: 64px;
            --card-gap: 30px;
        }

        /* ==========================================================================
           TYPOGRAPHY
           ========================================================================== */

        body {
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--color-content-bg);
            color: var(--color-text-primary);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: clip;
        }

        /* ==========================================================================
           LAYOUT CONTAINER
           ========================================================================== */

        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding-left: 55px;
            padding-right: 55px;
            box-sizing: border-box;
        }

        @media (max-width: 1100px) {
            .container {
                padding-left: 32px;
                padding-right: 32px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 600px) {
            .container {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        /* ==========================================================================
           BREADCRUMB
           ========================================================================== */

        .breadcrumb {
            padding:20px 0px 30px;
            margin-bottom: 30px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--color-text-secondary);
        }

        .breadcrumb a {
            color: #000;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--color-link);
        }

        .breadcrumb span {
            margin: 0 8px;
        }

        .breadcrumb span[aria-current="page"] {
            color: var(--color-text-primary);
            font-weight: 700;
        }

        /* ==========================================================================
           HERO SECTION
           ========================================================================== */

        .hero-section {
            background-color: var(--color-hero-bg);
            min-height: 421px;
            display: flex;
            flex-direction: column;
            padding: 0px 0 60px 0;
            border-radius: 0 0 40px 40px;
        }

        .hero-content {
            display: flex;
            align-items: flex-start;
            gap: 60px;
            width: 100%;
        }

        .author-image-wrapper {
            flex-shrink: 0;
        }

        .author-image {
            width: 261px;
            height: 261px;
            border-radius: 8px;
            object-fit: cover;
            object-position: top;
        }

        .author-info {
            flex: 1;
            max-width: 100%;
            padding-top: 10px;
        }

        .author-name {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-style: bold;
            font-size: 54px;
            line-height: 77.85px;
            letter-spacing: -0.75px;
            color: var(--color-text-primary);
            margin-bottom: 12px;
        }

        .author-title {
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: var(--color-link);
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .author-bio {
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 18px;
            line-height: 28px;
            letter-spacing: 0%;
            text-align: justify;
            color: var(--color-text-primary);
            margin-bottom: 24px;
        }

        .author-social {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--color-link);
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: var(--color-link-hover);
        }

        .social-icon {
            width: 20px;
            height: 20px;
        }

        /* ==========================================================================
           BLOG POSTS SECTION
           ========================================================================== */

        .blog-section {
            padding: 32px 0 var(--section-spacing) 0;
            background-color: var(--color-content-bg);
        }

        .section-title {
            position: relative;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 36px;
            line-height: 48px;
            color: var(--color-text-primary);
            margin-bottom: 24px;
            padding-bottom: 12px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 140px;
            height: 3px;
            background-color: var(--color-link);
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--card-gap);
        }

        /* ==========================================================================
           BLOG CARD
           ========================================================================== */

        .blog-card {
            width: 100%;
            background-color: var(--color-content-bg);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: block;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
        }

        .card-image-wrapper {
            width: 100%;
            height: 233px;
            overflow: hidden;
            background-color: #F5F5F5;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .card-image {
            transform: scale(1.05);
        }

        .card-content {
            padding: 24px;
        }

        .card-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--color-text-secondary);
        }

        .card-author {
            color: var(--color-text-secondary);
        }

        .card-date {
            color: var(--color-text-secondary);
        }

        .card-heading {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-style: bold;
            font-size: 20px;
            line-height: 26px;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: var(--color-text-primary);
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            transition: color 0.2s ease;
        }

        .blog-card:hover .card-heading,
        .card-heading:hover,
        .card-heading a:hover {
            color: #8d4445 !important;
        }
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-heading a {
            outline: none;
        }

        .card-heading a:focus, .card-heading a:active {
            outline: none;
            box-shadow: none;
        }

        .card-description {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-style: regular;
            font-size: 16px;
            line-height: 22px;
            letter-spacing: 0%;
            text-align: justify;
            color: var(--color-text-secondary);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            color: var(--color-link);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: gap 0.3s ease;
            outline: none;
        }
        
        .read-more:focus, .read-more:active {
            outline: none;
            box-shadow: none;
        }

        .blog-card:hover .read-more {
            gap: 12px;
        }

        /* ==========================================================================
           RESPONSIVE DESIGN - ZOOM LEVELS (100%, 110%, 125%, 150%)
           ========================================================================== */

        /* Base: 100% zoom - 1440px container */
        @media screen and (max-width: 1600px) {
        }

        /* Adapt for 110% zoom (effectively 1309px viewport) */
        @media screen and (max-width: 1440px) {

            .author-name {
                font-size: 48px;
                line-height: 68px;
            }
        }

        /* Adapt for 125% zoom (effectively 1152px viewport) */
        @media screen and (max-width: 1280px) {
            :root {
                --card-gap: 24px;
            }

            .hero-content {
                gap: 48px;
            }

            .author-image {
                width: 220px;
                height: 220px;
            }

            .author-name {
                font-size: 44px;
                line-height: 60px;
            }

            .author-bio {
                font-size: 17px;
                line-height: 26px;
            }
        }

        /* Large Tablets - 3 column to 2 column */
        @media screen and (max-width: 1024px) {
            :root {
                --card-gap: 20px;
            }

            .blog-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-content {
                gap: 40px;
            }

            .author-image {
                width: 200px;
                height: 200px;
            }

            .author-name {
                font-size: 40px;
                line-height: 54px;
            }

            .author-bio {
                font-size: 16px;
                line-height: 24px;
            }

            .blog-card {
                max-width: 100%;
            }
        }

        /* Adapt for 150% zoom (effectively 960px viewport) */
        @media screen and (max-width: 960px) {

            .hero-section {
                min-height: auto;
                padding: 48px 0;
            }

            .hero-content {
                flex-direction: column;
                align-items: center;
                gap: 32px;
            }

            .author-image {
                width: 180px;
                height: 180px;
            }

            .author-info {
                max-width: 100%;
            }

            .author-name {
                font-size: 36px;
                line-height: 48px;
                text-align: center;
            }

            .author-bio {
                text-align: justify;
            }

            .author-social {
                justify-content: flex-start;
            }
        }

        /* Tablets Portrait */
        @media screen and (max-width: 768px) {
            :root {
                --container-padding: 24px;
                --section-spacing: 48px;
                --card-gap: 16px;
            }

            .breadcrumb {
                display: none;
            }

            .hide-on-mobile {
                display: none !important;
            }

            .blog-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto;
            }

            .author-name {
                font-size: 32px;
                line-height: 44px;
            }

            .author-bio {
                font-size: 15px;
                line-height: 22px;
            }

            .section-title {
                font-size: 28px;
                line-height: 38px;
                margin-bottom: 32px;
            }

            .blog-card {
                max-width: 100%;
            }

            .card-image-wrapper {
                height: 260px;
            }
        }

        /* Mobile Landscape */
        @media screen and (max-width: 640px) {
            :root {
                --container-padding: 20px;
            }

            .author-image {
                width: 160px;
                height: 160px;
            }

            .author-name {
                font-size: 28px;
                line-height: 38px;
                letter-spacing: -0.5px;
            }

            .hero-section {
                padding: 40px 0;
            }
        }

        /* Mobile Portrait */
        @media screen and (max-width: 480px) {
            :root {
                --container-padding: 16px;
                --section-spacing: 32px;
            }

            .breadcrumb {
                font-size: 12px;
                padding: 16px 0;
            }

            .hero-content {
                gap: 24px;
            }

            .author-image {
                width: 140px;
                height: 140px;
            }

            .author-name {
                font-size: 24px;
                line-height: 32px;
                margin-bottom: 8px;
            }

            .author-title {
                font-size: 14px;
                line-height: 20px;
                margin-bottom: 16px;
            }

            .author-bio {
                font-size: 14px;
                line-height: 20px;
                margin-bottom: 16px;
            }

            .section-title {
                font-size: 24px;
                line-height: 32px;
                margin-bottom: 24px;
            }

            .card-content {
                padding: 20px;
            }

            .card-heading {
                font-size: 18px;
                line-height: 24px;
            }

            .card-description {
                font-size: 14px;
                line-height: 20px;
            }

            .card-image-wrapper {
                height: 220px;
            }
        }

        /* Extra Small Mobile */
        @media screen and (max-width: 360px) {
            :root {
                --container-padding: 12px;
            }

            .author-name {
                font-size: 22px;
                line-height: 30px;
            }

            .card-image-wrapper {
                height: 200px;
            }
        }

        /* ==========================================================================
           ACCESSIBILITY & PERFORMANCE
           ========================================================================== */

        /* Focus States */
        a:focus,
        button:focus {
            outline: 2px solid var(--color-link);
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
            }

            .blog-card {
                border: 2px solid currentColor;
            }
        }

        /* Print Styles */
        @media print {

            .breadcrumb,
            .author-social,
            .read-more {
                display: none;
            }

            .blog-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body>
    <!-- Header Component -->
    <x-header />

    <main>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <!-- Breadcrumb -->
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <a href="/">HOME</a>
                    <span>/</span>
                    <span aria-current="page" style="text-transform: uppercase;">{{ $author['title'] }}</span>
                </nav>

                <div class="hero-content">
                    <div class="author-image-wrapper">
                        @if(!empty($author['image']))
                            @php $img = \Illuminate\Support\Str::startsWith($author['image'], ['http', 'storage/', 'uploads/', 'images/']) ? asset($author['image']) : asset('storage/'.$author['image']); @endphp
                            <img src="{{ $img }}" alt="{{ $author['title'] }}" class="author-image" onerror="this.style.display='none'" loading="lazy">
                        @endif
                    </div>
                    <div class="author-info">
                        <h1 class="author-name">{{ $author['title'] }}</h1>
                        <p class="author-bio">
                            {{ $author['description'] }}
                        </p>
                        <div class="author-social">
                            @if(!empty($author['linkedin']))
                            <a href="{{ $author['linkedin'] }}" class="social-link" aria-label="LinkedIn Profile" target="_blank">
                                <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                                LinkedIn
                            </a>
                            @endif
                            @if(!empty($author['twitter']))
                            <a href="{{ $author['twitter'] }}" class="social-link" aria-label="Twitter Profile" target="_blank">
                                <i class="fa-brands fa-twitter social-icon"></i>
                                Twitter
                            </a>
                            @endif
                            @if(!empty($author['facebook']))
                            <a href="{{ $author['facebook'] }}" class="social-link" aria-label="Facebook Profile" target="_blank">
                                <i class="fa-brands fa-facebook social-icon"></i>
                                Facebook
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Posts Section -->
        <section class="blog-section">
            <div class="container">
                <h2 class="section-title">Blog Posts By This Author</h2>
                @if(isset($blogs) && count($blogs) > 0)
                    <div class="blog-grid">
                        @foreach($blogs as $item)
                        <article class="blog-card" onclick="window.location.href='{{ url('/blog/' . $item['slug']) }}';" style="cursor: pointer;">
                            <div class="card-image-wrapper">
                                @php $blogImg = !empty($item['image']) ? (\Illuminate\Support\Str::startsWith($item['image'], ['http', 'storage/', 'uploads/', 'images/']) ? asset($item['image']) : asset('storage/'.$item['image'])) : asset('images/below-hero.png'); @endphp
                                <img src="{{ $blogImg }}" alt="{{ $item['title'] }}" class="card-image" onerror="this.src='{{ asset('images/below-hero.png') }}'" loading="lazy">
                            </div>
                            <div class="card-content">
                                <h3 class="card-heading"><a href="{{ url('/blog/' . $item['slug']) }}" style="color:inherit; text-decoration:none;" onclick="event.stopPropagation();">{{ $item['title'] }}</a></h3>
                                <p class="card-description">{{ Str::limit(html_entity_decode(html_entity_decode(strip_tags($item['excerpt'] ?: $item['content']))), 120) }}</p>
                                <a href="{{ url('/blog/' . $item['slug']) }}" class="read-more" onclick="event.stopPropagation();">Read Full Article</a>
                            </div>
                        </article>
                        @endforeach
                    </div>
                @else
                    <p style="font-family: 'Open Sans', sans-serif; font-size: 16px; color: #555;">No published blogs found for this author yet.</p>
                @endif
            </div>
        </section>
    </main>

    <!-- Footer Component -->
    <x-footer />
</body>

</html>
