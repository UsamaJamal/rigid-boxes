<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Printed Boxes - The Rigid Boxes</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--background-color, #FAF8F8);
            color: #000000;
        }

        /* ─────────────────────────────────────────
           SECTION: CUSTOM BOXES FOR EVERY INDUSTRY
        ───────────────────────────────────────── */
        .custom-boxes-section {
            background: #FFFFFF;
            padding: 60px 0 70px;
        }

        .custom-boxes-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 100px;
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
            margin-bottom: 14px;
        }

        .custom-boxes-container .section-desc {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
            letter-spacing: 0%;
            text-align: center;
            color: var(--section-text-color);
            max-width: 600px;
            margin: 0 auto 48px;
        }

        /* ─────────────────────────────────────────
           CARDS GRID
        ───────────────────────────────────────── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 292px);
            gap: 24px;
            justify-content: center;
        }

        /* ─────────────────────────────────────────
           CARD  (exact Figma spec)
        ───────────────────────────────────────── */
        .industry-card {
            width: 292px;
            background: #FFFEFA;
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
            font-size: 20px;
            line-height: 100%;
            letter-spacing: 0%;
            text-transform: capitalize;
            text-align: left;
            color: var(--section-text-color);
            padding: 22px 17px 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-shrink: 0;
        }

        /* Image area — Figma: left:8px w:275 h:266 */
        .industry-card__image-wrap {
            width: 275px;
            height: 266px;
            margin: 0 auto;
            border-bottom: 0.2px solid #e0e0e0;
            overflow: hidden;
            flex-shrink: 0;
        }

        .industry-card__image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .industry-card:hover .industry-card__image-wrap img {
            transform: scale(1.05);
        }

        /* Bottom content area — grows to push button to same level across all cards */
        .industry-card__bottom {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 14px 17px 20px;
        }

        /* Text area — Figma: w:247 h:42 */
        .industry-card__text {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            flex: 1; /* pushes button down */
        }

        /* Button — Figma: left:46px w:200 h:46
           border-radius:4px, border:1px, padding:12px 20px */
        .industry-card__btn {
            display: block;
            width: 200px;
            height: 46px;
            margin-top: 14px;
            margin-left: 29px; /* (292 - 17padding - 200btn - 46offset) = centres within bottom area at Figma left:46 */
            background: #8D4445;
            color: #fff;
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
            transition: background 0.25s, color 0.25s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .industry-card__btn:hover {
            background: #5F2D2F;
            border-color: #5F2D2F;
            color: #fff;
        }

        /* ─────────────────────────────────────────
           VIEW ALL CATEGORIES BUTTON
           Figma: w:200 h:46, border-radius:4px,
                  padding:12/20/12/20, centered
        ───────────────────────────────────────── */
        .view-all-wrap {
            margin-top: 48px;
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
            padding: 60px 0 70px;
        }

        .why-choose-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 100px;
            text-align: center;
        }

        .why-choose-container h2 {
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

        /*
          BENTO GRID — Figma pixel values:
          4 equal cols: 299px each, gap:14px → 4×299 + 3×14 = 1238 ≈ 1240
          Row 1 h:413px — pink1(col1) | pink2(col2) | blue(col3-4, w:612)
          Row 2 h:242px — yellow(col1-2, w:612) | green(col3) | skin(col4)
        */
        .why-grid {
            /* display: grid;
            grid-template-columns: 299px 299px 299px 299px;
            grid-template-rows: 413px 242px;
            gap: 14px; */
    /* display:grid;
    grid-template-columns:repeat(4,299px);
    grid-template-rows:242px 157px 242px;
    gap:14px;
            text-align: left; */
}

        /* ── Base card ── */
        .why-card {
            border-radius: 16px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0px 0px 6px 2px #0000001A;
        }

        .why-card__title {
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            font-size: 16px;
            line-height: 1.3;
            color: var(--section-text-color);
            margin-bottom: 8px;
        }

        .why-card__text {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 13px;
            line-height: 1.6;
            color: var(--section-text-color);
            text-align: left;
        }

        /*
          IMAGE BOX — Figma: w:172 h:208 bg:#EAF2FF padding:40px
          Vertical cards: centered horizontally, pushed to bottom
          Horizontal cards: right side, full height of card inner
        */
        .why-card__img-box {
            width: 172px;
            height: 208px;
            background: #EAF2FF;
            border-radius: 10px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .why-card__img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        /* ── VERTICAL cards: title+text top, image centered bottom ── */
        .why-card--v {
            align-items: center;
        }
        .why-card--v .why-card__img-box {
            align-self: center;
            margin-top: auto;
        }

        /* ── HORIZONTAL cards: text left flex:1, image right fixed width ── */
        .why-card--h {
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }
        .why-card--h .why-card__content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-self: center;
        }
        .why-card--h .why-card__img-box {
            /* Figma horizontal: w:172 h:208 top:17 left:380 */
            width: 172px;
            height: 208px;
            flex-shrink: 0;
            align-self: center;
        }

        /* ── Card 1: pink-1  col:1 row:1 ── */
        .wc-pink1 { background: #F9D5E366; grid-column: 1; grid-row: 1; }

        /* ── Card 2: pink-2  col:2 row:1 ── */
        .wc-pink2 { background: #FFC7C766; grid-column: 2; grid-row: 1; }


        /* ── Card 3: blue  col:3-4 row:1  w:612 h:413
               illustration top-right (absolute), text top-left
        ── */
        .wc-blue {
            background: #CBE3FD66;
            grid-column: 3 / 5;
            grid-row: 1;
            position: relative;
            gap: 20px;
        }
        .wc-blue .why-card__illus {
            position: absolute;
            top: 17px;
            left: 387px;
            width: 170px;
            height: 210px;
            object-fit: contain;
            border: 1px solid #000000;
        }
        .wc-blue .why-card__content {
            max-width: 52%;
        }

        /* ── Card 4: yellow  col:1-2 row:2  w:612 h:242  horizontal ── */
        .wc-yellow {
            background: #FBEAA966;
            grid-column: 1 / 3;
            grid-row: 2;
            flex-direction: row;
            align-items: center;
            gap: 20px;
        }
        .wc-yellow .why-card__content {
            flex: 1;
            align-self: center;
        }
        .wc-yellow .why-card__img-box {
            width: 172px;
            height: 208px;
            flex-shrink: 0;
            align-self: center;
        }

        /* ── Card 5: green  col:3 row:2  w:299 h:242 ── */
        .wc-green {
            background: #D8FFE666;
            grid-column: 3;
            grid-row: 2;
            width:299px;
            height:413px;
            align-items: center;
        }
        .wc-green .why-card__img-box {
            /* width: 100%;
            height: 128px;
            margin-top: auto;
            padding: 12px; */
            width: 172px;
            height: 208px;
            top: 175px;
            left: 64px;
            gap: 10px;
            padding: 40px;

        }

        /* ── Card 6: skin  col:4 row:2  w:299 h:242 ── */
        .wc-skin {
            background: #FFE8CF66;
            grid-column: 4;
            grid-row: 2;
            /* width:299px;
            height:413px; */
            align-items: center;
        }
        .wc-skin .why-card__img-box {
            width: 172px;
            height: 208px;
            margin-top: auto;
            padding: 40px;
        }

        /* ─────────────────────────────────────────
           RESPONSIVE — Why Choose Us
        ───────────────────────────────────────── */
        @media (max-width: 1280px) {
            .why-choose-container { padding: 0 40px; }
            .why-grid { grid-template-columns: 1fr 1fr 1fr 1fr; }
        }

        @media (max-width: 992px) {
            .why-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
                gap: 14px;
            }
            .wc-pink1  { grid-column: 1; grid-row: auto; min-height: 320px; }
            .wc-pink2  { grid-column: 2; grid-row: auto; min-height: 320px; }
            .wc-blue   { grid-column: 1 / 3; grid-row: auto; min-height: 220px; }
            .wc-blue .why-card__content { max-width: 60%; }
            .wc-yellow { grid-column: 1 / 3; grid-row: auto; min-height: 180px; }
            .wc-green  { grid-column: 1; grid-row: auto; min-height: 200px; }
            .wc-skin   { grid-column: 2; grid-row: auto; min-height: 200px; }
        }

        @media (max-width: 576px) {
            .why-choose-section   { padding: 40px 0 50px; }
            .why-choose-container { padding: 0 20px; }
            .why-choose-container h2 { font-size: 24px; }

            .why-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: auto;
                gap: 12px;
            }

            .wc-blue {
                grid-column: 1 / 3;
                flex-direction: column;
                min-height: auto;
            }
            .wc-blue .why-card__illus {
                position: static;
                width: 90px;
                height: 110px;
                margin-top: 12px;
                align-self: flex-end;
            }
            .wc-blue .why-card__content { max-width: 100%; }

            .wc-yellow {
                grid-column: 1 / 3;
                flex-direction: column;
                min-height: auto;
            }
            .wc-yellow .why-card__img-box {
                width: 100%;
                height: 130px;
                align-self: auto;
            }

            .wc-pink1, .wc-pink2 { min-height: 260px; }
            .wc-green, .wc-skin  { min-height: 180px; }
            .wc-green .why-card__img-box,
            .wc-skin  .why-card__img-box { height: 90px; }
        }

        /* ─────────────────────────────────────────
           RESPONSIVE
        ───────────────────────────────────────── */

        /* Tablet: 2 columns */
        @media (max-width: 1280px) {
            .custom-boxes-container {
                padding: 0 40px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 292px);
            }
        }

        /* Tablet portrait */
        @media (max-width: 768px) {
            .custom-boxes-section {
                padding: 40px 0 50px;
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
            }

            .industry-card__image-wrap {
                width: calc(100% - 16px);
                height: 200px;
            }

            .industry-card__btn {
                width: 160px;
                margin-left: 16px;
            }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .custom-boxes-container h2 {
                font-size: 24px;
            }

            .custom-boxes-container .section-desc {
                font-size: 14px;
                margin-bottom: 32px;
            }

            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .industry-card__title {
                font-size: 13px;
                padding: 12px 10px 8px;
            }

            .industry-card__image-wrap {
                width: calc(100% - 10px);
                height: 130px;
            }

            .industry-card__bottom {
                padding: 10px 10px 14px;
            }

            .industry-card__text {
                font-size: 11px;
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
    </style>
</head>

<body>

    @include('components.header')

    <main class="home-page">

        <!-- Custom Printed Boxes for Every Industry Section -->
        <section class="custom-boxes-section">
            <div class="custom-boxes-container">

                <h2>Custom Printed Boxes For Every Industry</h2>
                <p class="section-desc">Custom packaging designed for different industries. Whether it's retail, beauty, or electronics, we create packaging that fits your industry's style and requirements.</p>

                <div class="cards-grid">

                    <!-- Card 1: Rigid Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Rigid Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/custom-luxury-box.jfif') }}" alt="Rigid Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Rigid+Boxes'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 2: Magnetic Closure Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Magnetic Closure Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/Maganetic-Closure-Boxes.webp') }}" alt="Magnetic Closure Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Magnetic+Closure'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 3: Photo Presentation Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Photo Presentation Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/rigid-presentation-box.jfif') }}" alt="Photo Presentation Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Photo+Presentation'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 4: Book Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Book Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/rigid-plain-white-box.jfif') }}" alt="Book Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Book+Boxes'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 5: Magnetic Book Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Magnetic Book Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/custom-shoulder-box.jfif') }}" alt="Magnetic Book Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Magnetic+Book'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 6: Drawer Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Drawer Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/two-piece-box.jfif') }}" alt="Drawer Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Drawer+Boxes'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 7: Gift Boxes -->
                    <div class="industry-card">
                        <span class="industry-card__title">Gift Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/Gift-Boxes.webp') }}" alt="Gift Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Gift+Boxes'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                    <!-- Card 8: Rigid Boxes (alt) -->
                    <div class="industry-card">
                        <span class="industry-card__title">Rigid Boxes</span>
                        <div class="industry-card__image-wrap">
                            <img src="{{ asset('uploads/box-with-lid.jfif') }}" alt="Rigid Boxes" onerror="this.src='https://placehold.co/275x266/dddddd/555555?text=Rigid+Boxes'">
                        </div>
                        <div class="industry-card__bottom">
                            <p class="industry-card__text">Premium packaging with a luxury feel and durable structure.</p>
                            <a href="#" class="industry-card__btn">Explore Boxes</a>
                        </div>
                    </div>

                </div><!-- /.cards-grid -->

                <!-- View All Categories Button -->
                <div class="view-all-wrap">
                    <a href="#" class="view-all-btn">View All Categories</a>
                </div>

            </div><!-- /.custom-boxes-container -->
        </section>

        <!-- ═══════════════════════════════════════
             WHY CHOOSE US SECTION
        ═══════════════════════════════════════ -->
        <section class="why-choose-section">
            <div class="why-choose-container">

                <h2>Why Choose Us</h2>
                <p class="why-desc">From premium materials to expert support, we provide everything you need for exceptional custom packaging.</p>

                <div class="why-grid">

                    <!-- CARD 1 — pink-1: Free Design Support | col:1 row:1 | w:299 h:413 -->
                    <div class="why-card wc-pink1">
                        <h3 class="why-card__title">Free Design Support</h3>
                        <p class="why-card__text">Get expert assistance with artwork, layouts, and packaging design at no extra cost.</p>
                        <div class="why-card__img-box">
                            <img src="{{ asset('uploads/custom-luxury-box.jfif') }}" alt="Free Design Support">
                        </div>
                    </div>

                    <!-- CARD 2 — pink-2: Premium Quality Materials | col:2 row:1 | w:299 h:413 -->
                    <div class="why-card wc-pink2">
                        <h3 class="why-card__title">Premium Quality Materials</h3>
                        <p class="why-card__text">Built with high-strength materials that ensure durability, protection, and a premium feel.</p>
                        <div class="why-card__img-box">
                            <img src="{{ asset('uploads/CardBoard-Boxes.webp') }}" alt="Premium Quality Materials">
                        </div>
                    </div>

                    <!-- CARD 3 — light blue: Low MOQ | col:3-4 row:1 | w:612 h:413
                         illustration top-right (absolute), text top-left -->
                    <div class="why-card wc-blue">
                        <img src="{{ asset('uploads/Box-by-industry-Banner-.webp') }}" alt="" class="why-card__illus" onerror="this.style.display='none'">
                        <div class="why-card__content">
                            <h3 class="why-card__title">Low MOQ</h3>
                            <p class="why-card__text">Flexible minimum order quantities to help startups and growing brands order with confidence.</p>
                        </div>
                    </div>

                    <!-- CARD 4 — yellow: Dedicated Customer Service | horizontal | col:1-2 row:2 | w:612 h:242 -->
                    <div class="why-card wc-yellow">
                        <div class="why-card__content">
                            <h3 class="why-card__title">Dedicated Customer Service</h3>
                            <p class="why-card__text">Our packaging specialists are here to guide you through every step of the process.</p>
                        </div>
                        <div class="why-card__img-box">
                            <img src="{{ asset('uploads/profile-image.jfif') }}" alt="Dedicated Customer Service">
                        </div>
                    </div>

                    <!-- CARD 5 — green: Custom Sizes & Designs | col:3 row:2 | w:299 h:242 -->
                    <div class="why-card wc-green">
                        <h3 class="why-card__title">Custom Sizes &amp; Designs</h3>
                        <p class="why-card__text">Tailored packaging solutions crafted to match your product dimensions and brand identity.</p>
                        <div class="why-card__img-box">
                            <img src="{{ asset('uploads/custom-shaped-box.jfif') }}" alt="Custom Sizes">
                        </div>
                    </div>

                    <!-- CARD 6 — skin: Fast Production Time | col:4 row:2 | w:299 h:242 -->
                    <div class="why-card wc-skin">
                        <h3 class="why-card__title">Fast Production Time</h3>
                        <p class="why-card__text">Efficient manufacturing processes to deliver your packaging on time, every time.</p>
                        <div class="why-card__img-box">
                            <img src="{{ asset('uploads/Maganetic-Closure-Boxes.webp') }}" alt="Fast Production">
                        </div>
                    </div>

                </div><!-- /.why-grid -->

            </div><!-- /.why-choose-container -->
        </section>

    </main>

    <script>
        function toggleMobileMenu() {
            document.getElementById('mobileSidebar').classList.toggle('active');
            document.getElementById('mobileOverlay').classList.toggle('active');
            document.body.style.overflow = document.getElementById('mobileSidebar').classList.contains('active') ? 'hidden' : '';
        }
    </script>

</body>
</html>
