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
            <li><a href="#">Home</a></li>
            <li class="has-dropdown"><a href="#">Boxes By Industry</a></li>
            <li class="has-dropdown"><a href="#">Boxes By Material</a></li>
            <li class="has-dropdown"><a href="#">Boxes By Style</a></li>
            <li class="has-dropdown"><a href="#">Packaging Supplies</a></li>
            <li><a href="#">Blogs</a></li>
        </ul>
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
                <li><a href="#">Home</a></li>
                <li class="has-dropdown"><a href="#">Boxes By Industry</a></li>
                <li class="has-dropdown"><a href="#">Boxes By Material</a></li>
                <li class="has-dropdown"><a href="#">Boxes By Style</a></li>
                <li class="has-dropdown"><a href="#">Packaging Supplies</a></li>
                <li><a href="#">Blogs</a></li>
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
    function toggleMobileMenu() {
        document.getElementById('mobileSidebar').classList.toggle('active');
        document.getElementById('mobileOverlay').classList.toggle('active');
        document.body.style.overflow = document.getElementById('mobileSidebar').classList.contains('active') ? 'hidden' : '';
    }
</script>
