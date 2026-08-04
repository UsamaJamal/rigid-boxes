<style>
    /* ─────────────────────────────────────────
       BLOGS / INSIGHTS SECTION
    ───────────────────────────────────────── */
    .blogs-section {
        background: var(--background-color, #FAF8F8);
        padding: 35px 0;
        font-family: 'DM Sans', sans-serif;
    }

    .blogs-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 100px;
    }

    .blogs-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
    }

    .blogs-header-text {
        max-width: 800px;
    }

    .blogs-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: var(--section-text-color, #111);
        margin-bottom: 12px;
    }

    .blogs-subtitle {
        font-size: 16px;
        color: #444;
        line-height: 1.5;
    }

    .view-all-blogs-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-color, #8D4445);
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 28px;
        border-radius: 4px;
        text-decoration: none;
        transition: background 0.3s;
        border: none;
        white-space: nowrap;
    }

    .view-all-blogs-btn:hover {
        background: #5F2D2F;
        color: #fff;
    }

    .mobile-btn-wrap {
        display: none;
    }

    .blog-dots {
        display: none;
    }

    .blogs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .blog-card {
        background: #fff;
        border: 1px solid #EAEAEA;
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s, transform 0.3s;
        position: relative;
        -webkit-tap-highlight-color: transparent;
    }

    .blog-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        transform: translateY(-4px);
    }

    .blog-card__image {
        width: 100%;
        height: 240px;
        object-fit: cover;
        border-bottom: 1px solid #EAEAEA;
    }

    .blog-card__content {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .blog-card__meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: #666;
        margin-bottom: 14px;
    }

    .blog-card__title {
        font-family: 'Open Sans', sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: #111;
        line-height: 1.3;
        margin-bottom: 12px;
        text-decoration: none;
        transition: color 0.3s;
    }

    .blog-card__title::after {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 1;
        -webkit-tap-highlight-color: transparent;
    }

    .blog-card a {
        -webkit-tap-highlight-color: transparent;
    }

    .blog-card:hover .blog-card__title {
        color: var(--primary-color, #8D4445);
    }

    .blog-card__desc {
        font-size: 14px;
        color: var(--section-text-color);
        line-height: 1.6;
        margin-bottom: 24px;
        flex: 1;
    }

    .blog-card__author {
        color: var(--section-text-color);
        font-weight: 500;
    }

    .blog-card__date {
        color: var(--section-text-color);
    }

    .blog-card__readmore {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 15px;
        font-weight: 700;
        color: var(--primary-color, #8D4445);
        text-decoration: none;
        transition: color 0.3s;
        position: relative;
        z-index: 2;
    }

    .blog-card:hover .blog-card__readmore {
        color: #5F2D2F;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .blogs-container {
            padding: 0 5%;
        }
    }

    @media (max-width: 992px) {
        .blogs-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .blogs-section {
            padding: 30px 0;
        }

        .blogs-container {
            padding: 0 16px;
        }

        .blogs-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 24px;
            gap: 10px;
        }

        .blogs-header-text {
            text-align: center;
        }

        .blogs-title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 8px;
        }

        .blogs-subtitle {
            font-size: 14px;
            text-align: center;
            line-height: 1.45;
        }

        .desktop-btn {
            display: none !important;
        }

        .blogs-grid {
            display: flex !important;
            overflow-x: auto !important;
            scroll-snap-type: x mandatory !important;
            gap: 16px !important;
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
            scroll-behavior: smooth;
        }

        .blogs-grid::-webkit-scrollbar {
            display: none !important;
        }

        .blog-card {
            flex: 0 0 100% !important;
            min-width: 100% !important;
            scroll-snap-align: center !important;
            border-radius: 16px !important;
        }

        .blog-card:hover {
            box-shadow: none !important;
        }

        .blog-card__image {
            height: 210px;
        }

        .blog-card__content {
            padding: 18px 16px 20px;
        }

        .blog-card__title {
            font-size: 18px;
        }

        .blog-card__desc {
            font-size: 13.5px;
            margin-bottom: 18px;
        }

        .blog-dots {
            display: flex !important;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
        }

        .blog-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 1.5px solid #8D4445;
            background: transparent;
            cursor: pointer;
            transition: background 0.3s, border-color 0.3s;
        }

        .blog-dot.active {
            background: #8D4445;
        }

        .mobile-btn-wrap {
            display: flex !important;
            justify-content: center;
            margin-top: 24px;
        }

        .mobile-btn {
            width: 200px;
            height: 46px;
            font-size: 15px;
            border-radius: 4px;
        }
    }
</style>

<section class="blogs-section">
    <div class="blogs-container">

        <div class="blogs-header">
            <div class="blogs-header-text">
                <span class="blogs-title" style="display: block;">Packaging Insights &amp; Industry Trends</span>
                <p class="blogs-subtitle">Stay updated with packaging trends, design ideas, and expert tips to make smarter packaging decisions.</p>
            </div>
            <a href="/blog/" class="view-all-blogs-btn desktop-btn">View All Blogs</a>
        </div>

        <div class="blogs-grid" id="blogsGrid">

            <!-- Card 1 -->
            <article class="blog-card">
                <img src="{{ asset('uploads/industry-custom-luxury-box.jfif') }}" alt="Sustainable Packaging Trends" class="blog-card__image" onerror="this.src='https://placehold.co/400x240/dddddd/555555?text=Blog+Image'">
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="blog-card__author">Joe Danley</span>
                        <span class="blog-card__date">Nov 15, 2024</span>
                    </div>
                    <a href="{{ url('/blog-detail') }}" class="blog-card__title">Sustainable Packaging Trends For 2026</a>
                    <p class="blog-card__desc">Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable</p>
                    <div>
                        <a href="{{ url('/blog-detail') }}" class="blog-card__readmore">
                            Read More
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="blog-card">
                <img src="{{ asset('uploads/industry-magnetic-closure-boxes.webp') }}" alt="Sustainable Packaging Trends" class="blog-card__image" onerror="this.src='https://placehold.co/400x240/dddddd/555555?text=Blog+Image'">
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="blog-card__author">Joe Danley</span>
                        <span class="blog-card__date">Nov 15, 2024</span>
                    </div>
                    <a href="{{ url('/blog-detail') }}" class="blog-card__title">Sustainable Packaging Trends For 2026</a>
                    <p class="blog-card__desc">Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable</p>
                    <div>
                        <a href="{{ url('/blog-detail') }}" class="blog-card__readmore">
                            Read More
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="blog-card">
                <img src="{{ asset('uploads/industry-rigid-presentation-box.jfif') }}" alt="Sustainable Packaging Trends" class="blog-card__image" onerror="this.src='https://placehold.co/400x240/dddddd/555555?text=Blog+Image'">
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="blog-card__author">Joe Danley</span>
                        <span class="blog-card__date">Nov 15, 2024</span>
                    </div>
                    <a href="{{ url('/blog-detail') }}" class="blog-card__title">Sustainable Packaging Trends For 2026</a>
                    <p class="blog-card__desc">Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable</p>
                    <div>
                        <a href="{{ url('/blog-detail') }}" class="blog-card__readmore">
                            Read More
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

        </div>

        <!-- Mobile Pagination Dots -->
        <div class="blog-dots" id="blogDots">
            <span class="blog-dot active" data-index="0"></span>
            <span class="blog-dot" data-index="1"></span>
            <span class="blog-dot" data-index="2"></span>
        </div>

        <!-- Mobile View All Blogs Button -->
        <div class="mobile-btn-wrap">
            <a href="/blog/" class="view-all-blogs-btn mobile-btn">View All Blogs</a>
        </div>

    </div>
</section>

<script>
    (function () {
        var grid = document.getElementById('blogsGrid');
        var dots = document.querySelectorAll('#blogDots .blog-dot');
        if (!grid || !dots.length) return;

        grid.addEventListener('scroll', function () {
            var cardWidth = grid.offsetWidth;
            if (!cardWidth) return;
            var index = Math.round(grid.scrollLeft / cardWidth);
            dots.forEach(function (dot, i) {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        });

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                var cardWidth = grid.offsetWidth;
                grid.scrollTo({ left: i * cardWidth, behavior: 'smooth' });
            });
        });
    })();
</script>
