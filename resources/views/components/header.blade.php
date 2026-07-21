<style>
    :root {
        --primary-color: #8D4445;
        --secondary-color: #F8EEEC;
        --background-color: #FAF8F8;
        --footer-color: #5F2D2F;
        --header-gradient: linear-gradient(278.74deg, #AB5A5B 0.2%, #8D4445 44.25%, #5B2829 88.3%);
        --section-text-color: #000000;
    }

    .site-header {
        background: var(--header-gradient);
        width: 100%;
        border-bottom: 0.2px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .site-header * {
        box-sizing: border-box;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 5% 10px 5%;
        max-width: 1440px;
        margin: 0 auto;
    }

    .header-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #fff;
    }

    .header-logo-img {
        height: 52px;
        width: auto;
        display: block;
    }

    .header-search {
        width: 328px;
        max-width: 100%;
        position: relative;
        margin: 0 20px;
    }

    .header-search input {
        width: 100%;
        height: 44px;
        background: transparent;
        border: 0.6px solid rgba(255, 255, 255, 0.6);
        border-radius: 6px;
        padding: 0 15px 0 40px;
        color: #fff;
        outline: none;
        transition: border-color 0.3s;
        font-family: inherit;
    }

    .header-search input:focus {
        border-color: #fff;
    }

    .header-search input::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }

    .header-search .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        fill: rgba(255, 255, 255, 0.8);
    }

    .header-contact {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .contact-item svg {
        width: 28px;
        height: 28px;
        fill: none;
        stroke: #fff;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .contact-item-text span {
        display: block;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
    }

    .contact-item-text strong {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-top: 2px;
        letter-spacing: 0.5px;
    }

    .get-quote-btn {
        background-color: #fff;
        color: var(--primary-color);
        padding: 12px 24px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: background-color 0.3s, color 0.3s;
        text-align: center;
    }

    .get-quote-btn:hover {
        background-color: var(--secondary-color);
    }

    .header-bottom {
        /* contains the nav */
    }

    .header-nav {
        display: flex;
        justify-content: center;
        padding: 10px 5% 16px 5%;
        max-width: 1440px;
        margin: 0 auto;
        list-style: none;
        gap: 40px;
    }

    .header-nav li a {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: opacity 0.3s;
    }

    .header-nav li a:hover {
        opacity: 0.8;
    }
    .header-nav li.has-dropdown > a::after {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
        margin: 0 0 3px 7px;
        border-right: 1.5px solid #fff;
        border-bottom: 1.5px solid #fff;
        transform: rotate(45deg);
    }

    /* Figma-style desktop mega menu */
    .header-nav li {
        position: static;
    }

    .mega-trigger {
        appearance: none;
        border: 0;
        padding: 0;
        background: transparent;
        color: #fff;
        font: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .mega-trigger::after {
        content: '';
        display: inline-block;
        width: 7px;
        height: 7px;
        margin: 0 0 3px 8px;
        border-right: 1.5px solid currentColor;
        border-bottom: 1.5px solid currentColor;
        transform: rotate(45deg);
        transition: transform .2s ease;
    }

    .mega-trigger[aria-expanded="true"]::after {
        transform: translateY(3px) rotate(225deg);
    }

    .mega-menu {
        position: absolute;
        z-index: 1100;
        top: calc(100% - 2px);
        left: 50%;
        width: min(760px, calc(100vw - 40px));
        padding: 18px 22px;
        background: var(--secondary-color);
        border: 1px solid rgba(255,255,255,.38);
        border-radius: 0 0 6px 6px;
        box-shadow: 0 18px 35px rgba(45, 20, 20, .25);
        opacity: 0;
        visibility: hidden;
        transform: translate(-50%, -8px);
        transition: opacity .18s ease, transform .18s ease, visibility .18s ease;
    }

    .mega-menu.is-open {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0);
    }

    .mega-menu-title {
        margin: 0 0 14px;
        color: var(--primary-color);
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .mega-menu-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px 18px;
    }

    .mega-menu-link {
        display: flex;
        align-items: center;
        min-width: 0;
        gap: 9px;
        color: #333;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.25;
        text-decoration: none;
    }

    .mega-menu-link:hover { color: var(--primary-color); }

    .mega-menu-link img {
        width: 23px;
        height: 23px;
        object-fit: contain;
        flex: 0 0 auto;
    }

    .mega-menu-footer {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-top: 18px;
        padding-top: 14px;
        border-top: 1px solid rgba(141, 68, 69, .22);
        color: #333;
        font-size: 13px;
        font-weight: 700;
    }

    .mega-menu-footer img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .mega-menu-cta {
        margin-left: auto;
        padding: 9px 20px;
        border-radius: 4px;
        background: var(--primary-color);
        color: #fff;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 3px 6px rgba(95,45,47,.25);
    }
    /* Desktop only items */
    @media (min-width: 993px) {
        .mobile-actions, .mobile-overlay, .mobile-sidebar {
            display: none !important;
        }
    }

    /* Mobile Styles */
    @media (max-width: 992px) {
        .header-top {
            height: 80px;
            padding: 0 5%;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 100%;
        }

        .header-search, .header-contact, .header-bottom {
            display: none;
        }

        .mobile-actions {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .mobile-search-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-search-btn svg {
            width: 24px;
            height: 24px;
            fill: #fff;
        }

        .mobile-menu-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .mobile-menu-btn svg {
            width: 32px;
            height: 32px;
            stroke: #fff;
            stroke-width: 2;
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -80vw;
            width: 80vw; /* 80vw width for the mobile sidebar */
            height: 100vh;
            background: var(--background-color);
            z-index: 999;
            transition: right 0.3s ease;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .mobile-sidebar.active {
            right: 0;
        }

        .mobile-sidebar-header {
            padding: 20px;
            background: var(--header-gradient);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-menu-btn {
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 5px;
        }

        .close-menu-btn svg {
            width: 28px;
            height: 28px;
            stroke: #fff;
            stroke-width: 2;
        }

        .mobile-sidebar-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .mobile-search {
            margin-bottom: 20px;
            position: relative;
        }

        .mobile-search input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            font-family: inherit;
        }

        .mobile-search .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            fill: #888;
        }

        .mobile-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .mobile-nav a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            display: block;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .mobile-contact {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 30px;
        }

        .mobile-contact .contact-item svg {
            stroke: var(--primary-color);
        }

        .mobile-contact .contact-item-text span {
            color: #666;
        }

        .mobile-contact .contact-item-text strong {
            color: var(--primary-color);
        }
    }

    @media (max-width: 576px) {
        .header-logo-img {
            height: 40px;
        }
        .mobile-search-btn {
            margin-right: 5px;
        }
    }
</style>

<header class="site-header">
    <div class="header-top">
        <a href="/" class="header-logo">
            <img src="{{ asset('uploads/rigid-boxes-logo.svg') }}" alt="The Rigid Boxes" class="header-logo-img">
        </a>

        <!-- Desktop Search -->
        <div class="header-search">
            <svg class="search-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
            <input type="text" placeholder="Search products...">
        </div>

        <!-- Desktop Contact -->
        <div class="header-contact">
            <div class="contact-item">
                <svg viewBox="0 0 24 24">
                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                    <path d="M14 22h-4"></path>
                </svg>
                <div class="contact-item-text">
                    <span>Call Us 24/7</span>
                    <strong>1800-518-9441</strong>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-text">
                    <span>Email</span>
                    <strong>example@gmail.com</strong>
                </div>
            </div>

            <a href="#" class="get-quote-btn">Get Instant Quote</a>
        </div>

        <!-- Mobile Actions -->
        <div class="mobile-actions">
            <button class="mobile-search-btn">
                <svg viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </button>
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <div class="header-bottom">
        <ul class="header-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/all-category">All Categories</a></li>
            <li><a href="/category">Category</a></li>
            <li><a href="/product">Product</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/blog">Blogs</a></li>
        </ul>
    </div>

    <div class="mega-menu" id="megaMenu" aria-hidden="true">
        <p class="mega-menu-title" id="megaMenuTitle">Boxes By Industry</p>
        <div class="mega-menu-grid" id="megaMenuGrid"></div>
        <div class="mega-menu-footer">
            <img src="{{ request()->getBaseUrl() }}/uploads/customer-service.png" alt="">
            <span>Need a custom packaging solution?</span>
            <a href="#" class="mega-menu-cta">Talk to us</a>
        </div>
    </div>
    <!-- Mobile Sidebar -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <a href="/" class="header-logo" style="margin: 0;">
                <img src="{{ asset('uploads/rigid-boxes-logo.svg') }}" alt="The Rigid Boxes" class="header-logo-img">
            </a>
            <button class="close-menu-btn" onclick="toggleMobileMenu()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="mobile-sidebar-content">
            <div class="mobile-search">
                <svg class="search-icon" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" placeholder="Search products...">
            </div>

            <ul class="mobile-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/all-category">All Categories</a></li>
                <li><a href="/category">Category</a></li>
                <li><a href="/product">Product</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/blog">Blogs</a></li>
            </ul>

            <div class="mobile-contact">
                <div class="contact-item">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        <path d="M14 22h-4"></path>
                    </svg>
                    <div class="contact-item-text">
                        <span>Call Us 24/7</span>
                        <strong>1800-518-9441</strong>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-item-text">
                        <span>Email</span>
                        <strong>example@gmail.com</strong>
                    </div>
                </div>
            </div>

            <a href="#" class="get-quote-btn" style="width: 100%;">Get Instant Quote</a>
        </div>
    </div>
</header>

<script>
    const megaMenuData = {
        industry: { title: 'Boxes By Industry', items: ['Apparel Boxes', 'Chocolate Packaging', 'Electronics Packaging', 'Food Packaging', 'Cosmetic Packaging', 'Retail Packaging', 'Candle Boxes', 'Health Care Packaging'] },
        material: { title: 'Boxes By Material', items: ['Cardboard Boxes', 'Kraft Paper Boxes', 'Rigid Boxes', 'Corrugated Boxes', 'Paperboard Boxes', 'Eco-Friendly Boxes', 'Grey Board Boxes', 'Textured Paper Boxes'] },
        style: { title: 'Boxes By Style', items: ['Magnetic Closure Boxes', 'Two Piece Boxes', 'Drawer Boxes', 'Sleeve Boxes', 'Tuck Top Boxes', 'Gable Boxes', 'Pillow Boxes', 'Die Cut Boxes'] },
        supplies: { title: 'Packaging Supplies', items: ['Custom Inserts', 'Tissue Paper', 'Packaging Sleeves', 'Shipping Boxes', 'Stickers & Labels', 'Thank You Cards', 'Ribbon & Twine', 'Protective Fill'] }
    };

    const megaMenu = document.getElementById('megaMenu');
    const megaMenuTitle = document.getElementById('megaMenuTitle');
    const megaMenuGrid = document.getElementById('megaMenuGrid');
    const megaTriggers = document.querySelectorAll('.mega-trigger');
    const megaAssetBase = "{{ request()->getBaseUrl() }}/uploads/";

    function closeMegaMenu() {
        megaMenu.classList.remove('is-open');
        megaMenu.setAttribute('aria-hidden', 'true');
        megaTriggers.forEach(trigger => trigger.setAttribute('aria-expanded', 'false'));
    }

    function openMegaMenu(menuKey, trigger) {
        const menu = megaMenuData[menuKey];
        if (!menu) return;
        const wasOpen = megaMenu.classList.contains('is-open') && trigger.getAttribute('aria-expanded') === 'true';
        closeMegaMenu();
        if (wasOpen) return;
        megaMenuTitle.textContent = menu.title;
        megaMenuGrid.innerHTML = menu.items.map(item => `<a href="#" class="mega-menu-link"><img src="${megaAssetBase}gift-box.png" alt=""><span>${item}</span></a>`).join('');
        megaMenu.classList.add('is-open');
        megaMenu.setAttribute('aria-hidden', 'false');
        trigger.setAttribute('aria-expanded', 'true');
    }

    megaTriggers.forEach(trigger => trigger.addEventListener('click', event => {
        event.stopPropagation();
        openMegaMenu(trigger.dataset.megaMenu, trigger);
    }));

    document.addEventListener('click', event => {
        if (!megaMenu.contains(event.target) && !event.target.closest('.mega-trigger')) closeMegaMenu();
    });

    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') closeMegaMenu();
    });
    function toggleMobileMenu() {
        document.getElementById('mobileSidebar').classList.toggle('active');
        document.getElementById('mobileOverlay').classList.toggle('active');
        document.body.style.overflow = document.getElementById('mobileSidebar').classList.contains('active') ? 'hidden' : '';
    }
</script>
