@include('components.htmlboilerplate', [
    'title' => 'Search Results - The Rigid Boxes',
    'metaDescription' => 'Search results for your queried products at The Rigid Boxes.',
    'metaKeywords' => 'search, products, packaging, rigid boxes',
])

<style>
    html, body { max-width: 100%; overflow-x: clip; }

    /* Search Header Section */
    .search-hero {
        background-color: #F8F4F2;
        padding: 60px 24px;
        text-align: center;
        margin-bottom: 40px;
    }

    .search-hero h1 {
        font-family: 'Open Sans', sans-serif;
        font-size: 32px;
        font-weight: 800;
        color: #111;
        margin-bottom: 12px;
    }

    .search-hero p {
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        color: #666;
    }

    /* Popular Boxes Section (Reused from category) */
    .popular-boxes-section {
        background: #FFF;
        padding: 40px 0 80px;
    }

    .popular-boxes-inner {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
        text-align: center;
        color: #333;
    }

    .boxes-grid {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 40px 30px;
        justify-content: space-between;
    }

    .box-card {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
    }

    .box-image-wrapper {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 12px;
        overflow: hidden;
        background-color: #E8E8E8;
        margin-bottom: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        position: relative;
    }

    .box-image-wrapper img {
        width: 100%;
        height: 100%;
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
        font-family: 'DM Sans', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #222;
        text-align: center;
        word-wrap: break-word;
    }

    .no-results {
        font-family: 'DM Sans', sans-serif;
        font-size: 18px;
        color: #555;
        text-align: center;
        padding: 40px 20px;
        background-color: #fcfcfc;
        border: 1px dashed #ccc;
        border-radius: 12px;
        width: 100%;
        grid-column: 1 / -1;
    }

    /* Mobile Responsive View */
    @media (max-width: 992px) {
        .boxes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px 16px;
        }
    }

    @media (max-width: 576px) {
        .boxes-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .search-hero {
            padding: 40px 16px;
        }
        .search-hero h1 {
            font-size: 24px;
        }
    }
</style>

@include('components.header')

<main class="search-page">
    <div class="search-hero">
        <h1>Search Results</h1>
        @if(!empty($q))
            <p>Showing results for "<strong>{{ $q }}</strong>"</p>
        @else
            <p>Enter a search term to find our luxury packaging products.</p>
        @endif
    </div>

    <section class="popular-boxes-section">
        <div class="popular-boxes-inner">
            <div class="boxes-grid">
                @forelse($products as $product)
                    @php 
                        $prodSlug = $product['slug'] ?? '';
                        $prodTitle = $product['title'] ?? ($product['name'] ?? 'Custom Box');
                        
                        $pImg = '';
                        $pGalleryRaw = [];
                        if (!empty($product['images'])) {
                            $pGalleryRaw = is_string($product['images'])
                                ? (json_decode($product['images'], true) ?: [])
                                : (array) $product['images'];
                        }
                        if (!empty($product['image'])) {
                            $pImg = $product['image'];
                        } else {
                            if (!empty($pGalleryRaw) && count($pGalleryRaw) > 0) {
                                $pImg = $pGalleryRaw[0];
                            } else {
                                $pImg = 'images/placeholder.jpg';
                            }
                        }
                        
                        $pHoverImg = '';
                        if (!empty($product['hover_image'])) {
                            $pHoverImg = $product['hover_image'];
                        } elseif (count($pGalleryRaw) > 1) {
                            $pHoverImg = $pGalleryRaw[1];
                        } elseif (count($pGalleryRaw) > 0 && $pImg != $pGalleryRaw[0]) {
                            $pHoverImg = $pGalleryRaw[0];
                        } else {
                            $pHoverImg = $pImg;
                        }

                        $prodImg = \Illuminate\Support\Str::startsWith($pImg, ['storage/', 'uploads/', 'images/']) 
                            ? asset($pImg) 
                            : asset('storage/' . $pImg);
                            
                        $prodHoverImg = \Illuminate\Support\Str::startsWith($pHoverImg, ['storage/', 'uploads/', 'images/']) 
                            ? asset($pHoverImg) 
                            : asset('storage/' . $pHoverImg);
                    @endphp
                    <a href="{{ url('/' . $prodSlug) }}/" class="box-card">
                        <div class="box-image-wrapper">
                            <img src="{{ $prodImg }}" alt="{{ $prodTitle }}" class="main-img">
                            @if($prodHoverImg && $prodHoverImg !== $prodImg)
                            <img src="{{ $prodHoverImg }}" alt="{{ $prodTitle }} Hover" class="hover-img">
                            @endif
                        </div>
                        <div class="box-title">{{ $prodTitle }}</div>
                    </a>
                @empty
                    <div class="no-results">
                        @if(!empty($q))
                            We couldn't find any products matching "{{ $q }}". Try using different keywords.
                        @else
                            Please type a product name in the search bar above to begin your search.
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('components.cta')
</main>

@include('components.footer')
