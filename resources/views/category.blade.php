@include('components.htmlboilerplate', ['title' => 'Cosmetics Packaging - The Rigid Boxes'])

<style>
    html, body { max-width: 100%; overflow-x: hidden; }

    /* Popular Boxes Section */
    .popular-boxes-section {
        background: #FFF;
        padding: 0px;
    }

    .popular-boxes-inner {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
        text-align: center;
        color: #333;
    }

    .section-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #111;
    }

    .section-subtitle {
        font-size: 16px;
        color: #666;
        margin-bottom: 20px;
    }

    .boxes-grid {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 292px));
        gap: 40px 30px;
        justify-content: space-between;
        justify-items: stretch;
    }

    .box-card {
        width: 100%;
        max-width: 292px;
        height: 437px;
        min-width: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .box-image-wrapper {
        width: 100%;
        height: 322px;
        aspect-ratio: auto;
        border-radius: 12px;
        overflow: hidden;
        background-color: #E8E8E8;
        margin-bottom: 18px;
        /* Default subtle shadow like the figma design */
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    .box-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        transition: transform 0.4s ease;
    }

    .box-card:hover .box-image-wrapper img {
        transform: scale(1.05);
    }

    .box-title {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        text-align: center;
        word-wrap: break-word;
    }

    /* Mobile Responsive View */
    @media (max-width: 992px) {
        .boxes-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .box-card {
            min-width: 0;
            height: auto;
        }

    }

    @media (max-width: 576px) {
        .popular-boxes-section {
            padding: 24px 0 0px;
        }

        .popular-boxes-inner {
            padding: 0 20px;
        }

        .boxes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px 10px; /* Reduced gap to fit cards */
        }

        .box-card {
            min-width: 0;
            height: auto;
        }

        .box-title {
            font-size: 13px;
        }
    }

    /* Customize Section */
    .customize-section {
        background: #FAFAFA;
        padding: 48px 0 54px;
        font-family: 'Open Sans', sans-serif;
    }

    .customize-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
    }

    .customize-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 36px;
        font-weight: 800;
        color: var(--section-text-color);
        margin-bottom: 12px;
    }

    .customize-subtitle {
        font-family: 'Open Sans', sans-serif;
        font-size: 18px;
        color: var(--section-text-color);
        margin-bottom: 40px;
        line-height: 1.5;
    }

    .customize-layout {
        display: grid;
        grid-template-columns: minmax(230px, 26%) minmax(0, 1fr);
        gap: 38px;
        align-items: stretch;
    }

    .customize-sidebar {
        width: auto;
        display: flex;
        flex-direction: column;
        gap: 18px;
        padding-bottom: 0;
        flex-shrink: 0;
        align-self: stretch;
    }

    .customize-tab {
        width: 100%;
        min-height: 0;
        flex: 1 1 0;
        min-height: 82px;
        padding: 18px 28px;
        text-align: left;
        background: #FFFFFF;
        border: 1px solid #EAEAEA;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        color: #333333;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .customize-tab.active,
    .customize-tab:hover,
    .customize-tab:focus-visible {
        background: var(--primary-color);
        color: #FFF;
        border-color: var(--primary-color);
    }

    .customize-content {
        flex: 1;
        min-width: 0;
        max-width: none;
    }

    .customize-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .custom-card {
        background: #FFF;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }


    .custom-img-wrapper {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 11px;
        overflow: hidden;
        margin-bottom: 14px;
        background: #f7f7f7;
    }

    .custom-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .custom-card h4 {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--section-text-color);
        margin: 0;
        padding: 0 0 2px;
        line-height: 1.3;
    }

    @media (max-width: 992px) {
        .customize-layout {
            display: flex;
            flex-direction: column;
        }

        .customize-sidebar {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding-bottom: 30px;
        }

        .customize-content {
            width: 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .customize-section {
            padding: 44px 0 40px;
        }
        .customize-title {
            font-size: 22px;
            line-height: 1.25;
            text-align: center;
            margin-bottom: 8px;
        }
        .customize-subtitle {
            font-size: 13px;
            line-height: 1.35;
            text-align: center;
            margin-bottom: 26px;
        }
        .customize-sidebar {
            display: flex;
            flex-direction: row;
            grid-template-columns: none;
            gap: 10px;
            padding-bottom: 24px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .customize-sidebar::-webkit-scrollbar {
            display: none;
        }
        .customize-tab {
            flex: 0 0 129px;
            min-height: 45px;
            padding: 10px;
            font-size: 10px;
            text-align: center;
        }
        .customize-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }
        .custom-card {
            padding: 8px 8px 20px 8px;
        }
        .custom-card h4 {
            font-size: 12px;
            text-align: center;
            padding-left: 0;
        }
    }





</style>
</head>
<body>

    @include('components.header')

    <main>
        @include('components.herohome')

        @include('components.logo')

        <!-- Popular Cosmetic Boxes Section -->
        <section class="popular-boxes-section">
            <div class="popular-boxes-inner">
            <h2 class="section-title">Explore Our Popular Cosmetic Boxes</h2>
            <p class="section-subtitle">Specialized structural solutions for every cosmetic silhouette.</p>

            <div class="boxes-grid">
                <!-- Card 1 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-rigid-plain-white-box.jfif') }}" alt="Lipstick Boxes" onerror="this.src='https://placehold.co/284x322/dddddd/555555?text=Lipstick+Boxes'">
                    </div>
                    <h3 class="box-title">Lipstick Boxes</h3>
                </div>

                <!-- Card 2 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-custom-shoulder-box.jfif') }}" alt="Serum Boxes" onerror="this.src='https://placehold.co/284x322/eeeeee/555555?text=Serum+Boxes'">
                    </div>
                    <h3 class="box-title">Serum Boxes</h3>
                </div>

                <!-- Card 3 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/addon-premium-foil-custom-box.jfif') }}" alt="Perfume Boxes" onerror="this.src='https://placehold.co/284x322/333333/ffffff?text=Perfume+Boxes'">
                    </div>
                    <h3 class="box-title">Perfume Boxes</h3>
                </div>

                <!-- Card 4 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/addon-gold-inside-box.jfif') }}" alt="Skincare Boxes" onerror="this.src='https://placehold.co/284x322/7c9780/ffffff?text=Skincare+Boxes'">
                    </div>
                    <h3 class="box-title">Skincare Boxes</h3>
                </div>

                <!-- Card 5 (Repeated for 2nd row) -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-two-piece-box.jfif') }}" alt="Lipstick Boxes" onerror="this.src='https://placehold.co/284x322/dddddd/555555?text=Lipstick+Boxes'">
                    </div>
                    <h3 class="box-title">Lipstick Boxes</h3>
                </div>

                <!-- Card 6 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-rigid-presentation-box.jfif') }}" alt="Serum Boxes" onerror="this.src='https://placehold.co/284x322/eeeeee/555555?text=Serum+Boxes'">
                    </div>
                    <h3 class="box-title">Serum Boxes</h3>
                </div>

                <!-- Card 7 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/category-custom-shaped-box.jfif') }}" alt="Perfume Boxes" onerror="this.src='https://placehold.co/284x322/333333/ffffff?text=Perfume+Boxes'">
                    </div>
                    <h3 class="box-title">Perfume Boxes</h3>
                </div>

                <!-- Card 8 -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-custom-luxury-box.jfif') }}" alt="Skincare Boxes" onerror="this.src='https://placehold.co/284x322/7c9780/ffffff?text=Skincare+Boxes'">
                    </div>
                    <h3 class="box-title">Skincare Boxes</h3>
                </div>

                <!-- Row 3 (4 cards) -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-box-with-lid.jfif') }}" alt="Lipstick Boxes" onerror="this.src='https://placehold.co/284x322/dddddd/555555?text=Lipstick+Boxes'">
                    </div>
                    <h3 class="box-title">Lipstick Boxes</h3>
                </div>
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/category-collapsible-rigid-boxes.webp') }}" alt="Serum Boxes" onerror="this.src='https://placehold.co/284x322/eeeeee/555555?text=Serum+Boxes'">
                    </div>
                    <h3 class="box-title">Serum Boxes</h3>
                </div>
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-magnetic-closure-boxes.webp') }}" alt="Perfume Boxes" onerror="this.src='https://placehold.co/284x322/333333/ffffff?text=Perfume+Boxes'">
                    </div>
                    <h3 class="box-title">Perfume Boxes</h3>
                </div>
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/industry-gift-boxes.webp') }}" alt="Skincare Boxes" onerror="this.src='https://placehold.co/284x322/7c9780/ffffff?text=Skincare+Boxes'">
                    </div>
                    <h3 class="box-title">Skincare Boxes</h3>
                </div>

                <!-- Row 4 (4 cards) -->
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/category-cardboard-boxes.webp') }}" alt="Lipstick Boxes" onerror="this.src='https://placehold.co/284x322/dddddd/555555?text=Lipstick+Boxes'">
                    </div>
                    <h3 class="box-title">Lipstick Boxes</h3>
                </div>
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/category-grey-board-boxes.webp') }}" alt="Serum Boxes" onerror="this.src='https://placehold.co/284x322/eeeeee/555555?text=Serum+Boxes'">
                    </div>
                    <h3 class="box-title">Serum Boxes</h3>
                </div>
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/category-bakery-boxes.webp') }}" alt="Perfume Boxes" onerror="this.src='https://placehold.co/284x322/333333/ffffff?text=Perfume+Boxes'">
                    </div>
                    <h3 class="box-title">Perfume Boxes</h3>
                </div>
                <div class="box-card">
                    <div class="box-image-wrapper">
                        <img src="{{ asset('uploads/category-box-by-industry-banner.webp') }}" alt="Skincare Boxes" onerror="this.src='https://placehold.co/284x322/7c9780/ffffff?text=Skincare+Boxes'">
                    </div>
                    <h3 class="box-title">Skincare Boxes</h3>
                </div>
            </div>
            </div><!-- end .popular-boxes-inner -->
        </section>

        <!-- Customize Packaging Section -->
        <section class="customize-section">
            <div class="customize-container">
                <h2 class="customize-title">Customize Every Detail Of Your Packaging</h2>
                <p class="customize-subtitle">Choose from premium materials, vibrant printing, luxury finishes, and custom inserts to create packaging that perfectly reflects your brand.</p>

                <div class="customize-layout">
                    <!-- Left Sidebar Tabs -->
                    <aside class="customize-sidebar">
                        <button type="button" class="customize-tab active" data-customize-tab="materials">MATERIALS</button>
                        <button type="button" class="customize-tab" data-customize-tab="printing">PRINTING METHODS</button>
                        <button type="button" class="customize-tab" data-customize-tab="inks">INKS</button>
                        <button type="button" class="customize-tab" data-customize-tab="finishing">FINISHING</button>
                        <button type="button" class="customize-tab" data-customize-tab="addons">ADD-ONS</button>
                    </aside>

                    <!-- Right Content Grid -->
                    <div class="customize-content">
                        <div class="customize-grid">
                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/category-grey-board-boxes.webp" alt="Duplex Chipboard" onerror="this.src='https://placehold.co/200x200/EEEEEE/888888?text=Duplex+Chipboard'">
                                </div>
                                <h4>Duplex Chipboard</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/category-cardboard-boxes.webp" alt="Grey Chipboard Cardboard" onerror="this.src='https://placehold.co/200x200/DDDDDD/888888?text=Grey+Cardboard'">
                                </div>
                                <h4>Grey Chipboard Cardboard</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/industry-custom-luxury-box.jfif" alt="Black-Kraft" onerror="this.src='https://placehold.co/200x200/333333/FFFFFF?text=Black-Kraft'">
                                </div>
                                <h4>Black-Kraft</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/addon-premium-foil-custom-box.jfif" alt="Holographic" onerror="this.src='https://placehold.co/200x200/FFCCEE/555555?text=Holographic'">
                                </div>
                                <h4>Holographic</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/addon-gold-inside-box.jfif" alt="Metallic Paper" onerror="this.src='https://placehold.co/200x200/FFDD55/555555?text=Metallic+Paper'">
                                </div>
                                <h4>Metallic Paper</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/category-bakery-boxes.webp" alt="Natural Brown Kraft" onerror="this.src='https://placehold.co/200x200/A08060/FFFFFF?text=Brown+Kraft'">
                                </div>
                                <h4>Natural Brown Kraft</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/industry-rigid-plain-white-box.jfif" alt="SBS C2S" onerror="this.src='https://placehold.co/200x200/F5F5F5/888888?text=SBS+C2S'">
                                </div>
                                <h4>SBS C2S</h4>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ request()->getBaseUrl() }}/uploads/category-box-by-material.webp" alt="Textured" onerror="this.src='https://placehold.co/200x200/E8E8E8/888888?text=Textured'">
                                </div>
                                <h4>Textured</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('components.testimonal')

        @include('components.customquote')

        {{-- ═══════════════════════════════════════
             TEXT CONTENT SECTION
        ═══════════════════════════════════════ --}}
        @include('components.content')

        {{-- ═══════════════════════════════════════
             FAQ SECTION
        ═══════════════════════════════════════ --}}
        @include('components.faq')


        @include('components.cta')

    </main>
    
    @include('components.footer')

    <script>
        const customizeCardOrders = {
            materials: [0, 1, 2, 3, 4, 5, 6, 7],
            printing: [1, 0, 2, 3, 7, 5, 6, 4],
            inks: [2, 3, 0, 1, 6, 7, 4, 5],
            finishing: [4, 5, 6, 7, 0, 1, 2, 3],
            addons: [7, 6, 5, 4, 3, 2, 1, 0]
        };

        const customizeCards = Array.from(document.querySelectorAll('.customize-grid .custom-card'));
        const customizeSidebar = document.querySelector('.customize-sidebar');
        const customizeUploadsUrl = "{{ request()->getBaseUrl() }}/";
        const customizeCardSets = {
            materials: [
                ['uploads/category-grey-board-boxes.webp', 'Duplex Chipboard'], ['uploads/category-cardboard-boxes.webp', 'Grey Chipboard Cardboard'],
                ['uploads/industry-custom-luxury-box.jfif', 'Black-Kraft'], ['uploads/addon-premium-foil-custom-box.jfif', 'Holographic'],
                ['uploads/addon-gold-inside-box.jfif', 'Metallic Paper'], ['uploads/category-bakery-boxes.webp', 'Natural Brown Kraft'],
                ['uploads/industry-rigid-plain-white-box.jfif', 'SBS C2S'], ['uploads/category-box-by-material.webp', 'Textured']
            ],
            printing: [
                ['uploads/hero-home-banner.png', 'Digital Printing'], ['uploads/category-box-by-industry-banner.webp', 'Offset Printing'],
                ['uploads/category-holographic.png', 'Foil Printing'], ['uploads/category-metallic-paper.png', 'Screen Printing'],
                ['uploads/industry-rigid-presentation-box.jfif', 'Embossed Printing'], ['uploads/category-custom-shaped-box.jfif', 'UV Printing'],
                ['uploads/industry-two-piece-box.jfif', 'Letterpress'], ['uploads/industry-box-with-lid.jfif', 'Spot Colour']
            ],
            inks: [
                ['uploads/category-black-kraft.png', 'Black Ink'], ['uploads/category-natural-brown-kraft.png', 'Soy Ink'],
                ['uploads/category-holographic.png', 'Metallic Ink'], ['uploads/category-metallic-paper.png', 'White Ink'],
                ['uploads/category-textured.png', 'Water-Based Ink'], ['uploads/category-sbs-c.png', 'Pantone Ink'],
                ['uploads/category-grey-cardboard-chip.png', 'UV Ink'], ['uploads/category-duplex-chip.png', 'CMYK Ink']
            ],
            finishing: [
                ['uploads/addon-gold-inside-box.jfif', 'Gold Foil'], ['uploads/category-holographic.png', 'Holographic Foil'],
                ['uploads/category-textured.png', 'Soft-Touch Lamination'], ['uploads/category-metallic-paper.png', 'Gloss Lamination'],
                ['uploads/category-black-kraft.png', 'Matte Lamination'], ['uploads/industry-custom-luxury-box.jfif', 'Spot UV'],
                ['uploads/industry-rigid-presentation-box.jfif', 'Embossing'], ['uploads/industry-box-with-lid.jfif', 'Debossing']
            ],
            addons: [
                ['uploads/industry-box-with-lid.jfif', 'Custom Inserts'], ['uploads/category-collapsible-rigid-boxes.webp', 'Ribbon Closure'],
                ['uploads/industry-magnetic-closure-boxes.webp', 'Magnetic Closure'], ['uploads/industry-two-piece-box.jfif', 'Paper Sleeve'],
                ['uploads/category-custom-shaped-box.jfif', 'Die-Cut Window'], ['uploads/industry-gift-boxes.webp', 'Thank-You Card'],
                ['uploads/industry-rigid-plain-white-box.jfif', 'Tissue Paper'], ['uploads/industry-custom-shoulder-box.jfif', 'Foam Insert']
            ]
        };

        function setCustomizeCardOrder(option) {
            /* Keep the same eight starter images for every tab for now;
               tab-specific artwork can be swapped in later without changing layout. */
            const cardOrder = customizeCardOrders.materials;

            customizeCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.98)';
            });

            setTimeout(() => {
                const cardSet = customizeCardSets.materials;
                cardOrder.forEach(function(cardIndex, position) {
                    const card = customizeCards[cardIndex];
                    const [imagePath, title] = cardSet[position];
                    const image = card.querySelector('img');
                    image.src = customizeUploadsUrl + imagePath;
                    image.alt = title;
                    card.querySelector('h4').textContent = title;
                    card.style.order = position + 1;
                });

                requestAnimationFrame(() => {
                    customizeCards.forEach(card => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    });
                });
            }, 200);
        }

        document.querySelectorAll('.customize-tab').forEach(function(tab) {
            tab.addEventListener('pointerdown', function(event) {
                event.stopPropagation();
            });
            tab.addEventListener('click', function() {
                document.querySelectorAll('.customize-tab').forEach(function(item) {
                    item.classList.remove('active');
                    item.setAttribute('aria-selected', 'false');
                });

                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                setCustomizeCardOrder(tab.dataset.customizeTab);

                if (customizeSidebar) {
                    tab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
                }
            });
        });

        setCustomizeCardOrder('materials');

        if (customizeSidebar) {
            let dragStartX = 0;
            let dragStartScrollLeft = 0;
            let isDraggingTabs = false;

            customizeSidebar.addEventListener('pointerdown', function(event) {
                dragStartX = event.clientX;
                dragStartScrollLeft = customizeSidebar.scrollLeft;
                isDraggingTabs = true;
                customizeSidebar.setPointerCapture(event.pointerId);
            });

            customizeSidebar.addEventListener('pointermove', function(event) {
                if (!isDraggingTabs) return;
                customizeSidebar.scrollLeft = dragStartScrollLeft - (event.clientX - dragStartX);
            });

            ['pointerup', 'pointercancel'].forEach(function(eventName) {
                customizeSidebar.addEventListener(eventName, function() {
                    isDraggingTabs = false;
                });
            });
        }

        function toggleFaq(btn) {
            const item = btn.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item.open').forEach(function(el) {
                el.classList.remove('open');
                el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                item.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
            }
        }
    </script>

</body>
</html>
