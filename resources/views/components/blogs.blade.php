<style>
    /* ─────────────────────────────────────────
       BLOGS / INSIGHTS SECTION
    ───────────────────────────────────────── */
    .blogs-section {
        background: var(--background-color, #FAF8F8);
        padding: 20px 0;
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
        border: 1px solid var(--primary-color, #8D4445);
        white-space: nowrap;
        margin-bottom: 5px;
    }

    .view-all-blogs-btn:hover {
        background: var(--primary_color);
        border-color: var(--primary_color);
        color: #fff;
    }

    .blogs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .blog-card {
        background: #fff;
        border: 1px solid #EAEAEA;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.3s, transform 0.3s;
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
    }

    .blog-card__title:hover {
        color: var(--primary-color);
    }

    .blog-card__desc {
        font-size: 14px;
        color: var(--section-text-color);
        line-height: 1.6;
        margin-bottom: 24px;
        flex: 1;
    }
.blog-card__author{
    color: var(--section-text-color);
}
.blog-card__date{
    color:var(--section-text-color);
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
    }

    .blog-card__readmore:hover {
        color: var(--primary_color);
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

    @media (max-width: 768px) {
        .blogs-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }
        .view-all-blogs-btn {
            margin-bottom: 0;
        }
    }

    @media (max-width: 576px) {
        .blogs-grid {
            grid-template-columns: 1fr;
        }
        .blogs-title {
            font-size: 26px;
        }
        .blog-card__image {
            height: 200px;
        }
    }
</style>

<section class="blogs-section">
    <div class="blogs-container">

        <div class="blogs-header">
            <div class="blogs-header-text">
                <h2 class="blogs-title">Packaging Insights & Industry Trends</h2>
                <p class="blogs-subtitle">Stay updated with packaging trends, design ideas, and expert tips to make smarter packaging decisions.</p>
            </div>
            <a href="#" class="view-all-blogs-btn">View All Blogs</a>
        </div>

        <div class="blogs-grid">

            <!-- Card 1 -->
            <article class="blog-card">
                <img src="{{ asset('uploads/custom-luxury-box.jfif') }}" alt="Sustainable Packaging Trends" class="blog-card__image" onerror="this.src='https://placehold.co/400x240/dddddd/555555?text=Blog+Image'">
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="blog-card__author">Joe Danley</span>
                        <span class="blog-card__date">Nov 15, 2024</span>
                    </div>
                    <a href="#" class="blog-card__title">Sustainable Packaging Trends For 2026</a>
                    <p class="blog-card__desc">Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable</p>
                    <div>
                        <a href="#" class="blog-card__readmore">
                            Read More
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="blog-card">
                <img src="{{ asset('uploads/Maganetic-Closure-Boxes.webp') }}" alt="Sustainable Packaging Trends" class="blog-card__image" onerror="this.src='https://placehold.co/400x240/dddddd/555555?text=Blog+Image'">
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="blog-card__author">Joe Danley</span>
                        <span class="blog-card__date">Nov 15, 2024</span>
                    </div>
                    <a href="#" class="blog-card__title">Sustainable Packaging Trends For 2026</a>
                    <p class="blog-card__desc">Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable</p>
                    <div>
                        <a href="#" class="blog-card__readmore">
                            Read More
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="blog-card">
                <img src="{{ asset('uploads/custom-luxury-box.jfif') }}" alt="Sustainable Packaging Trends" class="blog-card__image" onerror="this.src='https://placehold.co/400x240/dddddd/555555?text=Blog+Image'">
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span class="blog-card__author">Joe Danley</span>
                        <span class="blog-card__date">Nov 15, 2024</span>
                    </div>
                    <a href="#" class="blog-card__title">Sustainable Packaging Trends For 2026</a>
                    <p class="blog-card__desc">Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable</p>
                    <div>
                        <a href="#" class="blog-card__readmore">
                            Read More
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </article>

        </div>

    </div>
</section>
