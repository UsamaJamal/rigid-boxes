<style>
    .testimonial-section {
        background: var(--secondary-color, #FAF8F8);
        padding: 20px 0 30px;
        position: relative;
        font-family: 'DM Sans', sans-serif;
        overflow: hidden;
    }

    .testimonial-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        padding: 0 24px;
        box-sizing: border-box;
    }

    .testimonial-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .testimonial-title {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        line-height: 1.2;
        text-transform: capitalize;
        color: #111;
        margin-bottom: 12px;
    }

    .testimonial-subtitle {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 1.5;
        text-align: center;
        color: #333;
        max-width: 620px;
        margin: 0 auto;
    }

    /* Slider Wrapper & Controls */
    .testimonial-slider-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        width: 100%;
        margin-top: 20px;
    }

    .testimonial-slider {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 1220px;
        position: relative;
        overflow: hidden;
    }

    .testimonial-track {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 100%;
    }

    /* Desktop: 2 Cards Side-by-Side */
    .testimonial-card-wrap {
        flex: 0 0 50%;
        display: flex;
        justify-content: center;
        padding: 30px 18px 10px 25px;
        box-sizing: border-box;
    }

    .testimonial-card {
        width: 100%;
        max-width: 540px;
        min-height: 200px;
        background: #0B0B0B;
        border-radius: 16px;
        position: relative;
        display: flex;
        align-items: center;
        padding: 24px 20px 24px 165px;
        color: #FFF;
        box-sizing: border-box;
        box-shadow: none;
    }

    .testimonial-img {
        position: absolute;
        left: -20px;
        top: -20px;
        width: 145px;
        height: 215px;
        border-radius: 16px;
        object-fit: cover;
        box-shadow: none;
        z-index: 5;
    }

    .testimonial-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        width: 100%;
        text-align: left;
    }

    .testimonial-stars {
        color: #F5C518;
        font-size: 14px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .testimonial-stars span {
        color: #CCC;
        font-size: 12px;
        margin-left: 8px;
    }

    .testimonial-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        line-height: 1.45;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 12px;
    }

    .testimonial-author {
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 15px;
        color: #FFF;
        margin-bottom: 2px;
    }

    .testimonial-role {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        color: #AAA;
    }

    .testimonial-dots-icon {
        position: absolute;
        right: -14px;
        top: 40%;
        width: 32px;
        height: 32px;
        background: #FFF;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color, #8D4445);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        z-index: 4;
    }

    /* Desktop Navigation Arrow Buttons */
    .nav-btn {
        width: 48px;
        height: 48px;
        background: var(--primary-color, #8D4445);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFF;
        border: none;
        cursor: pointer;
        z-index: 10;
        transition: background 0.3s, transform 0.2s;
        flex-shrink: 0;
    }

    .nav-btn:hover {
        background: #5F2D2F;
        transform: scale(1.05);
    }

    /* Pagination Dots */
    .pagination-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 28px;
    }

    .page-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 1.5px solid #000;
        background: transparent;
        cursor: pointer;
        transition: background 0.3s, border-color 0.3s;
    }

    .page-dot.active {
        background: var(--primary-color, #8D4445);
        border-color: var(--primary-color, #8D4445);
    }

    /* Mobile Responsive View — 1 Card per Slide */
    @media (max-width: 768px) {
        .testimonial-section {
            padding: 30px 0 40px;
        }

        .testimonial-container {
            padding: 0 16px;
        }

        .testimonial-header {
            margin-bottom: 24px;
        }

        .testimonial-title {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .testimonial-subtitle {
            font-size: 13.5px;
            line-height: 1.45;
            max-width: 340px;
        }

        .nav-btn {
            display: none !important;
        }

        .testimonial-card-wrap {
            flex: 0 0 100%;
            padding: 30px 10px 10px 24px;
        }

        .testimonial-card {
            max-width: 100%;
            min-height: 175px;
            padding: 16px 12px 16px 135px;
            border-radius: 16px;
        }

        .testimonial-img {
            width: 135px;
            height: 195px;
            left: -20px;
            top: -20px;
            border-radius: 16px;
        }

        .testimonial-dots-icon {
            right: -12px;
            top: 38%;
            width: 26px;
            height: 26px;
        }

        .testimonial-dots-icon svg {
            width: 12px;
            height: 4px;
        }

        .testimonial-stars {
            font-size: 12px;
            margin-bottom: 6px;
            gap: 3px;
        }

        .testimonial-stars span {
            font-size: 10.5px;
            margin-left: 4px;
        }

        .testimonial-text {
            font-size: 12px;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .testimonial-author {
            font-size: 13.5px;
        }

        .testimonial-role {
            font-size: 10.5px;
        }

        .pagination-dots {
            margin-top: 20px;
            gap: 8px;
        }

        .page-dot {
            width: 11px;
            height: 11px;
        }
    }
</style>

<section class="testimonial-section">
    <div class="testimonial-container">
        <div class="testimonial-header">
            <h2 class="testimonial-title">What Our Clients Say</h2>
            <p class="testimonial-subtitle">Trusted by brands that value premium quality, reliable production, and luxury packaging that leaves a lasting impression.</p>
        </div>

        <div class="testimonial-slider-wrapper">
            <button class="nav-btn prev-btn" aria-label="Previous Testimonial">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
            </button>

            <div class="testimonial-slider">
                <div class="testimonial-track" id="testimonialTrack">

                    <!-- Slide 1 -->
                    <div class="testimonial-card-wrap">
                        <div class="testimonial-card">
                            <img src="{{ asset('uploads/elisa_grant.png') }}" alt="Elisa Grant" class="testimonial-img" onerror="this.src='https://placehold.co/160x230/333/fff?text=Elisa'">
                            <div class="testimonial-content">
                                <div class="testimonial-stars">
                                    ★ ★ ★ ★ ★ <span>5.0 rating</span>
                                </div>
                                <p class="testimonial-text">Excellent packaging quality and fast production. Our luxury product line now looks much more premium.</p>
                                <div class="testimonial-author">Elisa Grant</div>
                                <div class="testimonial-role">CEO, Urban Apparel</div>
                            </div>
                            <div class="testimonial-dots-icon">
                                <svg width="14" height="4" viewBox="0 0 16 4" fill="currentColor"><circle cx="2" cy="2" r="2"/><circle cx="8" cy="2" r="2"/><circle cx="14" cy="2" r="2"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="testimonial-card-wrap">
                        <div class="testimonial-card">
                            <img src="{{ asset('uploads/marcus_vance.png') }}" alt="Marcus Vance" class="testimonial-img" onerror="this.src='https://placehold.co/160x230/444/fff?text=Marcus'">
                            <div class="testimonial-content">
                                <div class="testimonial-stars">
                                    ★ ★ ★ ★ ★ <span>5.0 rating</span>
                                </div>
                                <p class="testimonial-text">The rigid box structural integrity and foil finishing exceeded our expectations. Highly recommended!</p>
                                <div class="testimonial-author">Marcus Vance</div>
                                <div class="testimonial-role">Founder, Vance Cosmetics</div>
                            </div>
                            <div class="testimonial-dots-icon">
                                <svg width="14" height="4" viewBox="0 0 16 4" fill="currentColor"><circle cx="2" cy="2" r="2"/><circle cx="8" cy="2" r="2"/><circle cx="14" cy="2" r="2"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="testimonial-card-wrap">
                        <div class="testimonial-card">
                            <img src="{{ asset('uploads/sophia_loren.png') }}" alt="Sophia Loren" class="testimonial-img" onerror="this.src='https://placehold.co/160x230/555/fff?text=Sophia'">
                            <div class="testimonial-content">
                                <div class="testimonial-stars">
                                    ★ ★ ★ ★ ★ <span>5.0 rating</span>
                                </div>
                                <p class="testimonial-text">Outstanding custom sample support. Their team guided us through every step of the unboxing design.</p>
                                <div class="testimonial-author">Sophia Loren</div>
                                <div class="testimonial-role">Design Lead, Aura Luxury</div>
                            </div>
                            <div class="testimonial-dots-icon">
                                <svg width="14" height="4" viewBox="0 0 16 4" fill="currentColor"><circle cx="2" cy="2" r="2"/><circle cx="8" cy="2" r="2"/><circle cx="14" cy="2" r="2"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="testimonial-card-wrap">
                        <div class="testimonial-card">
                            <img src="{{ asset('uploads/david_miller.png') }}" alt="David Miller" class="testimonial-img" onerror="this.src='https://placehold.co/160x230/666/fff?text=David'">
                            <div class="testimonial-content">
                                <div class="testimonial-stars">
                                    ★ ★ ★ ★ ★ <span>5.0 rating</span>
                                </div>
                                <p class="testimonial-text">Fast delivery and flawless printing. Our customers love the premium unboxing experience.</p>
                                <div class="testimonial-author">David Miller</div>
                                <div class="testimonial-role">Product Manager, Heritage</div>
                            </div>
                            <div class="testimonial-dots-icon">
                                <svg width="14" height="4" viewBox="0 0 16 4" fill="currentColor"><circle cx="2" cy="2" r="2"/><circle cx="8" cy="2" r="2"/><circle cx="14" cy="2" r="2"/></svg>
                            </div>
                        </div>
                    </div>

                </div><!-- end .testimonial-track -->
            </div><!-- end .testimonial-slider -->

            <button class="nav-btn next-btn" aria-label="Next Testimonial">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
            </button>
        </div><!-- end .testimonial-slider-wrapper -->

        <div class="pagination-dots" id="testimonialDots">
            <div class="page-dot active" data-index="0"></div>
            <div class="page-dot" data-index="1"></div>
            <div class="page-dot" data-index="2"></div>
        </div>
    </div>
</section>

<script>
    (function () {
        var track = document.getElementById('testimonialTrack');
        var dots = document.querySelectorAll('#testimonialDots .page-dot');
        var prevBtn = document.querySelector('.testimonial-section .prev-btn');
        var nextBtn = document.querySelector('.testimonial-section .next-btn');
        if (!track || !dots.length) return;

        var currentIndex = 0;
        var autoPlayInterval = null;

        function getVisibleCount() {
            return window.innerWidth <= 768 ? 1 : 2;
        }

        function getMaxIndex() {
            var visible = getVisibleCount();
            return visible === 2 ? 2 : 3; // 4 cards total -> 3 steps for desktop (0,1,2), 4 steps for mobile (0,1,2,3)
        }

        function goToSlide(index) {
            var maxIndex = getMaxIndex();
            if (index < 0) index = maxIndex;
            if (index > maxIndex) index = 0;
            currentIndex = index;

            var visible = getVisibleCount();
            var stepPercent = visible === 2 ? 50 : 100;
            track.style.transform = 'translateX(-' + (currentIndex * stepPercent) + '%)';

            dots.forEach(function (dot, i) {
                if (i === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function startAutoPlay() {
            stopAutoPlay();
            autoPlayInterval = setInterval(function () {
                goToSlide(currentIndex + 1);
            }, 4000);
        }

        function stopAutoPlay() {
            if (autoPlayInterval) {
                clearInterval(autoPlayInterval);
                autoPlayInterval = null;
            }
        }

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                goToSlide(i);
                startAutoPlay();
            });
        });

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                goToSlide(currentIndex - 1);
                startAutoPlay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                goToSlide(currentIndex + 1);
                startAutoPlay();
            });
        }

        window.addEventListener('resize', function() {
            goToSlide(0);
        });

        // Touch swipe support
        var startX = 0;
        var distX = 0;
        track.addEventListener('touchstart', function (e) {
            startX = e.touches[0].clientX;
            distX = 0;
            stopAutoPlay();
        }, { passive: true });

        track.addEventListener('touchmove', function (e) {
            distX = e.touches[0].clientX - startX;
        }, { passive: true });

        track.addEventListener('touchend', function () {
            if (Math.abs(distX) > 40) {
                if (distX > 0) {
                    goToSlide(currentIndex - 1);
                } else {
                    goToSlide(currentIndex + 1);
                }
            }
            startAutoPlay();
        });

        startAutoPlay();
    })();
</script>
