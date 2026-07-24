@include('components.htmlboilerplate')
<style>
    /* .faq-page{
        width: 100%;
    max-width: 100%;
    overflow-x: clip;
    } */
    .faq-hero, .faq-container {
        font-family: 'DM Sans', sans-serif;
    }
    .faq-hero h1, .faq-section-title, .faq-filter-title {
        font-family: 'Open Sans', sans-serif;
    }
    .faq-hero {
        background-color: #ffffff;
        padding: 60px 24px;
        text-align: center;
        border-bottom: 1px solid #eaeaea;
    }
    .faq-breadcrumb {
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        color: #666;
        text-align: left;
        max-width: 1440px;
        margin: 0 auto 10px auto;
    }
    .faq-breadcrumb span {
        font-weight: 700;
        color: var(--section-text-color);
    }
    .faq-hero h1 {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--section-text-color, #111);
    }
    .faq-hero p {
        font-size: 16px;
        color: #555;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .faq-container {
        max-width: 1440px;
        margin: 60px auto;
        padding: 0 24px;
        display: flex;
        gap: 60px;
        align-items: flex-start;
    }

    /* Sidebar */
    .faq-sidebar {
        width: 300px;
        flex-shrink: 0;
    }
    .faq-filter-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--section-text-color, #111);
        padding-bottom: 15px;
        border-bottom: 0.2px solid #00000099;
    }
    .faq-categories {
        list-style: none;
        padding: 0 0 20px 0;
        margin: 0 0 40px 0;
        border-bottom: 0.2px solid #00000099;
    }
    .faq-categories li {
        margin-bottom: 5px;
    }
    .faq-categories button {
        width: 100%;
        text-align: left;
        padding: 12px 20px;
        background: transparent;
        border: none;
        font-size: 15px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.3s;
    }
    .faq-categories button.active, .faq-categories button:hover {
        background-color: var(--primary-color, #8D4445);
        color: #fff;
    }

    .faq-contact-box {
        background-color: #F0F0F0;
        padding: 30px 25px;
        border-radius: 8px;
    }
    .faq-contact-box h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #111;
    }
    .faq-contact-box p {
        font-size: 14px;
        color: #555;
        margin-bottom: 25px;
        line-height: 1.5;
    }
    .faq-contact-box .btn-contact {
        display: block;
        width: 100%;
        text-align: center;
        background-color: var(--primary-color, #8D4445);
        color: #fff;
        padding: 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.3s;
    }
    .faq-contact-box .btn-contact:hover {
        opacity: 0.9;
    }

    /* Content */
    .faq-content {
        flex-grow: 1;
    }
    .faq-section {
        margin-bottom: 50px;
    }
    .faq-section-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--section-text-color);
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }
    .faq-section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 3px;
        background-color: var(--primary-color, #8D4445);
    }
    .faq-accordion {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .faq-item {
        border: 1px solid #ddd;
        border-radius: 6px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .faq-item-header {
        background-color: #fff;
        padding: 18px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        color: #333;
        transition: background-color 0.3s;
    }
    .faq-item-header:hover {
        background-color: #fafafa;
    }
    .faq-item-icon {
        font-size: 20px;
        font-weight: 400;
        color: #111;
        transition: transform 0.3s;
    }
    .faq-item.active .faq-item-header {
        background-color: var(--primary-color, #8D4445);
        color: #fff;
    }
    .faq-item.active .faq-item-icon {
        color: #fff;
        transform: none;
    }
    .faq-item-body {
        background-color: #fff;
        padding: 0 25px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, padding 0.3s ease;
    }
    .faq-item.active .faq-item-body {
        padding: 0 25px 20px 25px;
        max-height: 500px;
    }
    .faq-item-body p {
        color: #555;
        font-size: 14.5px;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 1100px) {
        .faq-hero {
            padding: 40px 5%;
        }
        .faq-hero h1 {
            font-size: 34px;
        }
        .faq-hero p {
            font-size: 14px;
        }
        .faq-container {
            flex-direction: column;
            margin: 40px auto;
            padding: 0 5%;
        }
        .faq-sidebar {
            display: none;
        }
        .faq-content {
            width: 100%;
        }
        .faq-section {
            display: block !important;
        }
    }

    @media (max-width: 767px) {
        .faq-hero h1 {
            font-size: 28px;
        }
        .faq-container {
            margin: 30px auto;
        }
        .faq-item-header {
            font-size: 14px;
            padding: 15px 20px;
        }
    }
</style>

<main class="faq-page">
    @include('components.header')
    <div class="faq-hero">
        <div class="faq-breadcrumb">
            HOME / <span>FAQ's</span>
        </div>
        <h1>Frequently Asked Questions</h1>
        <p>Find clear answers to common questions about our luxury packaging services, processes, and policies.</p>
    </div>

    <div class="faq-container">
        <aside class="faq-sidebar">
            <h2 class="faq-filter-title">Filter By Category</h2>
            <ul class="faq-categories">
                <li><button class="active" data-filter="all">All</button></li>
                <li><button data-filter="design-artwork">Design & Artwork</button></li>
                <li><button data-filter="order-prices">Order & Prices</button></li>
                <li><button data-filter="sales">Sales</button></li>
                <li><button data-filter="shipping">Shipping</button></li>
                <li><button data-filter="custom-support">Custom Support</button></li>
            </ul>

            <div class="faq-contact-box">
                <h3>Still Have a Questions?</h3>
                <p>If you don't find your answer, feel free to reach out.</p>
                <a href="/contact" class="btn-contact">Contact Us</a>
            </div>
        </aside>

        <div class="faq-content">
            <div class="faq-section" data-category="design-artwork">
                <h2 class="faq-section-title">Design & Artwork</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What type of retail boxes are best for luxury product packaging?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Rigid boxes are considered the gold standard for luxury packaging. They are thick, durable, and offer a premium unboxing experience. We also offer high-end folding cartons with special finishes like foil stamping or embossing for a luxurious look.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Which retail boxes offer the most protect for fragile items?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Corrugated boxes provide the best protection for fragile items due to their fluted inner layer. We can customize corrugated boxes with foam or custom inserts to ensure your products remain secure during transit.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Do retail boxes have customizable shapes and structures?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Yes, absolutely! We can create custom die-cut shapes, windows, and unique structural designs to make your packaging stand out on the retail shelf and perfectly fit your product.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer full-color offset and digital printing, Pantone color matching, UV coating, soft-touch lamination, foil stamping, embossing, and debossing to make your artwork pop.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section" data-category="order-prices">
                <h2 class="faq-section-title">Order & Prices</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What type of retail boxes are best for luxury product packaging?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Rigid boxes and premium folding cartons with special finishes are typically best for luxury products. Our sales team can help you balance luxury appeal with your budget.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Which retail boxes offer the most protect for fragile items?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>For maximum protection, corrugated boxes with custom foam inserts are recommended. The cost will depend on the thickness of the board and the complexity of the insert.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Do retail boxes have customizable shapes and structures?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Yes, structural customization is available. Custom shapes may require a one-time die plate fee, which our pricing team will outline in your quote.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section" data-category="sales" style="display: none;">
                <h2 class="faq-section-title">Sales</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What type of retail boxes are best for luxury product packaging?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Rigid boxes and premium folding cartons with special finishes are typically best for luxury products. Our sales team can help you balance luxury appeal with your budget.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Which retail boxes offer the most protect for fragile items?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>For maximum protection, corrugated boxes with custom foam inserts are recommended. The cost will depend on the thickness of the board and the complexity of the insert.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Do retail boxes have customizable shapes and structures?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Yes, structural customization is available. Custom shapes may require a one-time die plate fee, which our pricing team will outline in your quote.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section" data-category="shipping" style="display: none;">
                <h2 class="faq-section-title">Shipping</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What type of retail boxes are best for luxury product packaging?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Rigid boxes and premium folding cartons with special finishes are typically best for luxury products. Our sales team can help you balance luxury appeal with your budget.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Which retail boxes offer the most protect for fragile items?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>For maximum protection, corrugated boxes with custom foam inserts are recommended. The cost will depend on the thickness of the board and the complexity of the insert.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Do retail boxes have customizable shapes and structures?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Yes, structural customization is available. Custom shapes may require a one-time die plate fee, which our pricing team will outline in your quote.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-section" data-category="custom-support" style="display: none;">
                <h2 class="faq-section-title">Custom Support</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What type of retail boxes are best for luxury product packaging?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Rigid boxes and premium folding cartons with special finishes are typically best for luxury products. Our sales team can help you balance luxury appeal with your budget.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Which retail boxes offer the most protect for fragile items?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>For maximum protection, corrugated boxes with custom foam inserts are recommended. The cost will depend on the thickness of the board and the complexity of the insert.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            Do retail boxes have customizable shapes and structures?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>Yes, structural customization is available. Custom shapes may require a one-time die plate fee, which our pricing team will outline in your quote.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-item-header">
                            What printing customization are available for retail boxes?
                            <span class="faq-item-icon">+</span>
                        </div>
                        <div class="faq-item-body">
                            <p>We offer a wide range of printing options. Keep in mind that special finishes like foil stamping and UV coating may increase the unit price.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@include('components.cta')
@include('components.footer')

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Accordion functionality
        const faqHeaders = document.querySelectorAll('.faq-item-header');
        faqHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const item = this.parentElement;
                const wasActive = item.classList.contains('active');
                
                // Close all other items in the same section
                const section = item.closest('.faq-section');
                section.querySelectorAll('.faq-item').forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-item-icon').textContent = '+';
                });
                
                // Toggle current item
                if (!wasActive) {
                    item.classList.add('active');
                    item.querySelector('.faq-item-icon').textContent = '-';
                }
            });
        });

        // Filtering functionality
        const filterBtns = document.querySelectorAll('.faq-categories button');
        const faqSections = document.querySelectorAll('.faq-section');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                // Show/hide sections based on filter
                faqSections.forEach(section => {
                    if (filter === 'all') {
                        section.style.display = 'block';
                    } else {
                        if (section.getAttribute('data-category') === filter) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    }
                });
            });
        });
        
        // Show everything if 'all' is clicked
        const allBtn = document.querySelector('.faq-categories button[data-filter="all"]');
        if (allBtn) {
            allBtn.click();
        }
    });
</script>

