<style>
    :root {
        --site-container-width: 1280px;
        --site-container-gutter: 55px;
        --primary-color: #8D4445;
        --secondary-color: #F8EEEC;
        --background-color: #FAF8F8;
        --footer-color: #5F2D2F;
        --header-gradient: linear-gradient(278.74deg, #AB5A5B 0.2%, #8D4445 44.25%, #5B2829 88.3%);
        --section-text-color: #000000;
        --heading-h1-size: 32px;
        --heading-h2-size: 28px;
        --heading-h3-size: 24px;
        --heading-h4-size: 20px;
    }

    .header-container,
    .header-top,
    .header-nav {
        width: 100% !important;
        max-width: var(--site-container-width) !important;
        padding-left: clamp(20px, 3.5vw, 55px) !important;
        padding-right: clamp(20px, 3.5vw, 55px) !important;
        margin-left: auto !important;
        margin-right: auto !important;
        box-sizing: border-box !important;
        min-width: 0;
    }

    h1 { font-size: var(--heading-h1-size) !important; }
    h2 { font-size: var(--heading-h2-size) !important; }
    h3 { font-size: var(--heading-h3-size) !important; }
    h4 { font-size: var(--heading-h4-size) !important; }

    .site-header {
        background: var(--header-gradient);
        width: 100%;
        border-bottom: 0.2px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .site-header * {
        box-sizing: border-box;
    }

    .header-top {
        display: flex;
        align-items: center;
        width: 100%;
        min-height: 88px;
    }

    .header-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #fff;
        flex: 0 0 126px;
        width: 126px;
    }

    .header-logo-img {
        width: 126px !important;
        height: 64px !important;
        display: block;
        flex-shrink: 0;
    }

    .header-search {
        width: clamp(240px, 20vw, 330px);
        max-width: 100%;
        position: relative;
        margin-left: clamp(20px, 2.5vw, 45px);
        flex: 0 1 330px;
    }

    .header-search input {
        width: 100%;
        height: 44px;
        background: transparent;
        border: 0.6px solid rgba(255, 255, 255, 0.6);
        border-radius: 7px;
        padding: 0 35px 0 48px;
        color: #fff;
        outline: none;
        transition: border-color 0.3s;
        font-family: inherit;
        font-size: 15px;
    }

    .header-search input:focus {
        border-color: #fff;
    }

    .header-search input::placeholder {
        color: rgba(255, 255, 255, 0.8);
    }

    .header-search .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 22px;
        height: 22px;
        fill: rgba(255, 255, 255, 0.8);
    }

    .header-search .clear-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        fill: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        transition: fill 0.2s;
    }

    .header-search .clear-icon:hover {
        fill: rgba(255, 255, 255, 1);
    }

    .header-contact {
        display: flex;
        align-items: center;
        gap: clamp(12px, 1.5vw, 24px);
        margin-left: auto;
        flex: 0 0 auto;
        flex-shrink: 0;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
        white-space: nowrap;
    }

    .contact-item-phone,
    .contact-item-email {
        min-width: 0;
    }

    .site-header .contact-item svg {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        fill: none;
        stroke: #fff;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .contact-item-text {
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .contact-item-text span {
        display: block;
        font-size: 14px;
        color: #fff;
        font-weight: 700;
        white-space: nowrap;
        line-height: 1.2;
    }

    .contact-item-text strong {
        display: block;
        font-size: 16px;
        line-height: 1.35;
        font-weight: 400;
        margin-top: 1px;
        letter-spacing: 0;
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }

    .get-quote-btn {
        background-color: #fff;
        color: var(--primary-color);
        width: auto;
        min-height: 44px;
        padding: 0 clamp(12px, 1.2vw, 20px);
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: background-color 0.3s, color 0.3s;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 3px 5px rgba(55, 21, 22, .25);
        flex-shrink: 0;
        white-space: nowrap;
    }

    .get-quote-btn:hover {
        background-color: var(--secondary-color);
    }

    .header-bottom {
        border-bottom: 1px solid rgba(255, 255, 255, 0.18);
        position: relative;
    }

    .header-nav {
        display: flex;
        justify-content: center;
        width: 100%;
        min-height: 48px;
        list-style: none;
        gap: clamp(36px, 4vw, 62px);
        align-items: center;
    }

    @media (max-width: 768px) {
        :root { --site-container-gutter: 20px; }
    }

    @media (max-width: 480px) {
        :root { --site-container-gutter: 16px; }
    }

    .header-nav li {
        position: relative;
    }

    .header-nav li a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 700;
        transition: opacity 0.3s;
        display: inline-flex;
        align-items: center;
        padding: 12px 0;
    }

    .header-nav li a:hover {
        opacity: 0.85;
    }

    .header-nav li.has-mega > a::after {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
        margin: 0 0 2px 7px;
        border-right: 1.5px solid #fff;
        border-bottom: 1.5px solid #fff;
        transform: rotate(45deg);
        transition: transform 0.2s ease;
    }

    .header-nav li.has-mega:hover > a::after,
    .header-nav li.has-mega.active > a::after {
        transform: rotate(225deg) translateY(-2px);
    }

    /* Mega Menu Dropdown UI (Matching Screenshot Exactly) */
    .mega-menu {
        position: absolute;
        z-index: 1200;
        top: 100%;
        left: 50%;
        width: min(1020px, calc(100vw - 32px));
        padding: 26px 30px 20px;
        background: #FAF2F0;
        border: 1px solid #E8DCDA;
        border-radius: 12px;
        box-shadow: 0 18px 45px rgba(35, 15, 16, 0.22);
        opacity: 0;
        visibility: hidden;
        transform: translate(-50%, 8px);
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
    }

    .mega-menu.is-open {
        opacity: 1;
        visibility: visible;
        transform: translate(-50%, 0);
    }

    .mega-menu-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px 20px;
    }

    .mega-menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 10px;
        border-radius: 8px;
        text-decoration: none;
        color: #222222;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.35;
        transition: background 0.15s ease, color 0.15s ease, transform 0.15s ease;
    }

    .mega-menu-item:hover {
        background: #F2E3E0;
        color: var(--primary-color);
        transform: translateX(2px);
    }

    .mega-menu-icon {
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .mega-menu-icon svg {
        width: 22px;
        height: 22px;
        stroke: var(--primary-color);
        fill: none;
    }

    .mega-menu-icon img {
        width: 26px;
        height: 26px;
        display: block;
        object-fit: contain;
    }

    .mega-menu-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 22px;
        padding-top: 16px;
        border-top: 1px solid #E5D5D3;
    }

    .mega-menu-footer-left {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #1a1a1a;
        font-size: 15px;
        font-weight: 700;
    }

    .mega-menu-footer-icon {
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
    }

    .mega-menu-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 24px;
        border-radius: 6px;
        background: var(--primary-color);
        color: #ffffff !important;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(141, 68, 69, 0.22);
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .mega-menu-cta:hover {
        background: #733435;
        transform: translateY(-1px);
    }

    /* Desktop only items & Scroll Behavior */
    @media (min-width: 1101px) {
        .mobile-actions, .mobile-overlay, .mobile-sidebar {
            display: none !important;
        }
        .site-header {
            transition: top 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    }



    /* Mobile Styles */
    @media (max-width: 1100px) {
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
            width: 80vw;
            height: 100vh;
            background: var(--secondary-color);
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
            padding: 12px 35px 12px 40px;
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

        .mobile-search .clear-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            fill: #888;
            cursor: pointer;
        }

        .mobile-search .clear-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            fill: #aaa;
            cursor: pointer;
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

        .site-header .mobile-contact .contact-item svg {
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
            height: 60px;
        }
        .mobile-search-btn {
            margin-right: 5px;
        }
    }
</style>

<header class="site-header">
    <div class="header-top">
        <a href="/" class="header-logo">
            <img src="{{ asset('uploads/logo-rigid-boxes.svg') }}" alt="The Rigid Boxes" class="header-logo-img" width="126" height="64" fetchpriority="high">
        </a>

        <!-- Desktop Search -->
        <form action="/search" method="GET" class="header-search">
            <svg class="search-icon" viewBox="0 0 24 24">
                <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
            <input type="text" name="q" placeholder="Search products..." oninput="this.nextElementSibling.style.display = this.value ? 'block' : 'none';">
            <svg class="clear-icon" viewBox="0 0 24 24" style="display: none;" onclick="this.previousElementSibling.value=''; this.style.display='none'; this.previousElementSibling.focus();">
                <path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </form>

        <!-- Desktop Contact -->
        <div class="header-contact">
            <div class="contact-item contact-item-phone">
                <svg viewBox="0 0 24 24">
                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                    <path d="M14 22h-4"></path>
                </svg>
                <div class="contact-item-text">
                    <span>Call Us 24/7</span>
                    <strong>{{ $siteSettings['company_phone'] ?? '1800-315-8441' }}</strong>
                </div>
            </div>

            <div class="contact-item contact-item-email">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <div class="contact-item-text">
                    <span>Email</span>
                    <strong>{{ $siteSettings['company_email'] ?? 'example@gmail.com' }}</strong>
                </div>
            </div>

            <a href="/request-quote/" class="get-quote-btn">Get Instant Quote</a>
        </div>

        <!-- Mobile Actions -->
        <div class="mobile-actions">
            <button class="mobile-search-btn" onclick="toggleMobileSearch()">
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

    <!-- Mobile Search Dropdown -->
    <div class="mobile-search-dropdown" id="mobileSearchDropdown" style="display: none; padding: 12px 20px; background: #FAF8F8; border-bottom: 1px solid rgba(0,0,0,0.1);">
        <form action="/search" method="GET" style="display: flex; position: relative; width: 100%;">
            <input type="text" name="q" placeholder="Search products..." style="width: 100%; padding: 10px 75px 10px 15px; border: 1px solid #ddd; border-radius: 6px; outline: none; font-size: 15px; color: #333;" oninput="this.nextElementSibling.style.display = this.value ? 'flex' : 'none';">
            
            <!-- Clear text icon -->
            <svg viewBox="0 0 24 24" style="display: none; position: absolute; right: 45px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; cursor: pointer; color: #888;" onclick="this.previousElementSibling.value=''; this.style.display='none'; this.previousElementSibling.focus();">
                <path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>

            <!-- Close dropdown icon -->
            <button type="button" onclick="toggleMobileSearch()" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8D4445; padding: 0; display: flex; align-items: center; justify-content: center; border-left: 1px solid #eee; padding-left: 10px; height: 24px;">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </form>
    </div>

    <!-- Desktop Navigation -->
    <div class="header-bottom">
        <ul class="header-nav">
            <li><a href="/">Home</a></li>
            @php
                $navParentItems = isset($navCategories) ? array_values(array_filter($navCategories, fn($c) => empty($c['parent_id']))) : [];
            @endphp
            @foreach($navParentItems as $navParent)
            <li class="has-mega" data-mega-type="{{ $navParent['slug'] }}">
                <a href="{{ url('/' . $navParent['slug']) }}/" class="mega-trigger">{{ $navParent['title'] }}</a>
            </li>
            @endforeach
            <li><a href="/blog">Blogs</a></li>
        </ul>

        <!-- Mega Menu Panel -->
        <div class="mega-menu" id="megaMenu">
            <div class="mega-menu-grid" id="megaMenuGrid"></div>
            
            <div class="mega-menu-footer">
                <div class="mega-menu-footer-left">
                    <div class="mega-menu-footer-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#8D4445" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                            <path d="M14 22h-4"></path>
                        </svg>
                    </div>
                    <span>Need a custom packaging solution?</span>
                </div>
                <a href="/contact-us/" class="mega-menu-cta">Talk to us</a>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <a href="/" class="header-logo" style="margin: 0;">
                <img src="{{ asset('uploads/logo-rigid-boxes.svg') }}" alt="The Rigid Boxes" class="header-logo-img">
            </a>
            <button class="close-menu-btn" onclick="toggleMobileMenu()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="mobile-sidebar-content">
            <form action="/search" method="GET" class="mobile-search">
                <svg class="search-icon" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" name="q" placeholder="Search products..." oninput="this.nextElementSibling.style.display = this.value ? 'block' : 'none';">
                <svg class="clear-icon" viewBox="0 0 24 24" style="display: none; fill: none; stroke: #8D4445; stroke-width: 2;" onclick="this.previousElementSibling.value=''; this.style.display='none'; this.previousElementSibling.focus();">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </form>

            <ul class="mobile-nav">
                <li><a href="/">Home</a></li>
                @foreach($navParentItems as $navParent)
                    <li><a href="{{ url('/' . $navParent['slug']) }}/">{{ $navParent['title'] }}</a></li>
                @endforeach
                <li><a href="/blog">Blogs</a></li>
            </ul>

            <a href="/contact-us/" class="get-quote-btn" style="display:flex; width: 100%; text-align: center; justify-content: center; margin: 30px 0; background: #8D4445; color: #fff; padding: 12px 20px; border-radius: 4px; font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 16px; text-decoration: none;">Get Instant Quote</a>

            <div class="mobile-contact" style="margin-top: 0; gap: 0; display: flex; flex-direction: column; align-items: flex-start;">
                <h3 style="font-family: 'DM Sans', sans-serif; font-size: 18px; margin-bottom: 20px; color: #000; text-align: left;">Get In Touch</h3>
                
                <div class="mobile-contact-item" style="display: flex; align-items: flex-start; justify-content: flex-start !important; gap: 15px; margin-bottom: 20px; width: 100%; text-align: left;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; stroke: #8D4445; flex-shrink: 0; margin-top: 2px;">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <span style="font-family: 'DM Sans', sans-serif; font-size: 16px; color: #111; font-weight: 400; text-align: left;">{{ $siteSettings['company_phone'] ?? '1800-518-9441' }}</span>
                </div>

                <div class="mobile-contact-item" style="display: flex; align-items: flex-start; justify-content: flex-start !important; gap: 15px; margin-bottom: 20px; width: 100%; text-align: left;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; stroke: #8D4445; flex-shrink: 0; margin-top: 2px;">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <span style="font-family: 'DM Sans', sans-serif; font-size: 16px; color: #111; font-weight: 400; text-align: left;">{{ $siteSettings['company_email'] ?? 'example@gmail.com' }}</span>
                </div>

                <div class="mobile-contact-item" style="display: flex; align-items: flex-start; justify-content: flex-start !important; gap: 15px; width: 100%; text-align: left;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; stroke: #8D4445; flex-shrink: 0; margin-top: 2px;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <span style="font-family: 'DM Sans', sans-serif; font-size: 16px; color: #111; font-weight: 400; text-align: left;">{!! strip_tags(str_replace('<br>', ' ', $siteSettings['company_address'] ?? '1880 S Dairy Ashford Rd Suite 207 Houston, TX 77077')) !!}</span>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    (function() {
        const giftBoxSvg = `<svg viewBox="0 0 24 24" fill="none" stroke="#8D4445" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="8" width="18" height="4" rx="1"></rect>
            <path d="M12 8v13"></path>
            <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
            <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path>
        </svg>`;

        // Build megaData dynamically from DB categories
        @php
            $navCatsAll = $navCategories ?? [];
            $navParents = array_filter($navCatsAll, fn($c) => empty($c['parent_id']));
            $navChildren = array_filter($navCatsAll, fn($c) => !empty($c['parent_id']));
            
            // Map: parent_slug => [children]
            $navByParentSlug = [];
            foreach ($navParents as $parent) {
                $slug = $parent['slug'];
                $children = array_filter($navChildren, fn($c) => $c['parent_id'] == $parent['id']);
                $navByParentSlug[$slug] = array_values($children);
            }
        @endphp

        const megaData = {
            @foreach($navParents as $parent)
            "{{ $parent['slug'] }}": [
                @foreach($navByParentSlug[$parent['slug']] ?? [] as $child)
                @php
                    $childIcon = !empty($child['icon'])
                        ? (\Illuminate\Support\Str::startsWith($child['icon'], ['storage/', 'uploads/', 'images/'])
                            ? asset($child['icon'])
                            : asset('storage/' . $child['icon']))
                        : '';
                @endphp
                { title: @json($child['title']), slug: @json($child['slug']), icon: @json($childIcon) },
                @endforeach
            ],
            @endforeach
        };

        // Map nav li data-mega-type to parent slug
        const navMapping = {
            @foreach($navParents as $parent)
            "{{ $parent['slug'] }}": "{{ $parent['slug'] }}",
            @endforeach
        };

        const megaMenu = document.getElementById('megaMenu');
        const megaMenuGrid = document.getElementById('megaMenuGrid');
        const hasMegaLis = document.querySelectorAll('.has-mega');
        let activeType = null;
        let hoverTimeout = null;

        function renderMegaGrid(type) {
            // type can be the slug or a legacy type name like "industry"
            const items = megaData[type] || [];
            if (items.length === 0) {
                megaMenuGrid.innerHTML = '<p style="color:#999;padding:12px;font-size:13px;">No subcategories found.</p>';
                return;
            }
            megaMenuGrid.innerHTML = items.map(item => {
                const title = typeof item === 'string' ? item : item.title;
                const slug = typeof item === 'string' ? title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') : item.slug;
                const icon = typeof item === 'object' ? item.icon : '';
                const iconHtml = icon
                    ? `<img src="${icon}" alt="" loading="lazy">`
                    : giftBoxSvg;
                return `<a href="/${slug}" class="mega-menu-item">
                    <div class="mega-menu-icon">${iconHtml}</div>
                    <span>${title}</span>
                </a>`;
            }).join('');
        }

        function openMenu(type, li) {
            clearTimeout(hoverTimeout);
            activeType = type;
            hasMegaLis.forEach(l => l.classList.remove('active'));
            li.classList.add('active');
            renderMegaGrid(type);
            megaMenu.classList.add('is-open');
        }

        function closeMenu() {
            clearTimeout(hoverTimeout);
            hoverTimeout = setTimeout(() => {
                hasMegaLis.forEach(l => l.classList.remove('active'));
                megaMenu.classList.remove('is-open');
                activeType = null;
            }, 120);
        }

        hasMegaLis.forEach(li => {
            const type = li.dataset.megaType;
            li.addEventListener('mouseenter', () => openMenu(type, li));
            li.addEventListener('mouseleave', () => closeMenu());
        });

        megaMenu.addEventListener('mouseenter', () => clearTimeout(hoverTimeout));
        megaMenu.addEventListener('mouseleave', () => closeMenu());
    })();

    function toggleMobileMenu() {
        document.getElementById('mobileSidebar').classList.toggle('active');
        document.getElementById('mobileOverlay').classList.toggle('active');
        document.body.style.overflow = document.getElementById('mobileSidebar').classList.contains('active') ? 'hidden' : '';
    }

    function toggleMobileSearch() {
        const dropdown = document.getElementById('mobileSearchDropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
            dropdown.querySelector('input').focus();
        } else {
            dropdown.style.display = 'none';
        }
    }

    // Sticky Navbar Scroll Behavior
    document.addEventListener('DOMContentLoaded', function() {
        let lastScrollY = window.scrollY;
        const header = document.querySelector('.site-header');
        const headerTop = document.querySelector('.header-top');
        
        window.addEventListener('scroll', function() {
            if (window.innerWidth <= 1100) return;
            
            const currentScrollY = window.scrollY;
            const headerTopHeight = headerTop ? headerTop.offsetHeight : 88;
            
            if (currentScrollY > headerTopHeight) {
                if (currentScrollY > lastScrollY) {
                    // Scrolling Down
                    header.classList.add('scrolled-down');
                    header.style.top = `-${headerTopHeight}px`;
                    header.style.transform = 'none'; // Ensure transform is cleared
                } else {
                    // Scrolling Up
                    header.classList.remove('scrolled-down');
                    header.style.top = '0px';
                    header.style.transform = 'none';
                }
            } else {
                header.classList.remove('scrolled-down');
                header.style.top = '0px';
                header.style.transform = 'none';
            }
            
            lastScrollY = currentScrollY;
        }, { passive: true });
    });
</script>

<script>
    (function () {
        function imageNameFromSrc(image) {
            const source = image.currentSrc || image.getAttribute('src') || '';
            if (!source || source.startsWith('data:') || source.startsWith('blob:')) return '';

            try {
                const pathname = new URL(source, window.location.href).pathname;
                const filename = decodeURIComponent(pathname.split('/').pop() || '');
                return filename.replace(/\.[a-z0-9]+$/i, '');
            } catch (error) {
                return '';
            }
        }

        function applyImageMetadata(image) {
            const imageName = imageNameFromSrc(image);
            if (!imageName) return;

            const words = imageName
                .replace(/([a-z0-9])([A-Z])/g, '$1 $2')
                .replace(/[^a-zA-Z0-9]+/g, ' ')
                .trim()
                .split(/\s+/)
                .filter(Boolean);

            if (!words.length) return;

            image.alt = words.map(word => word.toLowerCase()).join('-');
            image.title = words
                .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                .join(' ');
        }

        function applyToImages(root) {
            if (root instanceof HTMLImageElement) applyImageMetadata(root);
            if (root.querySelectorAll) root.querySelectorAll('img').forEach(applyImageMetadata);
        }

        function initializeImageMetadata() {
            applyToImages(document);

            document.addEventListener('load', event => {
                if (event.target instanceof HTMLImageElement) applyImageMetadata(event.target);
            }, true);

            new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                    mutation.addedNodes.forEach(node => {
                        if (node.nodeType === Node.ELEMENT_NODE) applyToImages(node);
                    });
                });
            }).observe(document.body, { childList: true, subtree: true });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeImageMetadata);
        } else {
            initializeImageMetadata();
        }
    })();
</script>
