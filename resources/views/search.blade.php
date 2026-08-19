@include('components.htmlboilerplate', [
    'title' => 'Search Results',
    'metaDescription' => 'Search results for your queried products at The Rigid Boxes.',
    'metaKeywords' => 'search, products, packaging, rigid boxes',
])

<style>
    html, body { max-width: 100%; overflow-x: clip; background-color: #F6F8FA; } /* Light background for the whole page */

    .search-page-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 24px;
        font-family: 'DM Sans', sans-serif;
    }

    /* Overall Summary Bar */
    .search-summary-bar {
        background-color: #FFF;
        border-radius: 12px;
        padding: 24px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        margin-bottom: 30px;
    }

    .search-summary-text {
        font-size: 16px;
        color: #555;
    }

    .search-summary-text strong {
        color: #222;
        font-weight: 700;
    }

    .search-summary-badge {
        background-color: var(--primary-color);
        color: #FFF;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    /* Section Styles */
    .search-section {
        background-color: #FFF;
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        margin-bottom: 30px;
    }

    .search-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #EAEAEA;
        padding-bottom: 16px;
        margin-bottom: 24px;
    }

    .search-section-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-section-icon {
        width: 40px;
        height: 40px;
        background-color: var(--primary-color);
        color: #FFF;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-section-icon svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }

    .search-section-title {
        font-size: 20px;
        font-weight: 700;
        color: #222;
    }

    .search-section-title em {
        color: var(--primary-color);
        font-style: italic;
    }

    .search-section-badge {
        background-color: #F0F4F8; /* Light gray-blue */
        color: var(--primary-color);
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .search-section-info {
        font-size: 14px;
        color: #777;
        margin-bottom: 24px;
    }

    /* Grid for items */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px;
    }

    .item-card {
        display: flex;
        flex-direction: column;
        text-decoration: none;
        background: #FFF;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #F0F0F0;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .item-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .item-image-wrapper {
        width: 100%;
        aspect-ratio: 1;
        background-color: #F9F9F9;
        position: relative;
        overflow: hidden;
    }

    .item-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 16px;
    }

    .item-title {
        font-size: 15px;
        font-weight: 600;
        color: #222;
        padding: 16px;
        text-align: center;
    }

    /* Blogs list */
    .blog-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .blog-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        text-decoration: none;
        padding: 16px;
        border: 1px solid #F0F0F0;
        border-radius: 8px;
        transition: background-color 0.2s;
    }

    .blog-item:hover {
        background-color: #FAFAFA;
    }

    .blog-item-img {
        width: 120px;
        height: 80px;
        border-radius: 6px;
        object-fit: cover;
        background-color: #EEE;
    }

    .blog-item-content {
        flex: 1;
    }

    .blog-item-title {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        margin-bottom: 6px;
    }

    .blog-item-excerpt {
        font-size: 14px;
        color: #666;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .no-results {
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        color: #555;
        text-align: center;
        padding: 60px 20px;
    }

    @media (max-width: 992px) {
        .items-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .items-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .search-summary-bar {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }
        .search-section-header {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }
        .blog-item {
            flex-direction: column;
        }
        .blog-item-img {
            width: 100%;
            height: auto;
            aspect-ratio: 16/9;
        }
    }

    @media (max-width: 480px) {
        .items-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@include('components.header')

<main class="search-page-container">

    @if(!empty($q))
        <div class="search-summary-bar">
            <div class="search-summary-text">
                Search results for: <strong>"{{ $q }}"</strong> — We have found <strong>{{ $totalCount }}</strong> result(s)
            </div>
            <div class="search-summary-badge">
                {{ $totalCount }} Results
            </div>
        </div>

        @if($totalCount == 0)
            <div class="no-results">
                <svg viewBox="0 0 24 24" style="width: 64px; height: 64px; fill: #CCC; margin-bottom: 16px; display: block; margin: 0 auto 16px;">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                We couldn't find any results matching "<strong>{{ $q }}</strong>". Try using different keywords.
            </div>
        @else
            
            {{-- CATEGORIES SECTION --}}
            @if(count($categories) > 0)
                <section class="search-section">
                    <div class="search-section-header">
                        <div class="search-section-title-wrapper">
                            <div class="search-section-icon">
                                <svg viewBox="0 0 24 24"><path d="M4 11h5V5H4v6zm0 7h5v-6H4v6zm6 0h5v-6h-5v6zm6 0h5v-6h-5v6zm-6-7h5V5h-5v6zm6-6v6h5V5h-5z"/></svg>
                            </div>
                            <div class="search-section-title">
                                Search Results For <em>"{{ ucfirst($q) }} In Categories"</em>
                            </div>
                        </div>
                        <div class="search-section-badge">
                            {{ count($categories) }} Found
                        </div>
                    </div>
                    <div class="search-section-info">
                        We have found {{ count($categories) }} category result(s) with your query "{{ $q }}"
                    </div>
                    <div class="items-grid">
                        @foreach($categories as $category)
                            @php
                                $cImg = !empty($category['image']) ? $category['image'] : 'images/placeholder.jpg';
                                $cImgUrl = \Illuminate\Support\Str::startsWith($cImg, ['storage/', 'uploads/', 'images/']) ? asset($cImg) : asset('storage/' . $cImg);
                            @endphp
                            <a href="{{ url('/' . $category['slug']) }}/" class="item-card">
                                <div class="item-image-wrapper">
                                    <img src="{{ $cImgUrl }}" alt="{{ $category['title'] }}">
                                </div>
                                <div class="item-title">{{ $category['title'] }}</div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- PRODUCTS SECTION --}}
            @if(count($products) > 0)
                <section class="search-section">
                    <div class="search-section-header">
                        <div class="search-section-title-wrapper">
                            <div class="search-section-icon">
                                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg>
                            </div>
                            <div class="search-section-title">
                                Search Results For <em>"{{ ucfirst($q) }} In Products"</em>
                            </div>
                        </div>
                        <div class="search-section-badge">
                            {{ count($products) }} Found
                        </div>
                    </div>
                    <div class="search-section-info">
                        We have found {{ count($products) }} product result(s) with your query "{{ $q }}"
                    </div>
                    <div class="items-grid">
                        @foreach($products as $product)
                            @php
                                $pGalleryRaw = [];
                                if (!empty($product['images'])) {
                                    $pGalleryRaw = is_string($product['images']) ? (json_decode($product['images'], true) ?: []) : (array) $product['images'];
                                }
                                $pImg = !empty($product['image']) ? $product['image'] : (!empty($pGalleryRaw) ? $pGalleryRaw[0] : 'images/placeholder.jpg');
                                $pImgUrl = \Illuminate\Support\Str::startsWith($pImg, ['storage/', 'uploads/', 'images/']) ? asset($pImg) : asset('storage/' . $pImg);
                            @endphp
                            <a href="{{ url('/' . $product['slug']) }}/" class="item-card">
                                <div class="item-image-wrapper">
                                    <img src="{{ $pImgUrl }}" alt="{{ $product['title'] }}">
                                </div>
                                <div class="item-title">{{ $product['title'] }}</div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- BLOGS SECTION --}}
            @if(count($blogs) > 0)
                <section class="search-section">
                    <div class="search-section-header">
                        <div class="search-section-title-wrapper">
                            <div class="search-section-icon">
                                <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                            </div>
                            <div class="search-section-title">
                                Search Results For <em>"{{ ucfirst($q) }} In Blogs"</em>
                            </div>
                        </div>
                        <div class="search-section-badge">
                            {{ count($blogs) }} Found
                        </div>
                    </div>
                    <div class="search-section-info">
                        We have found {{ count($blogs) }} blog result(s) with your query "{{ $q }}"
                    </div>
                    <div class="blog-list">
                        @foreach($blogs as $blog)
                            @php
                                $bImg = !empty($blog['image']) ? $blog['image'] : 'images/placeholder.jpg';
                                $bImgUrl = \Illuminate\Support\Str::startsWith($bImg, ['storage/', 'uploads/', 'images/']) ? asset($bImg) : asset('storage/' . $bImg);
                            @endphp
                            <a href="{{ url('/blog/' . $blog['slug']) }}/" class="blog-item">
                                <img src="{{ $bImgUrl }}" alt="{{ $blog['title'] }}" class="blog-item-img">
                                <div class="blog-item-content">
                                    <div class="blog-item-title">{{ $blog['title'] }}</div>
                                    <div class="blog-item-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($blog['content'] ?? ''), 120) }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

        @endif
    @else
        <div class="no-results" style="background: #FFF; border-radius: 12px; margin-top: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
            <svg viewBox="0 0 24 24" style="width: 64px; height: 64px; fill: #CCC; margin-bottom: 16px; display: block; margin: 0 auto 16px;">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
            Please type a keyword in the search bar above to begin your search.
        </div>
    @endif

</main>

@include('components.footer')
