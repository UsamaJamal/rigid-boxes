<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    @include('components.canonical')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($settings['meta_title']) ? $settings['meta_title'] : 'Custom Printed Boxes' }}
    </title>
    <meta name="description"
        content="{{ !empty($settings['meta_description']) ? $settings['meta_description'] : 'Custom printed rigid packaging boxes at wholesale rates. Premium luxury boxes for retail, cosmetic, and gift packaging.' }}">
    @if(!empty($settings['meta_keywords']))
        <meta name="keywords" content="{{ $settings['meta_keywords'] }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Open+Sans:wght@300;400;600;700;800;900&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: clip;
            width: 100%;
        }

        body {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--background-color, #FAF8F8);
            color: #000000;
        }

        .home-page,
        .home-page>section {
            width: 100%;
            max-width: 100%;
            overflow-x: clip;
        }

        /* Shared canvas aligned with the header's centered 1440px container. */
        .home-page>section>[class$="-container"],
        .home-page>section>[class$="-inner"] {
            width: 100%;
            max-width: 1280px !important;
            margin-left: auto;
            margin-right: auto;
            padding-left: 55px !important;
            padding-right: 55px !important;
            box-sizing: border-box;
            min-width: 0;
        }

        @media (max-width: 768px) {

            .home-page>section>[class$="-container"],
            .home-page>section>[class$="-inner"] {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }

        @media (max-width: 480px) {

            .home-page>section>[class$="-container"],
            .home-page>section>[class$="-inner"] {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
        }

        /* ─────────────────────────────────────────
           SECTION: CUSTOM BOXES FOR EVERY INDUSTRY
        ───────────────────────────────────────── */
        .custom-boxes-section {
            background: #FAF8F8;
            padding: 10px 0 30px;
        }

        .custom-boxes-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
            text-align: center;
        }

        .custom-boxes-container h2 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 100%;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: var(--section-text-color);
            margin-bottom: 18px;
        }

        .custom-boxes-container .section-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
            letter-spacing: 0%;
            text-align: center;
            color: var(--section-text-color);
            max-width: 752px;
            margin: 0 auto 28px;
            text-align: justify;
        }

        /* ─────────────────────────────────────────
           CARDS GRID
        ───────────────────────────────────────── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 24px;
            justify-content: start;
            max-width: 100%;
            align-items: stretch;
        }

        /* ─────────────────────────────────────────
           CARD  (exact Figma spec)
        ───────────────────────────────────────── */
        .industry-card {
            width: 100%;
            min-height: 0;
            height: auto;
            background: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0px 0px 10px 0px #00000029;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        /* Card title — single line, never wraps */
        .industry-card__title {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 19px;
            line-height: 1.25;
            letter-spacing: 0%;
            text-transform: capitalize;
            text-align: left;
            color: var(--section-text-color);
            padding: 22px 17px 12px;
            white-space: normal;
            flex-shrink: 0;
        }

        /* Image area — Figma: left:8px w:275 h:266 */
        .industry-card__image-wrap {
            width: calc(100% - 16px);
            height: clamp(190px, 18vw, 230px);
            margin: 0 auto;
            overflow: hidden;
            flex-shrink: 0;
        }

        .industry-card__image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            transition: transform 0.35s ease;
        }

        @media (hover: hover) {
            .industry-card:hover .industry-card__image-wrap img {
                transform: scale(1.05);
            }
        }

        /* Bottom content area — grows to push button to same level across all cards */
        .industry-card__bottom {
            display: flex;
            flex-direction: column;
            flex: none;
            padding: 14px 17px 20px;
        }

        /* Text area — Figma: w:247 h:42 */
        .industry-card__text {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.5;
            color: #333;
            text-align: left;
            flex: 1;
            /* pushes button down */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Button — Figma: left:46px w:200 h:46
           border-radius:4px, border:1px, padding:12px 20px */
        .industry-card__btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            height: 46px;
            margin-top: 14px;
            margin-left: auto;
            margin-right: auto;
            background: #FFFFFF;
            color: #8D4445;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0%;
            text-align: center;
            text-decoration: none;
            border: 1px solid #8D4445;
            border-radius: 4px;
            padding: 11px 20px;
            cursor: pointer;
            transition: background 0.25s, color 0.25s, border-color 0.25s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        @media (hover: hover) {
            .industry-card__btn:hover {
                background: #8D4445;
                border-color: #8D4445;
                color: #fff;
            }
        }

        @media (max-width: 768px) {
            .industry-card__btn {
                background: #8D4445;
                color: #fff;
                border-color: #8D4445;
            }
        }

        /* ─────────────────────────────────────────
           VIEW ALL CATEGORIES BUTTON
           Figma: w:200 h:46, border-radius:4px,
                  padding:12/20/12/20, centered
        ───────────────────────────────────────── */
        .view-all-wrap {
            margin-top: 28px;
            display: flex;
            justify-content: center;
        }

        .view-all-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            height: 46px;
            background: #8D4445;
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 0%;
            text-decoration: none;
            border-radius: 4px;
            padding: 12px 20px;
            gap: 10px;
            cursor: pointer;
            transition: background 0.25s;
            border: none;
        }

        .view-all-btn:hover {
            background: #5F2D2F;
            color: #fff;
        }

        /* ─────────────────────────────────────────
           WHY CHOOSE US SECTION
        ───────────────────────────────────────── */
        .why-choose-section {
            background: var(--background-color, #FAF8F8);
            padding: 10px 0 30px;
        }

        .why-choose-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
            text-align: center;
        }

        .why-choose-container h2,
        .why-choose-container .h2-heading {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 100%;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: var(--section-text-color);
            margin-bottom: 12px;
        }

        .why-choose-container .why-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
            color: var(--section-text-color);
            margin-bottom: 36px;
        }

        /* ─────────────────────────────────────────
           BENTO WRAPPER
        ───────────────────────────────────────── */
        .why-bento {
            width: 100%;
            max-width: 100%;
            margin: 0;
            text-align: left;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            grid-template-rows: 160px 100px 160px;
            gap: 14px;
        }

        /* each row is a flex row */
        .why-row {
            display: contents;
        }

        .why-row+.why-row {
            margin-top: 0;
        }

        /* ── Base card ── */
        .why-card {
            border-radius: 16px;
            padding: 20px 16px;
            display: block;
            position: relative;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.03);
            flex-shrink: 0;
        }

        .why-card__title {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 15px;
            line-height: 1.2;
            color: var(--section-text-color);
            margin-bottom: 6px;
            text-align: center;
        }

        .why-card__text {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 12.5px;
            line-height: 1.4;
            color: var(--section-text-color);
            text-align: center;
        }

        .why-card__content {
            width: 100%;
            position: relative;
            z-index: 2;
        }

        /* ── Image box ── */
        .why-card__img-box {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 140px;
            background: transparent;
            border-radius: 12px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            gap: 10px;
            box-sizing: border-box;
        }

        .why-card__img-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 12px;
        }

        /* ─────────────────────────────────────────
           CARD 1 — pink-1: Free Design Support
        ───────────────────────────────────────── */
        .wc-pink1 {
            background: #FDF0F6;
            width: 100%;
            height: 274px;
            grid-column: 1;
            grid-row: 1 / span 2;
        }

        /* ─────────────────────────────────────────
           CARD 2 — pink-2: Premium Quality Materials
        ───────────────────────────────────────── */
        .wc-pink2 {
            background: #FCECEE;
            width: 100%;
            height: 274px;
            grid-column: 2;
            grid-row: 1 / span 2;
        }

        /* ─────────────────────────────────────────
           CARD 3 — blue: Low MOQ
        ───────────────────────────────────────── */
        .wc-blue {
            background: #EAF3FB;
            width: 100%;
            height: 160px;
            position: relative;
            grid-column: 3 / span 2;
            grid-row: 1;
            display: flex;
            align-items: center;
        }

        .wc-blue .why-card__content {
            max-width: 55%;
            position: relative;
            z-index: 2;
            text-align: left;
        }

        .wc-blue .why-card__title,
        .wc-blue .why-card__text,
        .wc-yellow .why-card__title,
        .wc-yellow .why-card__text {
            text-align: left;
        }

        .wc-blue .why-card__img-box {
            position: absolute;
            top: 0;
            right: 0;
            left: auto;
            transform: none;
            width: 58%;
            height: 100%;
            border-radius: 0;
        }

        .wc-blue .why-card__img-box img {
            object-fit: contain;
            object-position: right bottom;
            border-radius: 0;
        }

        /* ─────────────────────────────────────────
           CARD 4 — yellow: Dedicated Customer Service
        ───────────────────────────────────────── */
        .wc-yellow {
            background: #FDF7E7;
            width: 100%;
            height: 160px;
            grid-column: 1 / span 2;
            grid-row: 3;
            display: flex;
            align-items: center;
        }

        .wc-yellow .why-card__content {
            max-width: 55%;
            position: relative;
            z-index: 2;
        }

        .wc-yellow .why-card__img-box {
            top: 0;
            left: auto;
            right: 0;
            transform: none;
            width: 58%;
            height: 100%;
            border-radius: 0;
        }

        .wc-yellow .why-card__img-box img {
            object-fit: contain;
            object-position: right bottom;
            border-radius: 0;
        }

        /* ─────────────────────────────────────────
           CARD 5 — green: Custom Sizes & Designs
        ───────────────────────────────────────── */
        .wc-green {
            background: #ECFBEF;
            width: 100%;
            height: 274px;
            grid-column: 3;
            grid-row: 2 / span 2;
        }

        /* ─────────────────────────────────────────
           CARD 6 — skin: Fast Production Time
        ───────────────────────────────────────── */
        .wc-skin {
            background: #FDF3E9;
            width: 100%;
            height: 274px;
            grid-column: 4;
            grid-row: 2 / span 2;
        }

        /* ─────────────────────────────────────────
           RESPONSIVE — Why Choose Us
        ───────────────────────────────────────── */

        /* Laptop container padding */
        @media (max-width: 1300px) and (min-width: 993px) {
            .why-choose-container {
                padding: 0 24px;
            }

            .why-bento {
                gap: 10px;
            }

            .why-card {
                padding: 24px 18px;
            }

            .why-card__title {
                font-size: 16px;
                margin-bottom: 8px;
            }

            .why-card__text {
                font-size: 13px;
                line-height: 1.45;
            }
        }

        /* Tablet: 2-col fluid stack below 992px */
        @media (max-width: 992px) {
            .why-choose-container {
                padding: 0 24px;
            }

            .why-bento {
                width: 100%;
                display: block;
            }

            .why-row {
                display: flex;
                flex-wrap: wrap;
            }

            .why-row+.why-row {
                margin-top: 14px;
            }

            .wc-pink1,
            .wc-pink2 {
                width: calc(50% - 7px);
                height: 360px;
            }

            .wc-blue {
                width: 100%;
                height: auto;
                min-height: 280px;
            }

            .wc-blue .why-card__illus {
                left: auto;
                right: 24px;
                top: 17px;
            }

            .wc-blue .why-card__content {
                max-width: 55%;
            }

            .wc-yellow {
                width: 100%;
                height: auto;
                min-height: 180px;
            }

            .wc-green,
            .wc-skin {
                width: calc(50% - 7px);
                height: 242px;
            }
        }

        /* Mobile: single column */
        @media (max-width: 600px) {
            .why-choose-section {
                padding: 5px 0 40px;
            }

            .why-choose-container {
                padding: 0 16px;
            }

            .why-choose-container h2 {
                font-size: 24px;
            }

            .why-bento {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .why-row {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .why-row+.why-row {
                margin-top: 0;
            }

            .why-card {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                padding: 16px 18px !important;
                gap: 16px !important;
                border-radius: 16px !important;
                box-shadow: none !important;
                border: none !important;
            }

            .why-card__img-box,
            .why-card__illus {
                order: -1;
                width: 85px !important;
                height: 85px !important;
                margin: 0 !important;
                padding: 0 !important;
                background: transparent !important;
                position: static !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                transform: none !important;
            }

            .why-card__img-box img,
            .why-card__illus {
                width: 100% !important;
                height: 100% !important;
                object-fit: contain !important;
                object-position: center !important;
                
            }

            .why-card__content {
                order: 1;
                flex: 1 !important;
                width: auto !important;
                max-width: none !important;
                text-align: left !important;
            }

            .why-card__title {
                font-size: 16px !important;
                font-weight: 700 !important;
                margin-bottom: 4px !important;
                line-height: 1.25 !important;
                text-align: left !important;
            }

            .why-card__text {
                font-size: 13px !important;
                line-height: 1.45 !important;
                color: #444 !important;
                text-align: left !important;
            }

            .wc-pink1,
            .wc-pink2,
            .wc-blue,
            .wc-yellow,
            .wc-green,
            .wc-skin {
                width: 100% !important;
                height: auto !important;
                min-height: 0 !important;
            }
        }

        /* ─────────────────────────────────────────
           PREMIUM CUSTOM RIGID BOXES SECTION
        ───────────────────────────────────────── */
        .premium-section {
            background: var(--primary-color, #8D4445);
            padding: 40px 0 20px;
            overflow: hidden;
        }

        .premium-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 48px;
        }

        /* ── LEFT: two overlapping images ── */
        .premium-images {
            position: relative;
            width: 50%;
            height: 460px;
            flex-shrink: 0;
        }

        .premium-img1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 78%;
            height: 350px;
            border-radius: 21.12px;
            object-fit: cover;
            display: block;
        }

        /* img2 offset relative to img1 */
        .premium-img2 {
            position: absolute;
            top: 180px;
            left: 36%;
            width: 55%;
            height: 260px;
            border-radius: 15.51px;
            object-fit: cover;
            display: block;
            z-index: 2;
        }

        /* ── RIGHT: content col ── */
        .premium-content {
            width: auto;
            min-width: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .premium-heading {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 32px;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: #fff;
            margin-bottom: 20px;
            width: 100%;
        }

        .premium-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.6;
            letter-spacing: 0%;
            text-align: justify;
            color: rgba(255, 255, 255, 0.9);
            width: 100%;
            margin-bottom: 32px;
        }

        /* Icons row */
        .premium-icons {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 40px;
            margin-bottom: 32px;
        }

        .premium-icon-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 85px;
        }

        .premium-icon-item img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .premium-icon-text {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 15.07px;
            line-height: 16.75px;
            letter-spacing: 0%;
            text-align: center;
            color: #fff;
            width: 100%;
        }

        /* Order Now button */
        .premium-btn {
            display: inline-block;
            background: #fff;
            color: var(--primary-color, #8D4445);
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            text-decoration: none;
            border-radius: 4px;
            padding: 12px 40px;
            transition: background 0.25s, color 0.25s;
        }

        .premium-btn:hover {
            background: var(--secondary-color, #F8EEEC);
        }

        /* RESPONSIVE — Premium Section */
        @media (max-width: 1200px) {
            .premium-inner {
                padding: 0 40px;
                gap: 40px;
            }

            .premium-images {
                width: 440px;
                height: 420px;
            }

            .premium-img1 {
                width: 380px;
                height: 320px;
            }

            .premium-img2 {
                top: 160px;
                left: 160px;
                width: 260px;
                height: 240px;
            }

            .premium-content {
                width: auto;
                flex: 1;
            }

            .premium-heading,
            .premium-desc {
                width: 100%;
            }
        }

        @media (max-width: 900px) {
            .premium-inner {
                flex-direction: column;
                padding: 0 24px;
                gap: 32px;
            }

            .premium-images {
                width: 100%;
                height: 340px;
            }

            .premium-img1 {
                width: 75%;
                height: 260px;
            }

            .premium-img2 {
                top: 120px;
                left: 36%;
                width: 55%;
                height: auto;
                aspect-ratio: 370/341;
            }

            .premium-content {
                width: 100%;
            }

            .premium-heading,
            .premium-desc {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .premium-icons {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .premium-section {
                padding: 20px 0 30px;
            }

            .premium-inner {
                flex-direction: column;
                padding: 0 16px;
                gap: 24px;
            }

            .premium-heading {
                font-size: 22px;
                line-height: 28px;
                width: 100%;
            }

            .premium-desc {
                width: 100%;
                font-size: 14px;
            }

            .premium-icons {
                display: none;
            }

            .premium-content {
                width: 100%;
            }

            .premium-images {
                width: 100%;
                height: auto;
                position: relative;
            }

            .premium-img1 {
                width: 100%;
                height: auto;
                max-height: 350px;
                position: relative;
            }

            .premium-img2 {
                display: none;
            }
        }

        /* ─────────────────────────────────────────
           BEST SELLER SECTION
        ───────────────────────────────────────── */
        .bestseller-section {
            background: var(--secondary-color, #F8EEEC);
            padding: 20px 0;
            overflow: hidden;
            width: 100%;
        }

        .bestseller-inner {
            max-width: 1440px;
            width: 100%;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 40px;
            box-sizing: border-box;
            overflow: hidden;
        }

        /* Left content block — w:260 */
        .bestseller-left {
            width: 260px;
            flex-shrink: 0;
        }

        .bestseller-heading {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 40px;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: var(--section-text-color);
            margin-bottom: 16px;
        }

        .bestseller-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 22px;
            letter-spacing: 0%;
            text-align: justify;
            color: var(--section-text-color);
            margin-bottom: 24px;
        }

        /* Dots — 4 circles, total width ~76.5px */
        .bestseller-right {
            display: flex;
            flex-direction: column;
            gap: 24px;
            flex: 1;
            min-width: 0;
            width: 100%;
        }

        .bestseller-dots {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
        }

        .bestseller-dot {
            appearance: none;
            padding: 0;
            cursor: pointer;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            flex-shrink: 0;
            border: 2px solid var(--section-text-color, #000);
            background: transparent;
        }

        .bestseller-dot.active {
            background: var(--primary-color, #8D4445);
            border-color: var(--primary-color, #8D4445);
        }

        .bestseller-card--mobile-only {
            display: none !important;
        }

        /* Cards row */
        .bestseller-cards {
            display: flex;
            flex-direction: row;
            gap: 20px;
            width: 100%;
            min-width: 0;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            scroll-behavior: smooth;
        }

        .bestseller-cards::-webkit-scrollbar {
            display: none;
        }

        .bestseller-card {
            width: 275px;
            min-width: 275px;
            height: 325px;
            flex: 0 0 275px;
            border-radius: 17.22px;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: transparent;
        }

        .bestseller-card__img {
            width: 275px;
            height: 275px;
            aspect-ratio: auto;
            border-radius: 17.22px;
            overflow: hidden;
            border: 1.08px solid #4A4E541A;
            flex-shrink: 0;
        }

        .bestseller-card__img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 17.22px;
        }

        .bestseller-card__title {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 14px;
            line-height: 1.4;
            color: var(--section-text-color);
            text-align: center;
            padding: 10px 8px 0;
        }

        /* ─────────────────────────────────────────
           RESPONSIVE — Best Seller
        ───────────────────────────────────────── */
        @media (max-width: 1200px) {
            .bestseller-inner {
                padding: 0 40px;
                gap: 32px;
            }
        }

        @media (max-width: 768px) {
            .bestseller-section {
                padding: 10px 0 30px;
                margin-bottom: 20px;
            }

            .bestseller-inner {
                flex-direction: column;
                padding: 0 20px;
                gap: 20px;
                align-items: center;
                text-align: center;
            }

            .bestseller-left {
                width: 100%;
            }

            .bestseller-heading {
                font-size: 24px;
                line-height: 32px;
                text-align: center;
            }

            .bestseller-desc {
                font-size: 14px;
                text-align: center;
            }

            .bestseller-dots {
                display: none !important;
            }

            /* 2×2 card grid */
            .bestseller-cards {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
                gap: 12px;
                justify-content: flex-start;
            }

            .bestseller-card {
                width: calc(50% - 6px);
                min-width: 0;
                height: auto;
                flex: 0 0 calc(50% - 6px);
            }

            .bestseller-card--mobile-only {
                display: flex !important;
            }

            .bestseller-card__img {
                width: 100%;
                height: auto;
                aspect-ratio: 1 / 1;
            }

            .bestseller-card__img img {
                position: static;
                width: 100%;
                height: 100%;
            }
        }

        @media (min-width: 769px) and (max-width: 1920px) {
            .custom-boxes-container {
                padding: 0 24px;
            }

            .cards-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 16px;
            }

            .industry-card {
                width: 100%;
                min-height: 0;
                height: auto;
            }

            .industry-card__title {
                font-size: 15px;
                padding: 16px 10px 8px;
            }

            .industry-card__image-wrap {
                width: calc(100% - 12px);
                height: clamp(150px, 19vw, 220px);
            }

            .industry-card__bottom {
                padding: 12px;
                flex: none;
            }

            .industry-card__text {
                font-size: 14px;
            }

            .industry-card__btn {
                height: 40px;
                font-size: 14px;
                margin-top: 10px;
                width: min(200px, 100%);
            }

            .view-all-wrap {
                margin-top: 35px;
            }
        }

        /* Tablet portrait */
        @media (max-width: 768px) {
            .custom-boxes-section {
                padding: 24px 0 20px;
            }

            .custom-boxes-container {
                padding: 0 20px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .industry-card {
                width: 100%;
                min-height: auto;
            }

            .industry-card__title {
                font-size: 15px;
                padding: 14px 12px 6px;
            }

            .industry-card__image-wrap {
                width: calc(100% - 16px);
                height: 180px;
            }

            .industry-card__bottom {
                padding: 12px;
            }

            .industry-card__btn {
                width: 100%;
                margin-left: 0;
                margin-top: 12px;
                height: 40px;
                font-size: 14px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .custom-boxes-container {
                padding: 0 12px !important;
            }

            .custom-boxes-container h2 {
                font-size: 24px;
            }

            .custom-boxes-container .section-desc {
                font-size: 14px;
                margin-bottom: 24px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .industry-card__title {
                font-size: 12px;
                line-height: 1.25;
                padding: 10px 8px 4px;
            }

            .industry-card__image-wrap {
                width: 100%;
                height: 140px;
                padding: 0 6px;
                box-sizing: border-box;
            }

            .industry-card__bottom {
                padding: 8px 10px 12px;
            }

            .industry-card__text {
                font-size: 11px;
                line-height: 1.35;
            }

            .industry-card__btn {
                font-size: 12px;
                height: 36px;
                padding: 7px 10px;
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }

            .view-all-btn {
                font-size: 14px;
                width: 180px;
            }
        }

        /* ─────────────────────────────────────────
           CUSTOMIZE EVERY DETAIL SECTION
        ───────────────────────────────────────── */
        .customize-detail-section {
            background: var(--background-color, #FAF8F8);
            padding: 48px 0 25px;
        }

        .customize-detail-inner {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 24px !important;
            box-sizing: border-box;
        }

        /* Heading */
        .customize-detail-heading {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 100%;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: var(--section-text-color);
            text-align: center;
            margin-bottom: 12px;
        }

        /* Paragraph */
        .customize-detail-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
            color: var(--section-text-color);
            max-width: 548px;
            margin: 0 auto 24px;
        }

        /* Options pill bar */
        .customize-detail-options-wrapper {
            width: 100%;
            margin: 0 0 20px 0;
            overflow-x: auto;
            scrollbar-width: none;
            cursor: grab;
        }

        .customize-detail-options-wrapper::-webkit-scrollbar {
            display: none;
        }

        .customize-detail-options-wrapper.grabbing {
            cursor: grabbing;
        }

        .customize-detail-options {
            min-width: 100%;
            width: max-content;
            border: 1px solid var(--section-text-color, #000);
            border-radius: 100px;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 5px 6px;
            gap: 4px;
            justify-content: space-between;
            user-select: none;
            box-sizing: border-box;
        }

        .cdo-btn {
            flex: 1 1 auto;
            height: 40px;
            padding: 0 20px;
            border-radius: 100px;
            border: none;
            background: transparent;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            color: var(--section-text-color);
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.2s, color 0.2s;
        }

        .cdo-btn.active {
            background: #8d4445;
            color: #fff;
        }

        .cdo-btn:hover:not(.active) {
            background: transparent;
        }

        /* Cards row */
        .customize-detail-cards {
            width: 100%;
            max-width: none;
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: center;
        }

        /* Each card: equal flex, square-ish aspect ratio */
        .cdc-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            flex: 0 1 350px;
            width: 100%;
            max-width: 350px;
            min-width: 0;
            aspect-ratio: 350 / 406;
            background: #e8e8e8;
        }

        .cdc-card img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            display: block;
        }

        .cdc-card__label {
            display: none;
        }

        /* ─────────────────────────────────────────
           RESPONSIVE — Customize Detail
        ───────────────────────────────────────── */
        @media (max-width: 1200px) {
            .customize-detail-inner {
                padding: 0 24px;
            }

            .cdo-btn {
                font-size: 14px;
                padding-inline: 14px;
            }
        }

        @media (max-width: 900px) {
            .customize-detail-inner {
                padding: 0 24px !important;
            }
        }

        @media (max-width: 768px) {
            .customize-detail-section {
                padding: 20px 0 26px;
            }

            .customize-detail-inner {
                padding: 0 20px !important;
            }

            .customize-detail-heading {
                font-size: 24px;
            }

            .customize-detail-desc {
                font-size: 14px;
                max-width: 100%;
            }

            .customize-detail-options {
                justify-content: flex-start;
                gap: 8px;
            }

            .cdo-btn {
                font-size: 13px;
                padding: 0 14px;
                height: 38px;
                flex: 0 0 auto;
            }

            /* horizontal scroll */
            .customize-detail-cards {
                flex-direction: row;
                gap: 14px;
                overflow-x: auto;
                justify-content: flex-start;
                scrollbar-width: none;
                -ms-overflow-style: none;
                scroll-behavior: smooth;
            }

            .customize-detail-cards::-webkit-scrollbar {
                display: none;
            }

            .cdc-card {
                flex: 0 0 80vw;
                width: 80vw;
                max-width: 350px;
                aspect-ratio: 350 / 406;
                align-self: center;
            }
        }

        /* ─────────────────────────────────────────
           SUSTAINABLE PACKAGING SOLUTIONS SECTION
        ───────────────────────────────────────── */
        .sustainable-section {
            background: #FAF8F8;
            padding: 20px 0 20px;
        }

        .sustainable-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* heading */
        .sustainable-heading {
            display: block;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 100%;
            letter-spacing: 0%;
            text-transform: capitalize;
            color: var(--section-text-color);
            text-align: center;
            margin-bottom: 12px;
        }

        /* paragraph */
        .sustainable-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
            text-align: justify;
            color: var(--section-text-color);
            max-width: 624px;
            margin: 0 auto 24px;
        }

        /* 2-col grid: left big image | right two stacked images */
        .sustainable-grid {
            width: 100%;
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: stretch;
        }

        /* ── LEFT: big image with overlay text + button ── */
        .sustainable-left {
            width: 606px;
            height: 600px;
            flex-shrink: 0;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .sustainable-left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 8px;
        }

        .sustainable-left__overlay {
            position: absolute;
            bottom: 44px;
            left: 56px;
            right: 24px;
        }

        .sustainable-eco-label {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 18px;
            line-height: 100%;
            color: #fff;
            margin-bottom: 12px;
            display: block;
        }

        .sustainable-tagline {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 1.2;
            color: #fff;
            margin-bottom: 20px;
            max-width: 439px;
        }

        .sustainable-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            height: 50px;
            background: var(--primary-color, #8D4445);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            border-radius: 4px;
            padding: 12px 20px;
            gap: 10px;
            box-shadow: 0px 2px 4px 0px #00000040;
            transition: background 0.25s;
        }

        .sustainable-btn:hover {
            background: var(--footer-color, #5F2D2F);
        }

        /* ── RIGHT: two stacked images ── */
        .sustainable-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: 600px;
        }

        .sustainable-right__card {
            flex: 1;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            min-height: 0;
        }

        .sustainable-right__card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 8px;
        }

        .sustainable-right__label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 32px;
            line-height: 100%;
            color: #FFFFFF;
            white-space: nowrap;
        }

        /* ─────────────────────────────────────────
           RESPONSIVE — Sustainable
        ───────────────────────────────────────── */
        @media (max-width: 1200px) {
            .sustainable-inner {
                padding: 0 40px;
            }

            .sustainable-left {
                width: 48%;
            }
        }

        @media (max-width: 768px) {
            .sustainable-section {
                padding: 0px 0 25px;
            }

            .sustainable-inner {
                padding: 0 16px;
            }

            .sustainable-heading {
                font-size: 24px;
                line-height: 1.2;
            }

            .sustainable-desc {
                font-size: 14px;
                max-width: 100%;
            }

            /* horizontal scroll */
            .sustainable-grid {
                flex-direction: row;
                gap: 14px;
                overflow-x: auto;
                justify-content: flex-start;
                scrollbar-width: none;
                -ms-overflow-style: none;
                scroll-behavior: smooth;
            }

            .sustainable-grid::-webkit-scrollbar {
                display: none;
            }

            .sustainable-left {
                width: 100%;
                height: 380px;
                flex: 1;
            }

            /* overlay adjustments */
            .sustainable-left__overlay {
                left: 20px;
                right: 20px;
                bottom: 28px;
            }

            .sustainable-eco-label {
                font-size: 13px;
                margin-bottom: 8px;
            }

            .sustainable-tagline {
                font-size: 22px;
                line-height: 1.25;
                margin-bottom: 16px;
            }

            .sustainable-btn {
                width: 170px;
                height: 44px;
                font-size: 14px;
            }

            /* right column: hide on mobile as requested */
            .sustainable-right {
                display: none;
            }

            .sustainable-right__card {
                width: 85vw;
                height: 380px;
                flex: 0 0 85vw;
            }

            .sustainable-right__label {
                font-size: 18px;
                white-space: normal;
                text-align: center;
                width: 90%;
            }
        }


        /* ═══════════════════════════════════
           CUSTOM QUOTE
        ═══════════════════════════════════ */
        .quote-section {
            background: var(--primary-color);
            width: 100%;
            padding: 20px 0 54px;
            position: relative;
            overflow: hidden;
            margin-top: 20px;
        }

        .quote-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: stretch;
            gap: 40px;
            position: relative;
            z-index: 2;
        }

        .quote-form-card {
            width: 739px;
            min-height: 712px;
            flex-shrink: 0;
            background: #fff;
            border-radius: 20px;
            padding: 46px;
            box-sizing: border-box;
        }

        .quote-form-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 32px !important;
            font-weight: 800;
            color: var(--section-text-color);
            text-align: center;
            margin-bottom: 28px;
        }

        .form-section-label {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: var(--primary-color);
            margin-bottom: 10px;
            margin-top: 22px;
        }

        .form-row {
            display: flex;
            gap: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-row input,
        .form-row select,
        .form-row textarea {
            flex: 1;
            min-width: 0;
            height: 44px;
            border: 0.2px solid var(--section-text-color);
            border-radius: 6px;
            padding: 0 14px;
            font-size: 14px;
            color: #333;
            background: #FAFAFA;
            outline: none;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-row input::placeholder,
        .form-row textarea::placeholder {
            color: #AAAAAA;
        }

        .form-row input:focus,
        .form-row select:focus,
        .form-row textarea:focus {
            border-color: var(--primary-color);
            background: #fff;
        }

        .select-wrapper {
            flex: 1;
            min-width: 0;
            position: relative;
        }

        .select-wrapper select {
            width: 100%;
            padding-right: 36px;
            cursor: pointer;
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #666;
            pointer-events: none;
        }

        .specs-row {
            display: flex;
            gap: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .specs-row input {
            flex: 1;
            min-width: 0;
            height: 44px;
            border: 0.2px solid var(--section-text-color);
            border-radius: 6px;
            padding: 0 14px;
            font-size: 14px;
            color: #333;
            background: #FAFAFA;
            outline: none;
            box-sizing: border-box;
        }

        .specs-unit {
            position: relative;
            width: 72px;
            flex-shrink: 0;
        }

        .specs-unit select {
            width: 100%;
            height: 44px;
            border: 0.2px solid var(--section-text-color);
            border-radius: 6px;
            padding: 0 24px 0 10px;
            font-size: 14px;
            color: #333;
            background: #FAFAFA;
            appearance: none;
            -webkit-appearance: none;
            box-sizing: border-box;
        }

        .specs-unit::after {
            content: '';
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid #666;
            pointer-events: none;
        }

        .preferences-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            width: 100%;
        }

        .textarea-row {
            width: 100%;
        }

        .textarea-row textarea {
            width: 100%;
            height: 128px;
            border: 0.2px solid var(--section-text-color);
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 14px;
            color: #333;
            background: #FAFAFA;
            outline: none;
            resize: vertical;
            box-sizing: border-box;
        }

        .quote-btn-wrap {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .quote-submit-btn {
            width: 284px;
            height: 50px;
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .quote-steps {
            flex: 1;
            padding-top: 57px;
            display: flex;
            flex-direction: column;
        }

        .quote-steps-inner {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .quote-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            position: relative;
        }

        .quote-step:not(:last-child) {
            flex-grow: 1;
            padding-bottom: 40px;
        }

        .quote-step:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 36px;
            top: 73px;
            bottom: 0;
            width: 1px;
            background: rgba(255, 255, 255, 0.15);
        }

        .step-number-block {
            position: relative;
            flex-shrink: 0;
            width: 117px;
        }

        .step-num-box {
            width: 73px;
            height: 73px;
            background: #fff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-color);
            z-index: 2;
            flex-shrink: 0;
        }

        .step-ghost-num {
            position: absolute;
            left: 85px;
            top: -12px;
            font-size: 80px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.15);
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }

        .step-text {
            flex: 1;
            padding-top: 6px;
        }

        .step-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 18px !important;
            font-weight: 800;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .step-desc {
            font-size: 14px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.75);
        }

        @media (max-width: 1280px) {
            .quote-container {
                padding: 0 40px;
                gap: 30px;
            }

            .quote-form-card {
                width: 600px;
            }
        }

        @media (max-width: 992px) {
            .quote-section {
                padding: 40px 0 50px;
                margin-top: 0;
            }

            .quote-container {
                flex-direction: column-reverse;
                padding: 0 5%;
            }

            .quote-form-card {
                width: 100%;
                min-height: unset;
            }

            .quote-steps {
                padding-top: 0;
                padding-bottom: 40px;
            }
        }

        @media (max-width: 576px) {
            .quote-container {
                padding: 0 5%;
            }

            .quote-form-card {
                padding: 20px;
                border-radius: 18px;
            }

            .quote-form-title {
                font-size: 20px !important;
            }

            .form-row {
                flex-direction: column;
                gap: 10px;
            }

            .preferences-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quote-submit-btn {
                width: 90%;
            }
        }

        /* ═══════════════════════════════════
           TEXT CONTENT
        ═══════════════════════════════════ */
        .text-content-section {
            background: var(--background-color);
            padding: 25px 0;
        }

        .text-content-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: center;
        }

        .text-content-card {
            width: 100%;
            max-width: 1030px;
            background: #fff;
            border-radius: 40px;
            border: 1px solid var(--section-text-color);
            padding: 48px 20px 48px 56px;
            box-sizing: border-box;
            height: 787px;
        }

        .text-content-inner {
            height: 100%;
            overflow-y: auto;
            padding-right: 26px;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) #F0F0F0;
        }

        .text-content-inner::-webkit-scrollbar {
            width: 10px;
        }

        .text-content-inner::-webkit-scrollbar-track {
            background: #F0F0F0;
            border-radius: 20px;
        }

        .text-content-inner::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 20px;
        }

        .text-content-heading {
            font-family: 'Open Sans', sans-serif;
            font-size: 24px !important;
            font-weight: 700;
            color: #000;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .text-content-body p {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            color: #000;
            line-height: 1.7;
            margin-bottom: 14px;
        }

        .text-content-body a {
            color: #333;
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .text-content-card {
                padding: 36px 32px;
                height: auto;
            }

            .text-content-inner {
                height: auto;
                overflow-y: visible;
                padding-right: 0;
            }
        }

        @media (max-width: 576px) {
            .text-content-section {
                padding: 20px 0;
            }

            .text-content-card {
                padding: 28px 20px;
                border-radius: 20px;
                height: auto;
            }

            .text-content-heading {
                font-size: 20px !important;
            }

            .text-content-body p,
            .text-content-body ul li {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    @php
        $settings = $settings ?? [];
        $categories = $categories ?? [];
        $products = $products ?? [];
    @endphp

    @include('components.header')

    <main class="home-page">
        @include('components.herohome')
        @include('components.logo')
        <!-- Custom Printed Boxes for Every Industry Section -->
        <section class="custom-boxes-section">
            <div class="custom-boxes-container">

                <h2>Great Unboxing Starts with the Right Structure</h2>
                <p class="section-desc">Box opening changes customer’s experience instantly. Right structure anticipates a customer’s pleasant unboxing experience. Explore our rigid box styles and choose the one that matches your vision.</p>

                <div class="cards-grid">
                    @php
                        $featuredCatIds = (array) ($settings['featured_categories'] ?? []);
                        
                        // Categories from Home Settings
                        $settingCategories = collect($categories)->whereIn('id', $featuredCatIds);
                        
                        // Categories where "Show on home page" is checked
                        $homeCategories = collect($categories)->where('show_home', 1);
                        
                        // Combine both and ensure no duplicates, limit to 8
                        $featuredCategories = $homeCategories->merge($settingCategories)->unique('id')->take(8)->all();
                        
                        // Fallback if none are selected
                        if (empty($featuredCategories)) {
                            $featuredCategories = array_slice($categories, 0, 8);
                        }
                    @endphp

                    @foreach ($featuredCategories as $cat)
                        @php
                            $catSlug = $cat['slug'] ?? Str::slug($cat['title']);
                            $catUrl = url('/' . $catSlug) . '/';
                            $cImg = !empty($cat['image'])
                                ? (\Illuminate\Support\Str::startsWith($cat['image'], [
                                    'storage/',
                                    'uploads/',
                                    'images/',
                                ])
                                    ? $cat['image']
                                    : 'storage/' . $cat['image'])
                                : 'uploads/Gift-Boxes.webp';
                        @endphp
                        <div class="industry-card">
                            <a href="{{ $catUrl }}" style="text-decoration:none; color:inherit;">
                                <span class="industry-card__title">{{ $cat['title'] }}</span>
                            </a>
                            <a href="{{ $catUrl }}" class="industry-card__image-wrap" style="display:block;">
                                <img src="{{ asset($cImg) }}" alt="{{ $cat['title'] }}" loading="lazy"
                                    onerror="this.src='https://placehold.co/275x266/dddddd/555555?text={{ urlencode($cat['title']) }}'">
                            </a>
                            <div class="industry-card__bottom">
                                <p class="industry-card__text">
                                    {{ Str::limit(html_entity_decode(html_entity_decode(strip_tags($cat['description'] ?? 'Premium packaging with a luxury feel and durable structure.'))), 80) }}
                                </p>
                                <a href="{{ $catUrl }}" class="industry-card__btn">Explore Boxes</a>
                            </div>
                        </div>
                    @endforeach
                </div><!-- /.cards-grid -->

                <!-- View All Categories Button -->
                <div class="view-all-wrap">
                    <a href="{{ url('/box-by-industry') }}/" class="view-all-btn">View All Categories</a>
                </div>

            </div><!-- /.custom-boxes-container -->
        </section>

        <!-- ═══════════════════════════════════════
             WHY CHOOSE US SECTION
        ═══════════════════════════════════════ -->
        <section class="why-choose-section">
            <div class="why-choose-container">

                <span class="h2-heading">What Sets Our Boxes Apart</span>
                <p class="why-desc">Our aim is to present your products in a premium packaging. From design support to choosing the material, our team assists you to achieve your business goals.</p>

                <div class="why-bento">

                    <!-- ROW 1: pink1 (299×413) | pink2 (299×413) | blue (612×413) -->
                    <div class="why-row">

                        <!-- CARD 1 — pink-1: Free Design Support -->
                        <div class="why-card wc-pink1">
                            <div class="why-card__content">
                                <span class="why-card__title">Creative Direction</span>
                                <p class="why-card__text">We have professional designers who provide assistance with artwork, reference images and early concepts. We don’t charge extra for this service.</p>
                            </div>
                            <div class="why-card__img-box">
                                <img src="{{ asset('uploads/why-design-support.png') }}"
                                    alt="Packaging designer creating a custom box dieline" loading="lazy">
                            </div>
                        </div>

                        <!-- CARD 2 — pink-2: Premium Quality Materials -->
                        <div class="why-card wc-pink2">
                            <div class="why-card__content">
                                <span class="why-card__title">Material Integrity</span>
                                <p class="why-card__text">Get sturdy boxes made from premium materials that offer great protection with an elite presentation.</p>
                            </div>
                            <div class="why-card__img-box">
                                <img src="{{ asset('uploads/why-premium-materials.png') }}"
                                    alt="Sample materials showing paper and cardstock swatches" loading="lazy">
                            </div>
                        </div>

                        <!-- CARD 3 — blue: Low MOQ -->
                        <div class="why-card wc-blue">
                            <div class="why-card__content">
                                <span class="why-card__title">Flexible Order Runs: NO MOQ</span>
                                <p class="why-card__text">Choose an order quantity that makes sense for your current plans. We do not have any low minimum quantity (MOQ) rule.
</p>
                            </div>
                            <div class="why-card__img-box">
                                <img src="{{ asset('uploads/why-low-moq.png') }}"
                                    alt="Custom box sample representing low MOQ orders" loading="lazy">
                            </div>
                        </div>

                    </div><!-- /.why-row -->

                    <!-- ROW 2 & 3: yellow (612×242) | green (299×413) | skin (299×413) -->
                    <div class="why-row">

                        <!-- CARD 4 — yellow: Dedicated Customer Service -->
                        <div class="why-card wc-yellow">
                            <div class="why-card__content">
                                <span class="why-card__title">Precision Sizing</span>
                                <p class="why-card__text">Your boxes are manufactured according to the provided dimensions. We customize the internal space, opening style, and fitted insert.</p>
                            </div>
                            <div class="why-card__img-box">
                                <img src="{{ asset('uploads/why-customer-service.png') }}"
                                    alt="Customer service specialist with headset smiling" loading="lazy">
                            </div>
                        </div>

                        <!-- CARD 5 — green: Custom Sizes & Designs -->
                        <div class="why-card wc-green">
                            <div class="why-card__content">
                                <span class="why-card__title">Guidance at Every Turn</span>
                                <p class="why-card__text">Our team assistance is available 24/7. Specialists guide you throughout the process.</p>
                            </div>
                            <div class="why-card__img-box">
                                <img src="{{ asset('uploads/custom-sizes-and-designs-transparent.png') }}"
                                    alt="Custom Sizes and Designs" loading="lazy">
                            </div>
                        </div>

                        <!-- CARD 6 — skin: Fast Production Time -->
                        <div class="why-card wc-skin">
                            <div class="why-card__content">
                                <span class="why-card__title">Reliable Turnaround</span>
                                <p class="why-card__text">Right on schedule, every order. Your deadline is our commitment; so, you will receive your package on time.
</p>
                            </div>
                            <div class="why-card__img-box">
                                <img src="{{ asset('uploads/fast-production-management.png') }}"
                                    alt="Fast Production Management" loading="lazy">
                            </div>
                        </div>

                    </div><!-- /.why-row row-2 -->

                </div><!-- /.why-bento -->

            </div><!-- /.why-choose-container -->
        </section>

        <!-- ═══════════════════════════════════════
             BEST SELLER SECTION
        ═══════════════════════════════════════ -->
        <section class="bestseller-section">
            <div class="bestseller-inner">

                <!-- Left: heading + desc -->
                <div class="bestseller-left">
                    <span class="bestseller-heading">Best Seller Product</span>
                    <p class="bestseller-desc">Custom packaging designed for different industries. Whether it's retail,
                        beauty, or electronics, we create packaging that fits your industry's style and requirements.
                    </p>

                    <div class="bestseller-dots" id="bestsellerDots" role="tablist" aria-label="Best seller products">
                        <!-- Dots will be generated dynamically by JS -->
                    </div>
                </div>

                <div class="bestseller-right">
                    <div class="bestseller-cards">
                        @php
                            $bestsellerProdIds = (array) ($settings['bestseller_products'] ?? []);
                            $bestsellerProducts = collect($products)->whereIn('id', $bestsellerProdIds)->all();
                            if (empty($bestsellerProducts)) {
                                $bestsellerProducts = array_slice($products, 0, 6);
                            }
                        @endphp

                        @foreach ($bestsellerProducts as $prod)
                            @php
                                $prodSlug = $prod['slug'] ?? Str::slug($prod['title']);
                                $prodUrl = url('/' . $prodSlug) . '/';
                                $pImg = !empty($prod['image'])
                                    ? (\Illuminate\Support\Str::startsWith($prod['image'], [
                                        'storage/',
                                        'uploads/',
                                        'images/',
                                    ])
                                        ? $prod['image']
                                        : 'storage/' . $prod['image'])
                                    : 'uploads/best-seller-p1.png';
                            @endphp
                            <a href="{{ $prodUrl }}" class="bestseller-card"
                                style="text-decoration:none; color:inherit;">
                                <div class="bestseller-card__img">
                                    <img src="{{ asset($pImg) }}" alt="{{ $prod['title'] }}" loading="lazy"
                                        onerror="this.src='https://placehold.co/284x284/eeeeee/555555?text={{ urlencode($prod['title']) }}'">
                                </div>
                                <p class="bestseller-card__title">{{ $prod['title'] }}</p>
                            </a>
                        @endforeach
                    </div><!-- /.bestseller-cards -->

                </div><!-- /.bestseller-dots removed -->
            </div><!-- /.bestseller-right -->

            </div><!-- /.bestseller-inner -->
        </section>

        <!-- ═══════════════════════════════════════
             PREMIUM CUSTOM RIGID BOXES SECTION
        ═══════════════════════════════════════ -->
        <section class="premium-section">
            <div class="premium-inner">

                <!-- LEFT: two overlapping images -->
                <div class="premium-images">
                    <img class="premium-img1" src="{{ asset('uploads/premium-rigid-boxes-showcase.webp') }}"
                        alt="Premium Custom Rigid Boxes" loading="lazy"
                        onerror="this.src='https://placehold.co/504x465/6b3a3a/ffffff?text=Premium+Boxes'">
                    <img class="premium-img2" src="{{ asset('uploads/luxury-rigid-box-detail.webp') }}"
                        alt="Luxury Rigid Box Detail" loading="lazy"
                        onerror="this.src='https://placehold.co/370x341/7a4040/ffffff?text=Luxury+Box'">
                </div>

                <!-- RIGHT: content col -->
                <div class="premium-content">

                    <span class="premium-heading">Give Your Product the Presentation It Deserves</span>

                    <p class="premium-desc">A thoughtful packaging box shows the value of the product inside it. Before opening the box, customers get expectations based on the packaging. Our rigid boxes have structural strength to protect your products and have custom-fitted inserts to restrict the movement. Finely designed box with exceptional wrapping makes the presentation premium. A box with top-tier branded elements wins customer’s heart even before opening it.
From customized dimensions to box style, color, interior, layout and refined finishing; we give the best to boost your brand identity. Get magnetic closure rigid boxes to uplift your gift collections. We ensure your delicate products are safe while the unboxing experience is unforgettable.
</p>

                    <!-- Icons row -->
                    <div class="premium-icons">

                        <div class="premium-icon-item">
                            <img src="{{ asset('uploads/icon-premium-quality.svg') }}" alt="Premium Quality" loading="lazy"
                                onerror="this.src='https://placehold.co/50x50/ffffff/8D4445?text=Q'">
                            <span class="premium-icon-text">Premium Quality</span>
                        </div>

                        <div class="premium-icon-item">
                            <img src="{{ asset('uploads/icon-custom-design.svg') }}" alt="Custom Designs" loading="lazy"
                                onerror="this.src='https://placehold.co/50x50/ffffff/8D4445?text=D'">
                            <span class="premium-icon-text">Custom Designs</span>
                        </div>

                        <div class="premium-icon-item">
                            <img src="{{ asset('uploads/icon-fast-delivery.svg') }}" alt="Fast & Reliable Delivery" loading="lazy"
                                onerror="this.src='https://placehold.co/50x50/ffffff/8D4445?text=F'">
                            <span class="premium-icon-text">Fast &amp; Reliable Delivery</span>
                        </div>

                    </div><!-- /.premium-icons -->

                    <a href="/request-quote/" class="premium-btn">Order Now</a>

                </div><!-- /.premium-content -->

            </div><!-- /.premium-inner -->
        </section>

        <!-- ═══════════════════════════════════════
             CUSTOMIZE EVERY DETAIL SECTION
        ═══════════════════════════════════════ -->
        <section class="customize-detail-section">
            <div class="customize-detail-inner">

                <span class="customize-detail-heading">Make Every Detail Distinctly Yours</span>
                <p class="customize-detail-desc">We manufacture packaging exclusively for your products. To give the boxes a premium appearance, choose the customized finishing. Foil stamping, embossing, protective laminations, magnetic closures, fitted inserts, and coatings make the box distinctly yours.</p>

                <!-- Options pill bar (scrollable, draggable) -->
                <div class="customize-detail-options-wrapper" id="cdoBar">
                    <div class="customize-detail-options">
                        <button type="button" class="cdo-btn active" data-cdo="foiling">Foiling</button>
                        <button type="button" class="cdo-btn" data-cdo="embossing">Embossing/Debossing</button>
                        <button type="button" class="cdo-btn" data-cdo="laminations">Laminations</button>
                        <button type="button" class="cdo-btn" data-cdo="magnetic">Magnetic Closure</button>
                        <button type="button" class="cdo-btn" data-cdo="inserts">Custom Inserts</button>
                        <button type="button" class="cdo-btn" data-cdo="coating">Coating</button>
                    </div>
                </div>

                <!-- Cards -->
                <div class="customize-detail-cards" id="cdoCards">

                    <div class="cdc-card cdc-card--gold">
                        <img src="{{ asset('uploads/addon-gold-foil.webp') }}" alt="Gold Foil" id="cdo-img-1" loading="lazy"
                            onerror="this.src='https://placehold.co/350x406/d4af37/fff?text=Gold+Foil'">
                        <span class="cdc-card__label" id="cdo-label-1">Gold Foil</span>
                    </div>

                    <div class="cdc-card cdc-card--silver">
                        <img src="{{ asset('uploads/silver-Foiling.webp') }}" alt="Silver Foil" id="cdo-img-2" loading="lazy"
                            onerror="this.src='https://placehold.co/345x403/c0c0c0/333?text=Silver+Foil'">
                        <span class="cdc-card__label" id="cdo-label-2">Silver Foil</span>
                    </div>

                    <div class="cdc-card cdc-card--holo">
                        <img src="{{ asset('uploads/addon-Holographic.webp') }}" alt="Holographic Foil"
                            id="cdo-img-3" loading="lazy"
                            onerror="this.src='https://placehold.co/364x403/ccaaff/333?text=Holographic+Foil'">
                        <span class="cdc-card__label" id="cdo-label-3">Holographic Foil</span>
                    </div>

                </div><!-- /.customize-detail-cards -->

            </div><!-- /.customize-detail-inner -->
        </section>

        <!-- ═══════════════════════════════════════
             SUSTAINABLE PACKAGING SOLUTIONS SECTION
        ═══════════════════════════════════════ -->
        <section class="sustainable-section">
            <div class="sustainable-inner">

                <span class="sustainable-heading">A Greener Approach to Rigid Packaging</span>
                <p class="sustainable-desc">The Rigid Boxes recognizes the eco-friendly approach in packaging. We have recycled board options for eco-friendly packaging that keeps the environment safe. Get strong presentation that appeals customers with sustainability.<p>

                <div class="sustainable-grid">

                    <!-- LEFT: big image with overlay -->
                    <div class="sustainable-left">
                        <img src="{{ asset('uploads/eco-friendly-img.webp') }}" alt="Eco-Friendly Packaging" loading="lazy"
                            onerror="this.src='https://placehold.co/606x600/c4a882/fff?text=Eco+Packaging'">
                        <div class="sustainable-left__overlay">
                            <span class="sustainable-eco-label">ECO-FRIENDLY PACKAGING</span>
                            <p class="sustainable-tagline">Go Green With Sustainably Responsible Packaging</p>
                            <a href="/kraft-boxes/" class="sustainable-btn">Browse Products</a>
                        </div>
                    </div>

                    <!-- RIGHT: two stacked images -->
                    <div class="sustainable-right">

                        <div class="sustainable-right__card">
                            <img src="{{ asset('uploads/fsc-certified-packaging.webp') }}"
                                alt="FSC Certified Packaging" loading="lazy"
                                onerror="this.src='https://placehold.co/613x295/b5a08a/fff?text=FSC+Image'">
                        </div>

                        <div class="sustainable-right__card">
                            <img src="{{ asset('uploads/circular-packaging.webp') }}" alt="Circular Packaging" loading="lazy"
                                onerror="this.src='https://placehold.co/613x295/8a9b7a/fff?text=Circular+Packaging+Image'">
                        </div>

                    </div><!-- /.sustainable-right -->

                </div><!-- /.sustainable-grid -->

            </div><!-- /.sustainable-inner -->
        </section>

        @include('components.testimonal')
        @include('components.customquote')
        @include('components.content')
        @include('components.blogs')
        @include('components.faq')
    </main>

    @include('components.footer')

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobileSidebar').classList.toggle('active');
            document.getElementById('mobileOverlay').classList.toggle('active');
            document.body.style.overflow = document.getElementById('mobileSidebar').classList.contains('active') ?
                'hidden' : '';
        }

        /* ── Customize Every Detail — option switch + drag scroll ── */
        (function() {
            var cdoData = {
                foiling: [{
                        src: '{{ asset('uploads/addon-gold-foil.webp') }}',
                        label: 'Gold Foil'
                    },
                    {
                        src: '{{ asset('uploads/silver-Foiling.webp') }}',
                        label: 'Silver Foil'
                    },
                    {
                        src: '{{ asset('uploads/addon-Holographic.webp') }}',
                        label: 'Holographic Foil'
                    }
                ],
                embossing: [{
                        src: '{{ asset('uploads/embossing.webp') }}',
                        label: 'Embossing'
                    },
                    {
                        src: '{{ asset('uploads/debossing.webp') }}',
                        label: 'Debossing'
                    },
                    {
                        src: '{{ asset('uploads/blind-emboss.webp') }}',
                        label: 'Blind Emboss'
                    }
                ],
                laminations: [{
                        src: '{{ asset('uploads/gloss-lamination.webp') }}',
                        label: 'Gloss Lamination'
                    },
                    {
                        src: '{{ asset('uploads/matte-lamination.webp') }}',
                        label: 'Matte Lamination'
                    },
                    {
                        src: '{{ asset('uploads/soft-touch-lamination.webp') }}',
                        label: 'Soft-Touch Lamination'
                    }
                ],
                magnetic: [{
                        src: '{{ asset('uploads/magnetic-closure.webp') }}',
                        label: 'Magnetic Closure'
                    },
                    {
                        src: '{{ asset('uploads/luxury-magnetic.webp') }}',
                        label: 'Luxury Magnetic Box'
                    },
                    {
                        src: '{{ asset('uploads/presentation-magnetic.webp') }}',
                        label: 'Presentation Closure'
                    }
                ],
                inserts: [{
                        src: '{{ asset('uploads/foam-Insert.webp') }}',
                        label: 'Foam Insert'
                    },
                    {
                        src: '{{ asset('uploads/paper-insert.webp') }}',
                        label: 'Paper Insert'
                    },
                    {
                        src: '{{ asset('uploads/corrugated-insert.webp') }}',
                        label: 'Corrugated Insert'
                    }
                ],
                coating: [{
                        src: '{{ asset('uploads/uv-coating.webp') }}',
                        label: 'UV Coating'
                    },
                    {
                        src: '{{ asset('uploads/aqueous-coating.webp') }}',
                        label: 'Aqueous Coating'
                    },
                    {
                        src: '{{ asset('uploads/protective-varnish.webp') }}',
                        label: 'Protective Varnish'
                    }
                ]
            };

            // Preload all customization images in the background so tabs switch instantly
            window.addEventListener('load', function() {
                setTimeout(function() {
                    for (var key in cdoData) {
                        if (cdoData.hasOwnProperty(key)) {
                            cdoData[key].forEach(function(item) {
                                var img = new Image();
                                img.src = item.src;
                            });
                        }
                    }
                }, 500); // Start preloading half a second after page load
            });

            var bar = document.getElementById('cdoBar');

            window.switchCustomizeDetail = function(btn) {
                if (!btn || !bar) return;
                bar.querySelectorAll('.cdo-btn').forEach(function(b) {
                    b.classList.remove('active');
                });
                btn.classList.add('active');

                /* Smooth scroll selected option into the center of the scrollbar */
                try {
                    btn.scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center',
                        block: 'nearest'
                    });
                } catch (err) {
                    // Fallback for older browsers
                    btn.scrollIntoView(false);
                }

                var data = cdoData[btn.dataset.cdo] || cdoData.foiling;
                data.forEach(function(item, i) {
                    var img = document.getElementById('cdo-img-' + (i + 1));
                    var lbl = document.getElementById('cdo-label-' + (i + 1));
                    if (img) {
                        img.src = item.src;
                        img.alt = item.label;
                    }
                    if (lbl) {
                        lbl.textContent = item.label;
                    }
                });
            };

            /* drag-to-scroll on options bar */
            var isDown = false,
                startX, scrollLeft;
            bar.addEventListener('pointerdown', function(e) {
                if (e.target.closest('.cdo-btn')) return;
                isDown = true;
                bar.classList.add('grabbing');
                startX = e.pageX - bar.offsetLeft;
                scrollLeft = bar.scrollLeft;
                bar.setPointerCapture(e.pointerId);
            });

            /* Buttons must remain normal clickable controls even though the
               surrounding pill supports drag-to-scroll. */
            bar.querySelectorAll('.cdo-btn').forEach(function(btn) {
                btn.addEventListener('pointerdown', function(e) {
                    e.stopPropagation();
                });
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.switchCustomizeDetail(btn);
                });
            });
            bar.addEventListener('pointermove', function(e) {
                if (!isDown) return;
                var x = e.pageX - bar.offsetLeft;
                bar.scrollLeft = scrollLeft - (x - startX);
            });
            ['pointerup', 'pointercancel'].forEach(function(ev) {
                bar.addEventListener(ev, function() {
                    isDown = false;
                    bar.classList.remove('grabbing');
                });
            });
        }());
    </script>

    <script>
        (function() {
            var cardsContainer = document.querySelector('.bestseller-cards');
            var dotsContainer = document.getElementById('bestsellerDots');
            if (!cardsContainer || !dotsContainer) return;

            var cards = cardsContainer.querySelectorAll('.bestseller-card');
            if (cards.length === 0) return;

            var currentIndex = 0;
            var autoPlayInterval;
            var dots = [];

            function renderDots() {
                var isMobile = window.innerWidth <= 768;
                var scrollMultiplier = isMobile ? 1 : 3;
                var numDots = Math.ceil(cards.length / scrollMultiplier);

                // Don't show dots if only 1 page
                if (numDots <= 1) {
                    dotsContainer.innerHTML = '';
                    dots = [];
                    return;
                }

                dotsContainer.innerHTML = '';
                dots = [];
                for (var i = 0; i < numDots; i++) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = (i === currentIndex) ? 'bestseller-dot active' : 'bestseller-dot';
                    btn.setAttribute('role', 'tab');
                    btn.setAttribute('aria-selected', (i === currentIndex) ? 'true' : 'false');
                    btn.setAttribute('aria-label', 'Best seller tab ' + (i + 1));
                    dotsContainer.appendChild(btn);
                    dots.push(btn);

                    (function(index) {
                        btn.addEventListener('click', function() {
                            currentIndex = index;
                            goToDot(index);
                            resetAutoPlay();
                        });
                    })(i);
                }
            }

            function goToDot(index) {
                if (dots.length === 0) return;
                dots.forEach(function(item) {
                    item.classList.remove('active');
                    item.setAttribute('aria-selected', 'false');
                });
                if (dots[index]) {
                    dots[index].classList.add('active');
                    dots[index].setAttribute('aria-selected', 'true');
                }

                var firstCard = cards[0];
                var cardWidth = firstCard ? firstCard.offsetWidth : 275;
                var isMobile = window.innerWidth <= 768;
                var scrollMultiplier = isMobile ? 1 : 3;
                cardsContainer.scrollTo({
                    left: index * (cardWidth + 20) * scrollMultiplier,
                    behavior: 'smooth'
                });
            }

            function nextSlide() {
                if (dots.length <= 1) return;
                currentIndex++;
                if (currentIndex >= dots.length) {
                    currentIndex = 0;
                }
                goToDot(currentIndex);
            }

            function resetAutoPlay() {
                clearInterval(autoPlayInterval);
                if (dots.length > 1) {
                    autoPlayInterval = setInterval(nextSlide, 3500); // Auto-play every 3.5 seconds
                }
            }

            // Initial render
            renderDots();
            resetAutoPlay();

            // Re-render on resize
            window.addEventListener('resize', function() {
                var oldDotsCount = dots.length;
                renderDots();
                if (dots.length !== oldDotsCount) {
                    currentIndex = 0;
                    goToDot(0);
                    resetAutoPlay();
                }
            });
        })();
    </script>

</body>

</html>
