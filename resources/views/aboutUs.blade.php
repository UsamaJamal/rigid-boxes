@include('components.htmlboilerplate')
<style>
    .about-passion-section {
        display: flex;
        justify-content: center;
        padding: 30px 0;
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
    }

    .passion-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        gap: 60px;
        padding: 0 24px;
    }

    .passion-content {
        max-width: 546px;
    }

    .passion-heading {
        max-width: 512px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        line-height: 44px;
        color: var(--section-text-color);
        margin-bottom: 12px;
    }

    .passion-paragraph {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 26px;
        color: var(--section-text-color);
        text-align: justify;
    }

    .passion-images {
        position: relative;
        width: 560px;
        height: 560px;
        flex-shrink: 0;
    }

    .passion-img-main {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 16px;
    }

    .passion-img-overlap {
        position: absolute;
        bottom: -16px;
        left: -32px;
        width: 187.59px;
        height: 124px;
        padding: 12px;
        background-color: #f4f4f4;
        box-sizing: border-box;
    }

    @media (max-width: 1024px) {
        .passion-container {
            flex-direction: column-reverse;
            align-items: center;
        }
        .passion-images {
            width: 100%;
            max-width: 560px;
            height: auto;
            aspect-ratio: 1;
        }
        .passion-img-overlap {
            left: 0;
            bottom: 0;
        }
    }

    .mission-vision-section {
        display: flex;
        justify-content: center;
        padding: 0 0 30px 0;
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
    }

    .mission-vision-container {
        display: flex;
        gap: 24px;
        max-width: 1440px;
        width: 100%;
        width: 100%;
        justify-content: center;
        padding: 0 24px;
    }

    .mv-card {
        width: 100%;
        max-width: 594px;
        flex: 1 1 0;
        height: 270px;
        background: #FAF8F8;
        border: 1px solid var(--primary-color);
        border-radius: 16px;
        padding: 15px 48px 74px 48px;
        box-shadow: 0px 2px 4px 0px #0000002E;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    .mv-icon img {
        width: 40.09px;
        height: 40.14px;
    }

    .mv-icon.vision-icon img {
        width: 44px;
        height: 30px;
    }

    .mv-heading {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 24px;
        color: var(--section-text-color);
        margin-top: 24px;
        margin-bottom: 16px;
    }

    .mv-text {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 26px;
        color: #444748;
    }

    @media (max-width: 768px) {
        .mission-vision-container {
            flex-direction: column;
            align-items: center;
        }
        .mv-card {
            width: 100%;
            max-width: 364px;
            height: 260px;
            padding: 20px 24px;
        }
        .mv-heading {
            margin-top: 12px;
            margin-bottom: 8px;
            font-size: 18px;
        }
        .mv-text {
            text-align: justify;
            font-size: 14px;
            line-height: 22px;
        }
    }

    /* Section 1: Packaging Excellence */
    .packaging-excellence {
        background-color: var(--primary-color);
        color: #FFFFFF;
        padding: 30px 0;
        width: 100%;
        display: flex;
        justify-content: center;
        max-width: 1440px;
        margin: 0 auto;
    }
    .pe-container {
        max-width: 1440px;
        width: 100%;
        padding: 0 24px;
    }
    .pe-heading {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        margin-bottom: 24px;
        position: relative;
        color: #FFFFFF;
    }
    .pe-heading::after {
        content: '';
        display: block;
        width: 80px;
        height: 3px;
        background-color: #FFFFFF;
        margin-top: 24px;
    }
    .pe-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 60px;
    }
    .pe-column {
        padding-right: 24px;
        border-right: 1px solid rgba(255, 255, 255, 0.2);
    }
    .pe-column:last-child {
        border-right: none;
    }
    .pe-col-title {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 16px;
        color: #FFFFFF;
    }
    .pe-col-text {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 22px;
        opacity: 0.9;
        color: #FFFFFF;
    }

    @media (max-width: 1024px) {
        .pe-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .pe-column:nth-child(2) {
            border-right: none;
        }
    }
    @media (max-width: 600px) {
        .pe-heading {
            font-size: 24px;
        }
        .pe-heading::after {
            margin-top: 16px;
        }
        .pe-grid {
            grid-template-columns: 1fr;
            margin-top: 40px;
            gap: 32px;
        }
        .pe-column {
            border-right: none;
            border-bottom: none;
            padding-right: 0;
            padding-bottom: 0;
            border-left: 1px solid rgba(255, 255, 255, 0.3);
            padding-left: 20px;
        }
        .pe-column:last-child {
            border-bottom: none;
        }
    }

    /* Section 2: Trusted Brands */
    .trusted-brands-section {
        padding: 30px 0;
        width: 100%;
        display: flex;
        justify-content: center;
        background-color: #FFFFFF;
        text-align: center;
        max-width: 1440px;
        margin: 0 auto;
    }
    .tb-container {
        max-width: 1440px;
        width: 100%;
        padding: 0 24px;
    }
    .tb-heading {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #444748;
        margin-bottom: 40px;
    }

    .tb-logos {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 60px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }
    .tb-logos img {
        max-height: 40px;
        opacity: 0.8;
        filter: grayscale(100%);
    }
    .tb-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 40px;
    }
    .tb-stat-item {
        flex: 1;
        min-width: 150px;
    }
    .tb-stat-number {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 48px;
        color: var(--primary-color);
        margin-bottom: 8px;
    }
    .tb-stat-label {
        font-family: 'Open Sans', sans-serif;
        font-weight: 600;
        font-size: 12px;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #666;
    }

    /* Section 3: Circular Future */
    .circular-future-section {
        display: flex;
        justify-content: center;
        padding: 30px 0;
        width: 100%;
        background-color: #FAF8F8;
        max-width: 1440px;
        margin: 0 auto;
    }
    .cf-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        gap: 60px;
        padding: 0 24px;
    }
    .cf-image-wrapper {
        flex: 1;
    }
    .cf-image {
        width: 100%;
        border-radius: 16px;
        object-fit: cover;
    }
    .cf-content {
        flex: 1;
    }
    .cf-heading {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        color: var(--section-text-color);
        margin-bottom: 24px;
    }
    .cf-desc {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 26px;
        color: var(--section-text-color);
        margin-bottom: 40px;
    }
    .cf-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .cf-list-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .cf-list-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
    }
    .cf-list-title {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        color: var(--section-text-color);
        margin-bottom: 4px;
    }
    .cf-list-text {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 22px;
        color: var(--section-text-color);
    }

    @media (max-width: 1024px) {
        .cf-container {
            flex-direction: column;
        }
    }
</style>
<main class="about-us-page">
@include('components.header')
@include('components.inner-hero')

<section class="about-passion-section">
    <div class="passion-container">
        <div class="passion-content">
            <h2 class="passion-heading">Born from a Passion for Premium Packaging</h2>
            <p class="passion-paragraph" style="margin-bottom: 12px;">
                Every exceptional product deserves packaging that reflects its quality,
                craftsmanship, and identity. We believe packaging is more than
                protection—it’s the first impression of your brand and an essential part of
                the customer experience.
            </p>
            <p class="passion-paragraph">
                Combining creative design with advanced manufacturing, we craft
                premium custom packaging solutions that blend durability, functionality,
                and luxury. From concept to production, our team helps brands create
                packaging that strengthens their identity, enhances product
                presentation, and leaves a lasting impression.
            </p>
        </div>
        <div class="passion-images">
            <img src="{{ asset('uploads/born-from-passion.png') }}" alt="Born from a Passion" class="passion-img-main">
            <img src="{{ asset('uploads/year-of-expertise.png') }}" alt="10+ Years of Expertise" class="passion-img-overlap">
        </div>
    </div>
</section>

<section class="mission-vision-section">
    <div class="mission-vision-container">
        <!-- Mission Card -->
        <div class="mv-card">
            <span class="mv-icon">
                <img src="{{ asset('uploads/our-mission.svg') }}" alt="Our Mission">
            </span>
            <h3 class="mv-heading">Our Mission</h3>
            <p class="mv-text">To elevate brand value through the mastery of structure and material, setting the global standard for luxury B2B packaging solutions that respect both the creator and the environment.</p>
        </div>

        <!-- Vision Card -->
        <div class="mv-card">
            <span class="mv-icon vision-icon">
                <img src="{{ asset('uploads/our-vision.svg') }}" alt="Our Vision">
            </span>
            <h3 class="mv-heading">Our Vision</h3>
            <p class="mv-text">To redefine the unboxing experience as a moment of profound brand connection, leading a sustainable revolution in the high-end packaging industry through continuous innovation.</p>
        </div>
    </div>
</section>

<!-- Section 1: Packaging Excellence -->
<section class="packaging-excellence">
    <div class="pe-container">
        <h2 class="pe-heading">Packaging Excellence You Can Trust</h2>
        <div class="pe-grid">
            <div class="pe-column">
                <h3 class="pe-col-title">Quality</h3>
                <p class="pe-col-text">Zero-compromise standards in material sourcing and assembly precision.</p>
            </div>
            <div class="pe-column">
                <h3 class="pe-col-title">Innovation</h3>
                <p class="pe-col-text">Constant exploration of new structural mechanics and bio-composite materials.</p>
            </div>
            <div class="pe-column">
                <h3 class="pe-col-title">Integrity</h3>
                <p class="pe-col-text">Transparent partnerships built on reliability, ethical manufacturing, and trust.</p>
            </div>
            <div class="pe-column">
                <h3 class="pe-col-title">Sustainability</h3>
                <p class="pe-col-text">Proactive carbon reduction and circular design philosophies in every project.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Trusted Brands -->
<section class="trusted-brands-section">
    <div class="tb-container">
        <h4 class="tb-heading">TRUSTED BY LEADING GLOBAL BRANDS</h4>
        @include('components.logo')
        <div class="tb-stats" id="counter-section">
            <div class="tb-stat-item">
                <div class="tb-stat-number"><span class="counter" data-target="500">0</span>+</div>
                <div class="tb-stat-label">GLOBAL PROJECTS</div>
            </div>
            <div class="tb-stat-item">
                <div class="tb-stat-number"><span class="counter" data-target="200">0</span>+</div>
                <div class="tb-stat-label">ELITE CLIENTS</div>
            </div>
            <div class="tb-stat-item">
                <div class="tb-stat-number"><span class="counter" data-target="30">0</span>+</div>
                <div class="tb-stat-label">STATES SERVED</div>
            </div>
            <div class="tb-stat-item">
                <div class="tb-stat-number"><span class="counter" data-target="99">0</span>%</div>
                <div class="tb-stat-label">SATISFACTION</div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Circular Future -->
<section class="circular-future-section">
    <div class="cf-container">
        <div class="cf-image-wrapper">
            <img src="{{ asset('uploads/building-circular-future.png') }}" alt="Circular Future" class="cf-image">
        </div>
        <div class="cf-content">
            <h2 class="cf-heading">Building a Circular Future</h2>
            <p class="cf-desc">We believe that true luxury should not come at a cost to our planet. Our circular packaging initiatives ensure that every structural design is as sustainable as it is sophisticated.</p>
            <div class="cf-list">
                <div class="cf-list-item">
                    <img src="{{ asset('uploads/fsc-certified.svg') }}" alt="FSC Certified" class="cf-list-icon" style="filter: hue-rotate(-20deg) brightness(0.6) saturate(2);">
                    <div>
                        <h4 class="cf-list-title">FSC® Certified Materials</h4>
                        <p class="cf-list-text">Every box we produce is made from responsibly sourced forest products.</p>
                    </div>
                </div>
                <div class="cf-list-item">
                    <img src="{{ asset('uploads/recycling-icon.svg') }}" alt="Recyclable" class="cf-list-icon" style="filter: hue-rotate(-20deg) brightness(0.6) saturate(2);">
                    <div>
                        <h4 class="cf-list-title">100% Recyclable Structures</h4>
                        <p class="cf-list-text">Innovative glue-free assembly methods that facilitate easy recycling.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('components.testimonal')
@include('components.cta')
@include('components.footer')
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
    const speed = 100; // The lower the slower

    const animateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 15);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    const observer = new IntersectionObserver((entries) => {
        if(entries[0].isIntersecting) {
            animateCounters();
            observer.disconnect();
        }
    }, { threshold: 0.5 });

    const section = document.getElementById('counter-section');
    if (section) {
        observer.observe(section);
    }
});
</script>

