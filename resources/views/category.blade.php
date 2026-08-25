@include('components.htmlboilerplate', [
    'title' => $category['meta_title'] ?? ($category['title'] ?? 'Custom Packaging'),
    'metaDescription' => $category['meta_description'] ?? '',
    'metaKeywords' => $category['meta_keywords'] ?? '',
    'robots' => $category['robots'] ?? 'index,follow',
    'schema' => $category['schema'] ?? '',
])

<style>
    html,
    body {
        max-width: 100%;
        overflow-x: clip;
    }

    /* Popular Boxes Section */
    .popular-boxes-section {
        background: #FAF8F8;
        padding: 0px;
    }

    .popular-boxes-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 55px;
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
        color: #000;
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
        height: auto;
        min-width: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .box-image-wrapper {
        width: 100%;
        height: auto;
        aspect-ratio: auto;
        border-radius: 12px;
        overflow: hidden;
        background-color: #E8E8E8;
        margin-bottom: 26px;
        /* Default subtle shadow like the figma design */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        position: relative;
    }

    .box-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
        object-position: center;
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .box-image-wrapper .hover-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
    }

    .box-card:hover .box-image-wrapper img:not(.hover-img) {
        transform: scale(1.05);
    }

    .box-card:hover .box-image-wrapper .hover-img {
        opacity: 1;
        transform: scale(1.05);
    }

    .box-card:hover .box-image-wrapper:has(.hover-img) .main-img {
        opacity: 0;
    }

    .box-title {
        font-size: 19px !important;
        font-weight: 700;
        color: var(--section-text-color);
        text-align: center;
        word-wrap: break-word;
        display: block;
        /* Ensures span behaves like block element */
    }

    /* Mobile Responsive View */
    @media (max-width: 992px) {
        .boxes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px 16px;
        }

        .box-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            height: auto;
        }

        .box-image-wrapper {
            height: auto;
        }
    }

    @media (max-width: 576px) {
        .popular-boxes-section {
            padding: 0px 0 25px;
        }

        .popular-boxes-inner {
            padding: 0 16px;
        }

        .section-title {
            font-size: 22px;
            margin-bottom: 8px;
        }

        .section-subtitle {
            font-size: 13.5px;
            margin-bottom: 20px;
        }

        .boxes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 12px;
        }

        .box-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            height: auto;
        }

        .box-image-wrapper {
            width: 100%;
            height: auto;
            border-radius: 16px;
            margin-bottom: 8px;
        }

        .box-title {
            font-size: 14px !important;
            font-weight: 700;
            line-height: 1.25;
        }
    }

    /* Customize Section */
    .customize-section {
        background: #FAFAFA;
        padding: 48px 0 54px;
        font-family: 'Open Sans', sans-serif;
    }

    .customize-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 55px;
        box-sizing: border-box;
    }

    /* Unified Container Responsive Padding */
    @media (max-width: 1100px) {

        .popular-boxes-inner,
        .customize-container {
            padding-left: 32px;
            padding-right: 32px;
        }
    }

    @media (max-width: 768px) {

        .popular-boxes-inner,
        .customize-container {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media (max-width: 576px) {

        .popular-boxes-inner,
        .customize-container {
            padding-left: 16px;
            padding-right: 16px;
        }
    }

    .customize-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 32px;
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
        min-height: 54px;
        flex: 1;
        padding: 14px 24px;
        text-align: center;
        background: #FFFFFF;
        border: 1px solid #D8D8D8;
        border-radius: 0px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: #222222;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .customize-tab.active,
    .customize-tab:hover,
    .customize-tab:focus-visible {
        background: #8D4445;
        color: #FFFFFF;
        border-color: #8D4445;
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
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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

    .custom-card .h4-style {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: var(--section-text-color);
        margin: 0;
        padding: 0 0 2px;
        line-height: 1.3;
    }

    .custom-card .custom-card-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 16px !important;
        font-weight: 600;
        color: var(--section-text-color);
        margin: 0;
        padding: 0 0 2px;
        line-height: 1.3;
        display: block;
    }

    @media (max-width: 992px) {
        .customize-layout {
            display: flex;
            flex-direction: column;
            gap:0px
        }

        .customize-sidebar {
            width: 100%;
            display: flex !important;
            flex-direction: row !important;
            gap: 12px !important;
            padding-bottom: 24px;
            overflow-x: auto !important;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .customize-sidebar::-webkit-scrollbar {
            display: none;
        }

        .customize-tab {
            width: auto !important;
            flex: 0 0 auto !important;
            min-height: 46px !important;
            height: 46px !important;
            padding: 10px 20px !important;
            font-size: 13px !important;
            white-space: nowrap !important;
        }

        .customize-content {
            width: 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 576px) {
        .customize-section {
            padding: 0px 0 36px;
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
            margin-bottom: 24px;
        }

        .customize-sidebar {
            display: flex !important;
            flex-direction: row !important;
            gap: 10px !important;
            padding-bottom: 20px;
            overflow-x: auto !important;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .customize-sidebar::-webkit-scrollbar {
            display: none;
        }

        .customize-tab {
            width: auto !important;
            flex: 0 0 auto !important;
            height: 44px !important;
            min-height: 0 !important;
            padding: 10px 18px !important;
            font-size: 12px !important;
            font-weight: 700;
            text-align: center;
            white-space: nowrap !important;
            border-radius: 0px !important;
        }

        .customize-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px 12px;
        }

        .custom-card {
            padding: 12px;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .custom-img-wrapper {
            height: 130px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .custom-card .h4-style {
            font-size: 13px;
            font-weight: 600;
            color: #111;
            text-align: left;
            padding-left: 0;
            line-height: 1.3;
        }

        .custom-card .custom-card-title {
            font-size: 15px;
            font-weight: 600;
            color: #111;
            text-align: left;
            padding-left: 0;
            line-height: 1.3;
            display: block;
        }
    }
</style>
</head>

<body>

    @include('components.header')

    <main>
        @include('components.herohome', ['settings' => $category ?? []])

        @include('components.logo')

        <!-- Popular Boxes Section -->
        <section class="popular-boxes-section">
            <div class="popular-boxes-inner">
                <h2 class="section-title">Explore Our {{ $category['title'] ?? 'Custom Packaging Boxes' }}</h2>
                <p class="section-subtitle">Specialized structural packaging solutions engineered for maximum impact and
                    protection.</p>

                <div class="boxes-grid">
                    @php
                        $catProducts = !empty($products) ? $products : [];
                    @endphp
                    @foreach ($catProducts as $p)
                        @php
                            $pImg = '';
                            $pGalleryRaw = [];
                            if (!empty($p['images'])) {
                                $pGalleryRaw = is_string($p['images'])
                                    ? (json_decode($p['images'], true) ?:
                                    [])
                                    : (array) $p['images'];
                            }
                            
                            if (!empty($p['image'])) {
                                $pImg = $p['image'];
                            } else {
                                if (!empty($pGalleryRaw) && count($pGalleryRaw) > 0) {
                                    $pImg = $pGalleryRaw[0];
                                } else {
                                    $pImg = 'uploads/Gift-Boxes.webp';
                                }
                            }
                            
                            $pHoverImg = '';
                            if (!empty($p['hover_image'])) {
                                $pHoverImg = $p['hover_image'];
                            } elseif (count($pGalleryRaw) > 1) {
                                $pHoverImg = $pGalleryRaw[1];
                            } elseif (count($pGalleryRaw) > 0 && $pImg != $pGalleryRaw[0]) {
                                $pHoverImg = $pGalleryRaw[0];
                            } else {
                                $pHoverImg = $pImg;
                            }

                            $pImg = \Illuminate\Support\Str::startsWith($pImg, ['storage/', 'uploads/', 'images/'])
                                ? $pImg
                                : 'storage/' . $pImg;
                                
                            $pHoverImg = \Illuminate\Support\Str::startsWith($pHoverImg, ['storage/', 'uploads/', 'images/'])
                                ? $pHoverImg
                                : 'storage/' . $pHoverImg;

                            $pSlug = $p['slug'] ?? \Illuminate\Support\Str::slug($p['title']);
                        @endphp
                        <div class="box-card">
                            <a href="{{ url('/' . $pSlug) }}"
                                style="text-decoration:none; color:inherit; width:100%; display:block;">
                                <div class="box-image-wrapper">
                                    <img src="{{ asset($pImg) }}?v={{ @filemtime(public_path($pImg)) ?: 1 }}" alt="{{ $p['title'] }}" class="main-img"
                                        onerror="this.src='https://placehold.co/284x322/dddddd/555555?text={{ urlencode($p['title']) }}'" loading="lazy">
                                    @if($pHoverImg && $pHoverImg !== $pImg)
                                    <img src="{{ asset($pHoverImg) }}?v={{ @filemtime(public_path($pHoverImg)) ?: 1 }}" alt="{{ $p['title'] }} Hover" class="hover-img"
                                        onerror="this.src='https://placehold.co/284x322/dddddd/555555?text={{ urlencode($p['title']) }}'" loading="lazy">
                                    @endif
                                </div>
                                <span class="box-title">{{ $p['title'] }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div><!-- end .popular-boxes-inner -->
        </section>

        <!-- Customize Packaging Section -->
        <section class="customize-section">
            <div class="customize-container">
                <span class="customize-title" style="display: block;">Customize Every Detail Of Your Packaging</span>
                <p class="customize-subtitle">Choose from premium materials, vibrant printing, luxury finishes, and
                    custom inserts to create packaging that perfectly reflects your brand.</p>

                <div class="customize-layout">
                    <!-- Left Sidebar Tabs -->
                    <aside class="customize-sidebar">
                        <button type="button" class="customize-tab active"
                            data-customize-tab="materials">MATERIALS</button>
                        <button type="button" class="customize-tab" data-customize-tab="printing">PRINTING
                            METHODS</button>
                        <button type="button" class="customize-tab" data-customize-tab="inks">INKS</button>
                        <button type="button" class="customize-tab" data-customize-tab="finishing">FINISHING</button>
                        <button type="button" class="customize-tab" data-customize-tab="addons">ADD-ONS</button>
                        <button type="button" class="customize-tab" data-customize-tab="additional">ADDITIONAL
                            OPTIONS</button>
                    </aside>

                    <!-- Right Content Grid -->
                    <div class="customize-content">
                        <div class="customize-grid">
                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/duplex-chipboard.webp') }}" alt="Duplex Chipboard" loading="lazy">

                                </div>
                                <span class="custom-card-title">Duplex Chipboard</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/grey-board.webp') }}" alt="Grey Chipboard Cardboard"
                                        onerror="this.src='https://placehold.co/200x200/DDDDDD/888888?text=Grey+Cardboard'" loading="lazy">
                                </div>
                                <span class="custom-card-title">Grey Chipboard Cardboard</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/black-kraft.webp') }}" alt="Black-Kraft"
                                        onerror="this.src='https://placehold.co/200x200/333333/FFFFFF?text=Black-Kraft'" loading="lazy">
                                </div>
                                <span class="custom-card-title">Black-Kraft</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/finish-material-holographic.webp') }}" alt="Holographic"
                                        onerror="this.src='https://placehold.co/200x200/FFCCEE/555555?text=Holographic'">
                                </div>
                                <span class="custom-card-title">Holographic</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/metallic-paper.webp') }}" alt="Metallic Paper"
                                        onerror="this.src='https://placehold.co/200x200/FFDD55/555555?text=Metallic+Paper'">
                                </div>
                                <span class="custom-card-title">Metallic Paper</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/natural-brown-.webp') }}" alt="Natural Brown Kraft"
                                        onerror="this.src='https://placehold.co/200x200/A08060/FFFFFF?text=Brown+Kraft'">
                                </div>
                                <span class="custom-card-title">Natural Brown Kraft</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/sbs-c2s.webp') }}" alt="SBS C2S"
                                        onerror="this.src='https://placehold.co/200x200/F5F5F5/888888?text=SBS+C2S'">
                                </div>
                                <span class="custom-card-title">SBS C2S</span>
                            </div>

                            <div class="custom-card">
                                <div class="custom-img-wrapper">
                                    <img src="{{ asset('uploads/textured-.webp') }}" alt="Textured"
                                        onerror="this.src='https://placehold.co/200x200/CCBBAA/333?text=Textured'">
                                </div>
                                <span class="custom-card-title">Textured</span>
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
            inks: [2, 3, 0, 1, 6, 7],
            finishing: [4, 5, 6, 7, 0, 1, 2, 3],
            addons: [7, 6, 5, 4, 3, 2, 1, 0],
            additional: [0, 1, 2, 3, 4, 5, 6]
        };

        const customizeCards = Array.from(document.querySelectorAll('.customize-grid .custom-card'));
        const customizeSidebar = document.querySelector('.customize-sidebar');
        const customizeUploadsUrl = "{{ asset('') }}";
        const customizeCardSets = {
            materials: [
                ['uploads/duplex-chipboard.webp', 'Duplex Chipboard'],
                ['uploads/grey-board.webp', 'Grey Chipboard Cardboard'],
                ['uploads/black-kraft.webp', 'Black-Kraft'],
                ['uploads/finish-material-holographic.webp', 'Holographic'],
                ['uploads/metallic-paper.webp', 'Metallic Paper'],
                ['uploads/natural-brown-.webp', 'Natural Brown Kraft'],
                ['uploads/sbs-c2s.webp', 'SBS C2S'],
                ['uploads/textured-.webp', 'Textured']
            ],
            printing: [
                ['uploads/Digital Print.webp', 'Digital Print'],
                ['uploads/Flexographic Printing.webp', 'Flexographic Printing'],
                ['uploads/gravure printing.webp', 'Gravure Printing'],
                ['uploads/Offset Print.webp', 'Offset Print'],
                ['uploads/Rotogravure Printing.webp', 'Rotogravure Printing'],
                ['uploads/Scodixe Digital.webp', 'Scodixe Digital'],
                ['uploads/Screen Printing.webp', 'Screen Printing'],
                ['uploads/UV Print.webp', 'UV Print']
            ],
            inks: [
                ['uploads/Fluorescent Color Inks.webp', 'Fluorescent Color Inks'],
                ['uploads/Oil Based Inks.webp', 'Oil Based Inks'],
                ['uploads/Pantone Metallic.webp', 'Pantone Metallic'],
                ['uploads/Pantone.webp', 'Pantone'],
                ['uploads/Soy Vegetable Based Inks.webp', 'Soy Vegetable Based Inks'],
                ['uploads/Water Based Inks.webp', 'Water Based Inks']
            ],
            finishing: [
                ['uploads/Anti-scratch-Lamination-.webp', 'Anti-scratch Lamination'],
                ['uploads/Aqueous-Coating-.webp', 'Aqueous Coating'],
                ['uploads/Lamination.webp', 'Lamination'],
                ['uploads/Soft-Touch-Coating-.webp', 'Soft-Touch Coating'],
                ['uploads/Soft-Touch-Silk-Lamination-.webp', 'Soft-Touch Silk Lamination'],
                ['uploads/Spot-Gloss-UV.webp', 'Spot Gloss UV'],
                ['uploads/Spot-Gloss-UV-2.webp', 'Spot Gloss UV-2'],
                ['uploads/UV-Coating-.webp', 'UV Coating']
            ],
            addons: [
                ['uploads/corrugated-divider.webp', 'Corrugated Divider'],
                ['uploads/folding-divider.webp', 'Folding Divider'],
                ['uploads/hips-insert.webp', 'HIPS Insert'],
                ['uploads/kraft-corrugated.webp', 'Kraft Corrugated'],
                ['uploads/kraft-paperboard.webp', 'Kraft Paperboard'],
                ['uploads/petg-insert.webp', 'PETG Insert'],
                ['uploads/pvc-insert.webp', 'PVC Insert'],
                ['uploads/white-corrugated.webp', 'White Corrugated']
            ],
            additional: [
                ['uploads/blind-deboss.webp', 'Blind Debossing'],
                ['uploads/blind-embossing.webp', 'Blind Embossing'],
                ['uploads/cold-foil.webp', 'Cold Foil Printing'],
                ['uploads/combo-emboss.webp', 'Combination Embossing'],
                ['uploads/hot-foil.webp', 'Hot Foil Stamping'],
                ['uploads/registered-emboss.webp', 'Registered Embossing'],
                ['uploads/window-patch.webp', 'Window Patching']
            ]
        };

        // Preload all customization images in the background so tabs switch instantly
        window.addEventListener('load', function() {
            setTimeout(function() {
                for (let key in customizeCardSets) {
                    if (customizeCardSets.hasOwnProperty(key)) {
                        customizeCardSets[key].forEach(function(item) {
                            let img = new Image();
                            img.src = customizeUploadsUrl + item[0];
                        });
                    }
                }
            }, 500); // Start preloading half a second after page load
        });

        function setCustomizeCardOrder(option) {
            const cardSet = customizeCardSets[option] || customizeCardSets.materials;
            const cardOrder = customizeCardOrders[option] || customizeCardOrders.materials;

            customizeCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.98)';
            });

            setTimeout(() => {
                customizeCards.forEach(card => card.style.display = 'none');

                cardOrder.forEach(function(cardIndex, position) {
                    if (!cardSet[position]) return;
                    const card = customizeCards[cardIndex];
                    const [imagePath, title] = cardSet[position];
                    const image = card.querySelector('img');
                    image.src = customizeUploadsUrl + imagePath;
                    image.alt = title;
                    card.querySelector('.custom-card-title').textContent = title;
                    card.style.order = position + 1;
                    card.style.display = 'flex';
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
                    try {
                        tab.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest',
                            inline: 'center'
                        });
                    } catch (e) {
                        tab.scrollIntoView(false);
                    }
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
