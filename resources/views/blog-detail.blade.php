<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $articleTitle = trim((string) ($blog['meta_title'] ?? '')) ?: ($blog['title'] ?? 'Packaging Blog | The Rigid Boxes');
        $articleDescriptionSource = $blog['meta_description'] ?? $blog['excerpt'] ?? $blog['content'] ?? '';
        $articleDescription = preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode((string) $articleDescriptionSource))));
        $articleKeywords = trim((string) ($blog['meta_keywords'] ?? ''));
        $articleSubtitle = preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode($blog['excerpt'] ?? ''))));
    @endphp
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.png') }}" type="image/png">
    @include('components.canonical')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $articleTitle }}</title>
    <meta name="description" content="{{ $articleDescription }}">
    @if($articleKeywords)
    <meta name="keywords" content="{{ $articleKeywords }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Open+Sans:wght@300;400;600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #8d4445;
            --color-primary-dark: #692f31;
            --color-primary-soft: #f8eeee;
            --color-ink: #111827;
            --color-copy: #374151;
            --color-muted: #6b7280;
            --color-line: #e5e7eb;
            --color-page: #ffffff;
            --font-heading: 'Open Sans', sans-serif;
            --font-body: 'DM Sans', sans-serif;
            --section-width: 1240px;
        }

        body, html {
            margin: 0;
            padding: 0;
            overflow-x: clip;
        }

        /* Ensure header sticky works properly */
        body {
            position: relative;
        }

        .blog-detail-page * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .blog-detail-page {
            background-color: var(--color-page);
            color: var(--color-copy);
            font-family: var(--font-body);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .blog-detail-page a {
            color: inherit;
            text-decoration: none;
        }

        .blog-detail-page img {
            display: block;
            max-width: 100%;
        }

        .blog-detail-page .container {
            width: 100%;
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 55px;
            padding-right: 55px;
            box-sizing: border-box;
        }

        @media (max-width: 1100px) {
            .blog-detail-page .container { padding-left: 32px; padding-right: 32px; }
        }
        @media (max-width: 768px) {
            .blog-detail-page .container { padding-left: 20px; padding-right: 20px; }
        }
        @media (max-width: 600px) {
            .blog-detail-page .container { padding-left: 16px; padding-right: 16px; }
        }

        /* Breadcrumb */
        .breadcrumb-wrap {
            padding: 40px 0 12px;
        }

        .breadcrumb {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #000;
            font-family: 'Open Sans', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: black;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--color-primary);
        }

        .breadcrumb span.sep {
            color: #d1d5db;
        }

        .breadcrumb span.current {
            color: var(--color-ink);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 400px;
        }

        /* Article Header */
        .article-header {
            padding-bottom: 16px;
        }

        .article-title {
            font-family: var(--font-heading);
            font-size: 40px;
            font-weight: 800;
            color: var(--color-ink);
            line-height: 1.2;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
            max-width: 980px;
        }

        .article-subtitle {
            font-size: 17px;
            color: #000000;
            line-height: 1.6;
            margin-bottom: 16px;
            max-width: 900px;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 13.5px;
            color: var(--color-muted);
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-avatar-sm {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--color-line);
        }

        .author-name {
            font-weight: 700;
            color: var(--color-ink);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .meta-item svg {
            width: 16px;
            height: 16px;
            stroke: var(--color-primary);
        }

        /* Featured Hero Image */
        .featured-image-wrap {
            margin-bottom: 28px;
            /* Slightly taller banner keeps the full packaging artwork in view. */
            aspect-ratio: 2.1 / 1;
        }

        .featured-image {
            display: block;
            width: 100%;
            height: 100%;
            max-width: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .mobile-toc-widget {
            display: none;
        }

        /* Main 2-Column Layout */
        .article-layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 32px;
            align-items: stretch;
        }

        /* Article Main Content */
        .article-body {
            align-self: start;
            min-width: 0;
            max-width: 100%;
            font-size: 16px;
            color: #374151;
            line-height: 1.8;
        }

        .table-responsive {
            width: 100%;
            max-width: 100%;
            margin: 20px 0;
            /* Desktop tables fit the article column; reserve scrolling for phones. */
            overflow-x: hidden;
        }

        .table-responsive table {
            width: 100% !important;
            max-width: none !important;
            min-width: 0 !important;
            margin: 0 !important;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-responsive th,
        .table-responsive td {
            overflow-wrap: anywhere;
            white-space: normal !important;
        }

        .article-body p {
            color: #000000;
            margin-bottom: 16px;
        }

        .article-body a,
        .article-body a * {
            color: #5b2829 !important;
            text-decoration: underline !important;
            text-decoration-color: #5b2829 !important;
        }

        .article-body a:hover,
        .article-body a:hover * {
            color: #5b2829 !important;
            text-decoration: underline !important;
            text-decoration-color: #5b2829 !important;
        }

        .article-body ul li a,
        .article-body ol li a,
        .article-body ul li a *,
        .article-body ol li a * {
            color: #5b2829 !important;
            text-decoration: underline !important;
            text-decoration-color: #5b2829 !important;
        }

        .article-body ul li a:hover,
        .article-body ol li a:hover,
        .article-body ul li a:hover *,
        .article-body ol li a:hover * {
            color: #5b2829 !important;
            text-decoration: underline !important;
            text-decoration-color: #5b2829 !important;
        }

        .article-body h2 {
            font-family: var(--font-heading);
            font-size: 22px;
            font-weight: 700;
            color: var(--color-ink);
            margin-top: 24px;
            margin-bottom: 12px;
            line-height: 1.35;
        }

        .article-body strong {
            color: var(--color-ink);
        }

        .article-body ul,
        .article-body ol {
            margin: 0 0 22px;
            padding-left: 2rem;
        }

        .article-body ul {
            list-style-type: disc;
        }

        .article-body ol {
            list-style-type: decimal;
        }

        .article-body li {
            margin-bottom: 8px;
            padding-left: 4px;
        }

        .article-body li::marker {
            color: var(--color-ink);
            font-weight: 600;
        }

        /* Callout Box / Key Insight */
        .callout-box {
            background: #FAF5F5;
            border-left: 4px solid var(--color-primary);
            padding: 18px 22px;
            border-radius: 0 12px 12px 0;
            margin: 20px 0;
        }

        .callout-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--color-primary);
            margin-bottom: 8px;
        }

        .callout-content {
            font-size: 16px;
            color: #000000;
            line-height: 1.65;
            /* font-style: italic; */
        }

        /* Quote Callout */
        .quote-box {
            border-left: 3px solid var(--color-primary);
            padding-left: 20px;
            margin: 20px 0;
        }

        .quote-text {
            font-size: 17px;
            font-style: italic;
            color: #1f2937;
            line-height: 1.65;
            margin-bottom: 8px;
        }

        .quote-author {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--color-muted);
            font-style: normal;
        }

        /* Author Biography Card */
        .author-card {
            margin-bottom: 40px;
            background: #FAF8F8;
            border-radius: 16px;
            padding: 24px;
            margin-top: 0;
            display: flex;
            gap: 24px;
            align-items: flex-start;
            border: 1px solid #F0EAEB;
            width: 100%;
        }

        .author-divider {
            border: 0;
            border-top: 1px solid #EAEAEA;
            margin: 40px 0 24px 0;
            width: 100%;
        }

        .author-share-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 220px;
            gap: 20px;
            align-items: stretch;
            margin-bottom: 40px;
        }

        .author-share-row .author-card,
        .author-share-row .article-share-widget {
            margin: 0;
        }

        .author-share-row .author-card {
            order: 2;
        }

        .author-share-row .article-share-widget {
            order: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .article-end-widgets {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .article-end-widgets .newsletter-widget,
        .article-end-widgets .article-share-widget {
            margin: 0;
        }

        .article-end-widgets .article-share-widget {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .author-card-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 2px solid #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .author-card-details {
            flex: 1;
        }

        .author-card-tag {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--color-primary);
            margin-bottom: 4px;
        }

        .author-card-name {
            font-family: var(--font-heading);
            font-size: 20px;
            font-weight: 700;
            color: var(--color-ink);
            margin-bottom: 8px;
        }

        .author-card-bio {
            font-weight: 400;
            font-size: 16px;
            color: #000000;
            line-height: 1.6;
        }

        /* Sidebar Styling */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 28px;
            align-self: stretch;
            position: relative;
        }

        /* These remain at the bottom of the right column, beside the end of the article. */
        .sidebar-static-actions {
            display: flex;
            flex-direction: column;
            gap: 28px;
            margin-top: auto;
            padding-bottom: 40px;
            box-sizing: border-box;
        }

        .widget {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #EAEAEA;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        /* Keep the table of contents visible while the article scrolls. */
        #tocWidget {
            position: sticky;
            top: 96px;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            z-index: 2;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #tocWidget::-webkit-scrollbar {
            display: none;
        }

        /* The TOC stops immediately above the static sidebar actions. */
        #tocWidget.toc-stopped-at-actions {
            position: absolute;
            top: var(--toc-stop-top);
            width: 100%;
            box-sizing: border-box;
        }

        .widget-title {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--color-muted);
            margin-bottom: 18px;
        }

        /* Table of Contents Widget */
        .toc-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .toc-item a {
            font-size: 14px;
            color: #4b5563;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .toc-item a:hover {
            color: var(--color-primary);
        }

        .toc-item.active a {
            color: var(--color-primary);
            font-weight: 700;
        }

        /* Recent Articles Widget */
        .recent-articles-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .recent-article-item {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .recent-article-img {
            width: 68px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .recent-article-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .recent-article-title {
            font-family: var(--font-heading);
            font-size: 13.5px;
            font-weight: 700;
            color: var(--color-ink);
            line-height: 1.35;
            transition: color 0.2s;
        }

        .recent-article-title:hover {
            color: var(--color-primary);
        }

        .recent-article-date {
            font-size: 11.5px;
            color: var(--color-muted);
        }

        /* Newsletter Box Widget */
        .newsletter-widget {
            background: var(--color-primary);
            color: #ffffff;
            border-radius: 16px;
            padding: 30px 24px;
            position: relative;
            overflow: hidden;
            border: none;
        }

.newsletter-widget .newsletter-title {
            font-family: var(--font-heading);
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #ffffff;
    }

        .newsletter-widget .newsletter-desc {
            font-size: 13.5px;
            line-height: 1.55;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 24px;
        }

        .newsletter-widget .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .newsletter-widget .newsletter-input {
            width: 100%;
            height: 44px;
            padding: 0 16px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            outline: none;
            letter-spacing: 0.05em;
        }

        .newsletter-widget .newsletter-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .newsletter-widget .newsletter-btn {
            height: 44px;
            background: #ffffff;
            color: var(--color-primary);
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .newsletter-widget .newsletter-btn:hover {
            background: var(--color-primary-soft);
        }

        /* Share Blog Widget */
        .share-widget {
            padding: 22px 26px;
        }

        .share-widget .widget-title {
            margin-bottom: 22px;
            color: #000000;
        }

        .social-buttons {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid var(--color-line);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4b5563;
            transition: all 0.2s;
            background: #ffffff;
        }

        .social-btn:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
            background: var(--color-primary-soft);
        }

        /* Related Blogs Section */
        .related-blogs-section {
            margin-top: 40px;
            margin-bottom: 40px;
            padding-top: 0;
        }

        .related-title {
            font-family: var(--font-heading);
            font-size: 26px;
            font-weight: 700;
            color: var(--color-ink);
            margin-bottom: 20px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24.5px;
        }

        .related-card {
            background: #ffffff;
            border: 1px solid #EAEAEA;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        .related-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .related-card-body {
            padding: 20px 22px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .related-card-meta {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--color-muted);
            margin-bottom: 10px;
        }

        .related-card-title {
            font-family: var(--font-heading);
            font-size: 18px;
            font-weight: 700;
            color: var(--color-ink);
            line-height: 1.35;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .related-card-desc {

            font-size: 16px;
            color: #000000;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .related-card-btn {
            margin-top: auto;
            font-size: 14px;
            font-weight: 700;
            color: #8d4445 !important;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: gap 0.2s;
            text-decoration: none !important;
        }

        .related-card-btn:hover, .related-card:hover .related-card-btn {
            gap: 10px;
            color: #8d4445 !important;
        }

        .related-card:hover .related-card-title {
            color: var(--color-primary);
        }

        /* Responsive Layout */
        @media (max-width: 1024px) {
            .article-layout {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .featured-image {
                height: 100%;
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .mobile-toc-widget {
                display: block;
                margin: 0 0 22px;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            }

            .mobile-toc-toggle {
                width: 100%;
                border: 0;
                background: var(--color-primary);
                color: #ffffff;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px;
                font: 700 16px var(--font-heading);
                cursor: pointer;
            }

            .mobile-toc-toggle__label {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .mobile-toc-chevron {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: #ffffff;
                color: var(--color-primary);
                position: relative;
                display: block;
                transition: transform 0.2s ease;
            }

            .mobile-toc-chevron svg {
                width: 16px;
                height: 16px;
                position: absolute;
                /* Optical centering: the chevron's stroke carries more visual weight above its box. */
                top: 55%;
                left: 50%;
                transform: translate(-50%, -50%);
                fill: none;
                stroke: currentColor;
                stroke-width: 2.5;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .mobile-toc-widget.is-open .mobile-toc-chevron {
                transform: rotate(180deg);
            }

            .mobile-toc-list {
                display: none;
                list-style: none;
                margin: 0;
                padding: 12px 16px;
                background: #ffffff;
            }

            .mobile-toc-widget.is-open .mobile-toc-list {
                display: block;
            }

            .mobile-toc-item a {
                display: block;
                padding: 9px 0;
                color: #374151;
                font-size: 14px;
                line-height: 1.35;
                text-decoration: none;
                border-radius: 6px;
                transition: background-color 0.18s ease, color 0.18s ease;
            }

            .mobile-toc-item a:hover {
                background: #f7eeee;
                color: var(--color-primary);
            }

            .mobile-toc-item.active a {
                color: var(--color-primary);
                font-weight: 700;
                background: #f7eeee;
            }

            .author-share-row {
                grid-template-columns: 1fr;
            }

            .article-end-widgets {
                grid-template-columns: 1fr;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive table {
                min-width: 620px !important;
            }

            .author-card {
                display: block;
                padding: 20px;
            }
            .author-card > a,
            .author-card > img.author-card-avatar {
                float: left;
                margin-left: -14px;
                margin-right: 44px;
                margin-bottom: 12px;
                display: block !important;
            }
            .author-card-avatar {
                width: 80px !important;
                height: 80px !important;
                border: 2px solid var(--color-primary) !important;
                margin: 0 !important;
                float: none !important;
                padding: 2px;
            }
            .author-card-details {
                display: block;
            }
            .author-card-tag {
                padding-top: 14px;
            }
            .author-card-bio {
                clear: left;
                display: block;
                padding-top: 4px;
                text-align: justify;
            }
            .author-divider {
                margin: 24px 0 16px 0;
            }
            .related-blogs-section {
                margin-top: 24px;
            }
            .breadcrumb-wrap {
                display: none;
            }

            .article-title {
                font-family: 'Open Sans', sans-serif;
                font-size: 28px;
                font-weight: 700;
                line-height: 34px;
                letter-spacing: 0px;
                color: #000000;
                margin-top: 32px;
                margin-bottom: 14px;
                vertical-align: middle;
            }

            .article-subtitle {
                font-family: 'DM Sans', sans-serif;
                font-size: 16px;
                font-weight: 400;
                line-height: 24px;
                letter-spacing: 0px;
                color: #000000;
                text-align: justify;
                vertical-align: middle;
            }

            .article-meta {
                gap: 5px;
                font-size: 13px;
                color: #000000;
                margin-top: 20px;
                flex-wrap: nowrap;
                white-space: nowrap;
                overflow-x: auto;
            }



            .article-body p {
                font-family: 'DM Sans', sans-serif;
                font-size: 16px;
                font-weight: 400;
                line-height: 30px;
                letter-spacing: 0%;
                text-align: justify;
                margin-bottom: 22px;
                color: #000000;
            }

            .article-body h2 {
                font-family: 'DM Sans', sans-serif;
                font-size: 16px;
                font-weight: 700;
                line-height: 30px;
                letter-spacing: 0%;
                text-align: justify;
                margin-top: 36px;
                margin-bottom: 16px;
                color: #000000;
            }

            .callout-box {
                display: none;
            }

            .quote-box {
                display: none;
            }

            .sidebar {
                display: none;
            }

            .author-name {
                font-family: 'DM Sans', sans-serif;
                font-weight: 500;
                font-size: 12px;
                color: #000000;
            }

            .author-avatar-sm {
                width: 32px;
                height: 32px;
            }

            .author-info::after,
            .article-meta .meta-item:nth-of-type(1)::after {
                content: "|";
                color: #9ca3af;
                margin-left: 10px;
                font-weight: 300;
            }

            .featured-image-wrap {
                margin-left: 0;
                margin-right: 0;
                aspect-ratio: auto;
            }

            .featured-image {
                width: 100%;
                height: auto;
                border-radius: 12px;
                object-fit: contain;
            }

            .author-card {
                flex-direction: column;
                padding: 22px;
                gap: 16px;
            }

            .related-grid {
                display: flex;
                overflow-x: auto;
                overflow-y: hidden;
                gap: 16px;
                scroll-snap-type: x mandatory;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                padding-bottom: 10px;
            }

            .related-grid::-webkit-scrollbar {
                display: none;
            }

            .related-card {
                flex: 0 0 100%;
                min-width: 100%;
                scroll-snap-align: start;
            }

            .related-card-title {
                font-family: 'Open Sans', sans-serif;
                font-size: 18px;
                font-weight: 700;
                line-height: 28px;
                letter-spacing: 0%;
                color: #000000;
                text-transform: capitalize;
            }

            .related-card-desc {
                font-family: 'DM Sans', sans-serif;
                font-size: 15px;
                font-weight: 400;
                line-height: 19px;
                letter-spacing: 0%;
                color: #000000;
                text-align: justify;
            }
        }
    </style>
</head>
<body>

    @include('components.header')

    <main class="blog-detail-page">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="breadcrumb-wrap">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">HOME</a>
                <span class="sep">/</span>
                <a href="{{ url('/blog/') }}">BLOG</a>
                <span class="sep">/</span>
                <span class="current">{{ $blog['title'] ?? 'BLOG ARTICLE' }}</span>
            </div>
        </div>

        <!-- Article Header -->
        <header class="article-header">
            <h1 class="article-title">{{ $blog['title'] ?? 'Packaging Insights' }}</h1>
            @if(!empty($articleSubtitle))
                <p class="article-subtitle">{{ $articleSubtitle }}</p>
            @endif
            
            <div class="article-meta">
                @php 
                    $authorName = !empty($blog['joined_author_name']) ? $blog['joined_author_name'] : (!empty($blog['author_name']) ? $blog['author_name'] : null);
                    $authorSlug = $blog['joined_author_slug'] ?? ($blog['author_slug'] ?? null);
                    $authorImgPath = !empty($blog['joined_author_image']) ? $blog['joined_author_image'] : (!empty($blog['author_image']) ? $blog['author_image'] : null);
                    $authorDesc = !empty($blog['joined_author_desc']) ? $blog['joined_author_desc'] : (!empty($blog['author_description']) ? $blog['author_description'] : null);

                    if (!$authorName || !$authorImgPath) {
                        $defaultAuthor = \Illuminate\Support\Facades\DB::table('admin_authors')->first();
                        if ($defaultAuthor) {
                            $authorName = $authorName ?: $defaultAuthor->title;
                            $authorSlug = $authorSlug ?: $defaultAuthor->slug;
                            $authorImgPath = $authorImgPath ?: $defaultAuthor->image;
                            $authorDesc = $authorDesc ?: $defaultAuthor->description;
                        }
                    }

                    $authorName = $authorName ?: 'Ahmed Khan';
                    if (empty($authorSlug) && !empty($authorName)) {
                        $authorSlug = \Illuminate\Support\Str::slug($authorName);
                    }
                    $authorDesc = $authorDesc ?: 'Written by the Rigid Box Pro Team, specialists in custom rigid boxes and luxury packaging solutions. We share industry insights, design inspiration, and expert guidance to help brands create packaging that leaves a lasting impression.';

                    $authorImg = $authorImgPath ? (\Illuminate\Support\Str::startsWith($authorImgPath, ['http', 'storage/', 'uploads/', 'images/']) ? asset($authorImgPath) : asset('storage/'.$authorImgPath)) : asset('images/ahmed-khan.png'); 
                    $publishDate = !empty($blog['publish_date']) ? date('M j, Y', strtotime($blog['publish_date'])) : (!empty($blog['created_at']) ? date('M j, Y', strtotime($blog['created_at'])) : 'Mar 3, 2026');
                @endphp
                @if($authorSlug)
                    <a href="{{ url('/author/' . $authorSlug) }}/" class="author-info" style="text-decoration:none; color:inherit;">
                        <img src="{{ $authorImg }}" alt="{{ $authorName }}" class="author-avatar-sm" onerror="this.src='{{ asset('images/ahmed-khan.png') }}'" loading="lazy">
                        <span class="author-name">{{ $authorName }}</span>
                    </a>
                @else
                    <div class="author-info">
                        <img src="{{ $authorImg }}" alt="{{ $authorName }}" class="author-avatar-sm" onerror="this.src='{{ asset('images/ahmed-khan.png') }}'" loading="lazy">
                        <span class="author-name">{{ $authorName }}</span>
                    </div>
                @endif
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span>{{ $publishDate }}</span>
                </div>
                <div class="meta-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>4 min read</span>
                </div>
            </div>
        </header>

        <!-- Featured Hero Image -->
        @php
            $featuredImagePath = $blog['image'] ?? null;
            $featuredImage = null;
            if (!empty($featuredImagePath)) {
                $isRemoteImage = \Illuminate\Support\Str::startsWith($featuredImagePath, ['http://', 'https://']);
                $publicImagePath = \Illuminate\Support\Str::startsWith($featuredImagePath, ['storage/', 'uploads/', 'images/'])
                    ? $featuredImagePath
                    : 'storage/' . ltrim($featuredImagePath, '/');

                $featuredImage = ($isRemoteImage || file_exists(public_path($publicImagePath)))
                    ? ($isRemoteImage ? $featuredImagePath : asset($publicImagePath))
                    : asset('images/below-hero.png');
            }
            $featuredImage = $featuredImage ?: asset('images/below-hero.png');
            $featuredImageAlt = $blog['alt_text'] ?? $blog['title'] ?? 'Rigid box packaging';
        @endphp
        <div class="featured-image-wrap">
            <img src="{{ $featuredImage }}" alt="{{ $featuredImageAlt }}" class="featured-image" onerror="this.onerror=null; this.src='{{ asset('images/below-hero.png') }}'" loading="lazy">
        </div>

        <!-- Mobile-only collapsible table of contents -->
        <div class="mobile-toc-widget" id="mobileTocWidget">
            <button class="mobile-toc-toggle" id="mobileTocToggle" type="button" aria-expanded="false" aria-controls="mobileTocList">
                <span class="mobile-toc-toggle__label"><span aria-hidden="true">☷</span> Table of Contents</span>
                <span class="mobile-toc-chevron" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"></path></svg></span>
            </button>
            <ul class="mobile-toc-list" id="mobileTocList"></ul>
        </div>

        <!-- Main Content & Sidebar Grid -->
        <div class="article-layout">

            <!-- Left Main Column -->
            <article class="article-body">
                @if(!empty($blog['content']))
                    {!! $blog['content'] !!}
                @else
                <p>The luxury packaging landscape is shifting faster than ever. Between sustainability mandates, digital integration, and ever-rising consumer expectations, brands that adapt early aren't just surviving — they're capturing disproportionate market attention. Here are the seven trends that will define premium packaging through 2026 and beyond.</p>

                <h2>1. Bio-Based Rigid Board Goes Mainstream</h2>
                <p>For years, rigid boxes meant a trade-off: premium feel versus environmental impact. Today, FSC-certified papers combined with bio-based binders and recycled greyboard deliver the same structural integrity without the guilt. Early adopters like niche fragrance houses report that 68% of their customers actively notice and appreciate 'plastic-free' packaging labels — and that sentiment directly influences repeat purchases.</p>
                <p>At LuxPack, we've transitioned over 50% of our rigid box production to fully recyclable, FSC-certified materials. The result? No compromise on embossing depth, no visible difference in foil adhesion — just a cleaner conscience for your brand and your customers.</p>

                <div class="callout-box">
                    <div class="callout-label">Key Insight</div>
                    <div class="callout-content">74% of luxury shoppers say they would pay more for packaging with verifiable sustainability credentials. Bio-based rigid boxes maintain identical finishing capabilities — including deep embossing and foil stamping.</div>
                </div>

                <h2>2. The Rise of "Quiet Luxury" in Unboxing</h2>
                <p>Minimalism isn't new, but the definition has evolved. Quiet luxury packaging isn't about sterile white boxes — it's about tactile richness and subtle detailing. Think uncoated papers with a velvety touch, blind embossing that reveals itself only under certain light, or monochromatic palettes that shift tone across layers of the unboxing experience.</p>

                <div class="quote-box">
                    <div class="quote-text">"The best luxury packaging doesn't shout — it whispers. It rewards close inspection. Every fold, every texture, every hidden detail should feel intentional."</div>
                    <div class="quote-author">— Mia Lindström, Creative Director at Lindström Studio</div>
                </div>

                <p>Brands like The Row and Aesop have mastered this, and the B2B world is taking notice. Corporate gift sets, investor welcome-kits, and even tech unboxings are adopting the same restrained elegance that signals confidence rather than excess.</p>

                <h2>3. Integrated Digital Experiences (AR, NFC, QR)</h2>
                <p>Packaging is becoming a portal. Near-field communication (NFC) tags embedded under labels, augmented reality triggers printed invisibly on box lids, and dynamic QR codes that lead to exclusive brand content are no longer experimental. They're expected — especially by the 25–40 demographic that makes up the bulk of luxury consumers.</p>
                <p>Imagine a whisky gift box where tapping a phone against the logo launches a virtual distillery tour. Or a skincare kit that uses AR to show application tutorials. These aren't gimmicks — they're measurable engagement tools that extend brand interaction well beyond the initial unboxing moment.</p>

                <h2>4. Hyper-Customization at Scale</h2>
                <p>Low MOQs and digital printing advancements mean that 'custom' no longer requires a 10,000-unit commitment. Variable data printing allows every box in a run to feature unique names, messages, or even regional artwork. This is particularly powerful for corporate gifting, limited-edition drops, and influencer seeding campaigns where personalization drives social sharing and word-of-mouth.</p>

                <div class="callout-box">
                    <div class="callout-label">Did You Know?</div>
                    <div class="callout-content">Personalized packaging generates 3.2x more social media shares than generic unboxing experiences, according to a 2025 consumer behavior study by PackAgile Research.</div>
                </div>

                <h2>5. Modular, Multi-Use Packaging Systems</h2>
                <p>Luxury consumers increasingly value packaging that earns a second life. Modular inserts that transform a shipping box into a keepsake drawer, or rigid sleeves that become elegant desk organizers, are gaining traction. This aligns with both sustainability goals and the 'gift that keeps giving' perception that elevates brand recall long after the initial purchase.</p>

                <h2>6. Metallic Inks Over Plastic Laminates</h2>
                <p>Soft-touch lamination has been a staple, but it's often plastic-based. In response, metallic inks and water-based coatings are stepping up. New formulations deliver a luminous, almost wet-look sheen without the environmental footprint. Combined with textured papers, the effect is both luxurious and fully recyclable — a genuine win-win for design and sustainability teams alike.</p>

                <h2>7. Transparency as a Luxury Signal</h2>
                <p>Today's buyers want to know where materials came from, who assembled the box, and what happens to it after disposal. Smart packaging with QR codes that trace the supply chain, or simply printed details about the box's recycled content, transform transparency into a brand strength. In a market saturated with noise, the brands that win are those that treat packaging not as a cost center, but as a strategic asset.</p>
                <p>The trends above aren't predictions — they're already unfolding across the industry. The question is whether your brand will lead or follow. At LuxPack, we're already helping forward-thinking brands implement every one of these innovations, from bio-based materials to NFC integration, without compromising the tactile luxury their customers expect.</p>
                @endif

                <hr class="author-divider">
                <!-- Author Bio Card -->
                <div class="author-card">
                    @if($authorSlug)
                        <a href="{{ url('/author/' . $authorSlug) }}/" style="text-decoration:none; color:inherit; display:flex;">
                            <img src="{{ $authorImg }}" alt="{{ $authorName }}" class="author-card-avatar" onerror="this.src='{{ asset('images/ahmed-khan.png') }}'" loading="lazy">
                        </a>
                    @else
                        <img src="{{ $authorImg }}" alt="{{ $authorName }}" class="author-card-avatar" onerror="this.src='{{ asset('images/ahmed-khan.png') }}'">
                    @endif
                    <div class="author-card-details">
                        <div class="author-card-tag">WRITTEN BY</div>
                        @if($authorSlug)
                            <a href="{{ url('/author/' . $authorSlug) }}/" class="author-card-name" style="text-decoration:none; color:inherit; display:inline-block;">{{ $authorName }}</a>
                        @else
                            <span class="author-card-name">{{ $authorName }}</span>
                        @endif
                        <div class="author-card-bio">{{ $authorDesc }}</div>
                    </div>
                </div>

                @if(false)
                <!-- End-of-article actions: moved below Related Blogs. -->
                <div class="article-end-widgets">
                    <div class="newsletter-widget">
                        <h3 class="newsletter-title">Stay Inspired</h3>
                        <p class="newsletter-desc">Join 12,000+ brand leaders receiving weekly packaging insights and trend reports</p>
                        <form class="newsletter-form" action="{{ url('/submit-newsletter') }}" method="POST">
                            @csrf
                            @if(session('success'))
                                <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 13px;">{{ session('success') }}</div>
                            @endif
                            <input type="email" name="email" class="newsletter-input" placeholder="YOUR EMAIL" required>
                            <button type="submit" class="newsletter-btn">SUBSCRIBE</button>
                        </form>
                    </div>

                    <div class="widget share-widget article-share-widget">
                        <div class="widget-title">SHARE BLOG</div>
                        <div class="social-buttons">
                            <a href="#" class="social-btn" aria-label="Facebook"><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.714 5H18V0h-3.808C10.592 0 9 1.583 9 4.615V8z"/></svg></a>
                            <a href="#" class="social-btn" aria-label="Instagram"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                            <a href="#" class="social-btn" aria-label="Email"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
                            <a href="#" class="social-btn" aria-label="Bookmark"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2-2v14c0 1.1-.9 2-2 2z"></path></svg></a>
                        </div>
                    </div>
                </div>
                @endif
            </article>

            <!-- Right Sidebar -->
            <aside class="sidebar">

                <!-- Table of Contents Widget -->
                <div class="widget" id="tocWidget">
                    <div class="widget-title">TABLE OF CONTENTS</div>
                    <ul class="toc-list" id="tocList">
                        <!-- Auto-generated from article h2 headings via JS -->
                    </ul>
                </div>

                <!-- Recent Articles Widget -->
                @if($recentBlogs->isNotEmpty())
                <div class="widget">
                    <div class="widget-title" style="font-size: 18px; font-family: var(--font-heading); color: var(--color-ink); text-transform: none; font-weight: 700; margin-bottom: 20px;">Recent Articles</div>
                    <div class="recent-articles-list">
                        @foreach($recentBlogs as $rb)
                        <div class="recent-article-item">
                            @php
                                $rbImagePath = $rb->image ?? null;
                                $rbIsRemoteImage = $rbImagePath && \Illuminate\Support\Str::startsWith($rbImagePath, ['http://', 'https://']);
                                $rbPublicImagePath = $rbImagePath && \Illuminate\Support\Str::startsWith($rbImagePath, ['storage/', 'uploads/', 'images/'])
                                    ? $rbImagePath
                                    : ($rbImagePath ? 'storage/' . ltrim($rbImagePath, '/') : null);
                                $rbImg = ($rbIsRemoteImage || ($rbPublicImagePath && file_exists(public_path($rbPublicImagePath))))
                                    ? ($rbIsRemoteImage ? $rbImagePath : asset($rbPublicImagePath))
                                    : asset('images/below-hero.png');
                            @endphp
                            <img src="{{ $rbImg }}" alt="{{ $rb->title }}" class="recent-article-img" onerror="this.src='{{ asset('images/below-hero.png') }}'">
                            <div class="recent-article-info">
                                <a href="{{ url('/blog/' . $rb->slug) }}/" class="recent-article-title">{{ $rb->title }}</a>
                                <span class="recent-article-date">{{ date('M d, Y', strtotime($rb->created_at)) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Static actions at the bottom of the right sidebar. -->
                <div class="sidebar-static-actions">
                <div class="newsletter-widget">
                    <h3 class="newsletter-title">Stay Inspired</h3>
                    <p class="newsletter-desc">Join 12,000+ brand leaders receiving weekly packaging insights and trend reports</p>
                    <form class="newsletter-form" action="{{ url('/submit-newsletter') }}" method="POST">
                        @csrf
                        <input type="email" name="email" class="newsletter-input" placeholder="YOUR EMAIL" required>
                        <button type="submit" class="newsletter-btn">SUBSCRIBE</button>
                    </form>
                </div>

                <div class="widget share-widget">
                    <div class="widget-title">SHARE BLOG</div>
                    <div class="social-buttons">
                        <a href="#" class="social-btn" aria-label="Facebook"><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.714 5H18V0h-3.808C10.592 0 9 1.583 9 4.615V8z"/></svg></a>
                        <a href="#" class="social-btn" aria-label="Instagram"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                        <a href="#" class="social-btn" aria-label="Email"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
                        <a href="#" class="social-btn" aria-label="Bookmark"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14c0 1.1-.9 2-2 2z"></path></svg></a>
                    </div>
                </div>
                </div>

            </aside>

        </div>

        <!-- Related Blogs Section -->
        @if($recentBlogs->isNotEmpty())
        <section class="related-blogs-section">
            <h2 class="related-title">Related Blogs</h2>
            <div class="related-grid">

                @foreach($recentBlogs as $rb)
                <article class="related-card" onclick="window.location.href='{{ url('/blog/' . $rb->slug) }}/';" style="cursor: pointer;">
                    @php
                        $rbImagePath = $rb->image ?? null;
                        $rbIsRemoteImage = $rbImagePath && \Illuminate\Support\Str::startsWith($rbImagePath, ['http://', 'https://']);
                        $rbPublicImagePath = $rbImagePath && \Illuminate\Support\Str::startsWith($rbImagePath, ['storage/', 'uploads/', 'images/'])
                            ? $rbImagePath
                            : ($rbImagePath ? 'storage/' . ltrim($rbImagePath, '/') : null);
                        $rbImg = ($rbIsRemoteImage || ($rbPublicImagePath && file_exists(public_path($rbPublicImagePath))))
                            ? ($rbIsRemoteImage ? $rbImagePath : asset($rbPublicImagePath))
                            : asset('images/below-hero.png');
                    @endphp
                    <a href="{{ url('/blog/' . $rb->slug) }}/" style="display:block;" onclick="event.stopPropagation();">
                        <img src="{{ $rbImg }}" alt="{{ $rb->title }}" class="related-card-img" onerror="this.src='{{ asset('images/below-hero.png') }}'">
                    </a>
                    <div class="related-card-body">
                        <div class="related-card-meta">
                            @php 
                                $bAuthor = !empty($rb->joined_author_name) ? $rb->joined_author_name : (!empty($rb->author_name) ? $rb->author_name : null);
                                $bAuthorSlug = !empty($rb->joined_author_slug) ? $rb->joined_author_slug : (!empty($rb->author_slug) ? $rb->author_slug : null);
                                
                                if (!$bAuthor) {
                                    $defaultAuthor = \Illuminate\Support\Facades\DB::table('admin_authors')->first();
                                    if ($defaultAuthor) {
                                        $bAuthor = $defaultAuthor->title;
                                        $bAuthorSlug = $defaultAuthor->slug;
                                    }
                                }
                                
                                $bAuthor = $bAuthor ?: 'Admin';
                                $bAuthorSlug = $bAuthorSlug ?: \Illuminate\Support\Str::slug($bAuthor);
                            @endphp
                            <a href="{{ url('/author/' . $bAuthorSlug) }}/" style="color:inherit;text-decoration:none;" onclick="event.stopPropagation();"><span>{{ $bAuthor }}</span></a>
                            <span>{{ date('M d, Y', strtotime($rb->created_at)) }}</span>
                        </div>
                        <a href="{{ url('/blog/' . $rb->slug) }}/" style="text-decoration:none; color:inherit; display:block;" onclick="event.stopPropagation();">
                            <h3 class="related-card-title">{{ $rb->title }}</h3>
                        </a>
                        <p class="related-card-desc">{{ Str::limit(html_entity_decode(html_entity_decode(strip_tags($rb->excerpt ?? $rb->content))), 90) }}</p>
                        <a href="{{ url('/blog/' . $rb->slug) }}/" class="related-card-btn" onclick="event.stopPropagation();">
                            <span>Read More</span> <span>&rarr;</span>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
        @endif

        @if(false)
        <!-- Final page actions, moved back into the right sidebar. -->
        <div class="article-end-widgets">
            <div class="newsletter-widget">
                <h3 class="newsletter-title">Stay Inspired</h3>
                <p class="newsletter-desc">Join 12,000+ brand leaders receiving weekly packaging insights and trend reports</p>
                <form class="newsletter-form" action="{{ url('/submit-newsletter') }}" method="POST">
                    @csrf
                    <input type="email" name="email" class="newsletter-input" placeholder="YOUR EMAIL" required>
                    <button type="submit" class="newsletter-btn">SUBSCRIBE</button>
                </form>
            </div>
            <div class="widget share-widget article-share-widget">
                <div class="widget-title">SHARE BLOG</div>
                <div class="social-buttons">
                    <a href="#" class="social-btn" aria-label="Facebook"><svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.714 5H18V0h-3.808C10.592 0 9 1.583 9 4.615V8z"/></svg></a>
                    <a href="#" class="social-btn" aria-label="Instagram"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                    <a href="#" class="social-btn" aria-label="Email"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
                    <a href="#" class="social-btn" aria-label="Bookmark"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14c0 1.1-.9 2-2 2z"></path></svg></a>
                </div>
            </div>
        </div>
        @endif

    </div>
</main>
@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {
    var articleBody = document.querySelector('.article-body');
    var tocList = document.getElementById('tocList');
    var tocWidget = document.getElementById('tocWidget');
    var mobileTocWidget = document.getElementById('mobileTocWidget');
    var mobileTocList = document.getElementById('mobileTocList');
    var mobileTocToggle = document.getElementById('mobileTocToggle');

    if (!articleBody) return;

    // Keep the TOC sticky until the static actions below it are reached, then
    // lock it directly above them. This creates a clean stop with no overlap.
    if (tocWidget) {
        var sidebar = tocWidget.closest('.sidebar');
        var staticActions = sidebar ? sidebar.querySelector('.sidebar-static-actions') : null;
        var tocStickyTop = 96;
        var tocWidgetGap = 28;
        var updateTocStopPoint = function () {
            if (!staticActions || !window.matchMedia('(min-width: 1025px)').matches) {
                tocWidget.classList.remove('toc-stopped-at-actions');
                tocWidget.style.removeProperty('--toc-stop-top');
                return;
            }

            var actionsRect = staticActions.getBoundingClientRect();
            var tocHeight = tocWidget.offsetHeight;

            if (tocWidget.classList.contains('toc-stopped-at-actions')) {
                if (actionsRect.top > tocStickyTop + tocHeight + tocWidgetGap) {
                    tocWidget.classList.remove('toc-stopped-at-actions');
                    tocWidget.style.removeProperty('--toc-stop-top');
                }
                return;
            }

            var tocRect = tocWidget.getBoundingClientRect();
            var tocIsPinned = tocRect.top <= tocStickyTop + 2;
            var hasReachedActions = actionsRect.top <= tocRect.bottom + tocWidgetGap;

            if (tocIsPinned && hasReachedActions) {
                var stopTop = Math.max(0, staticActions.offsetTop - tocHeight - tocWidgetGap);
                tocWidget.style.setProperty('--toc-stop-top', stopTop + 'px');
                tocWidget.classList.add('toc-stopped-at-actions');
            }
        };

        updateTocStopPoint();
        window.addEventListener('scroll', updateTocStopPoint, { passive: true });
        window.addEventListener('resize', updateTocStopPoint);
    }

    // Keep wide tables inside the article on small screens instead of widening the page.
    articleBody.querySelectorAll('table').forEach(function (table) {
        if (table.parentElement && table.parentElement.classList.contains('table-responsive')) return;

        var wrapper = document.createElement('div');
        wrapper.className = 'table-responsive';
        table.parentNode.insertBefore(wrapper, table);
        wrapper.appendChild(table);
    });

    if (!tocList && !mobileTocList) return;

    if (mobileTocToggle && mobileTocWidget) {
        mobileTocToggle.addEventListener('click', function () {
            var isOpen = mobileTocWidget.classList.toggle('is-open');
            mobileTocToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    // Get all h2 headings from article body
    var headings = articleBody.querySelectorAll('h2');

    if (headings.length === 0) {
        if (tocWidget) tocWidget.style.display = 'none';
        if (mobileTocWidget) mobileTocWidget.style.display = 'none';
        return;
    }

    var markTocItemActive = function (activeIndex) {
        document.querySelectorAll('.toc-item, .mobile-toc-item').forEach(function (item) {
            var isActive = Number(item.dataset.tocIndex) === activeIndex;
            item.classList.toggle('active', isActive);
            if (isActive && tocWidget && item.classList.contains('toc-item')) {
                tocWidget.scrollTop = Math.max(0, item.offsetTop - (tocWidget.clientHeight / 2) + (item.offsetHeight / 2));
            }
        });
    };

    // Generate TOC items
    headings.forEach(function (heading, index) {
        // Add ID to heading for anchor link
        var id = 'toc-heading-' + index;
        heading.setAttribute('id', id);

        var li = document.createElement('li');
        li.className = 'toc-item';
        li.dataset.tocIndex = index;

        var num = (index + 1).toString().padStart(2, '0');
        var a = document.createElement('a');
        a.href = '#' + id;
        a.textContent = num + '. ' + heading.textContent.trim();

        // Smooth scroll on click
        a.addEventListener('click', function (e) {
            e.preventDefault();
            markTocItemActive(index);
            heading.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        li.appendChild(a);
        if (tocList) tocList.appendChild(li);

        if (mobileTocList) {
            var mobileLi = document.createElement('li');
            mobileLi.className = 'mobile-toc-item';
            mobileLi.dataset.tocIndex = index;
            var mobileLink = a.cloneNode(true);
            mobileLink.addEventListener('click', function (e) {
                e.preventDefault();
                markTocItemActive(index);
                heading.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
            mobileLi.appendChild(mobileLink);
            mobileTocList.appendChild(mobileLi);
        }
    });

    // Highlight and keep in view the item for the section currently on screen.
    var updateActiveTocItem = function () {
        var activeIndex = 0;

        headings.forEach(function (heading, index) {
            if (heading.getBoundingClientRect().top <= 150) {
                activeIndex = index;
            }
        });

        markTocItemActive(activeIndex);
    };

    var tocScrollQueued = false;
    window.addEventListener('scroll', function () {
        if (tocScrollQueued) return;
        tocScrollQueued = true;
        window.requestAnimationFrame(function () {
            updateActiveTocItem();
            tocScrollQueued = false;
        });
    }, { passive: true });
    updateActiveTocItem();
});
</script>

</body>
</html>
