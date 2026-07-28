<!DOCTYPE html>
<html lang="en"><head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp"><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Blog | The Rigid Boxes</title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Open+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root{--color-primary:#8d4445;--color-primary-dark:#692f31;--color-primary-soft:#f8eeee;--color-ink:#1f1f1f;--color-copy:#333;--color-muted:#6d6d6d;--color-line:#ddd6d5;--color-page:#faf8f8;--color-surface:#fff;--font-heading:'Open Sans',sans-serif;--font-body:'DM Sans',sans-serif;--text-xs:11px;--text-sm:12px;--text-base:14px;--heading-xl:40px;--heading-lg:27px;--canvas-width:1440px;--section-width:1240px;--gutter:20px}*{box-sizing:border-box}body{margin:0;background:var(--color-page);color:var(--color-copy);font-family:var(--font-body)}a{color:inherit;text-decoration:none}button{font:inherit}img{display:block;max-width:100%}.page{width:min(100%,var(--canvas-width));margin:auto;background:var(--color-surface);overflow:hidden}.container{width:min(calc(100% - var(--gutter)*2),var(--section-width));margin:auto}.hero{height:390px;padding:0;color:var(--color-surface);background:linear-gradient(90deg,rgba(0,0,0,.82) 0%,rgba(0,0,0,.58) 42%,rgba(0,0,0,.12) 77%),url('{{ asset('images/Gift-Boxes.webp') }}') center 52%/cover,#171717}.hero .container{display:flex;align-items:center;height:100%}.hero h1{max-width:660px;margin:22px 0 0;font:700 var(--heading-xl)/1.18 var(--font-heading);letter-spacing:-.03em}.hero p{max-width:590px;margin:14px 0 0;font-size:var(--text-base);line-height:1.65;color:rgba(255,255,255,.9)}.breadcrumb{font-size:10px;font-weight:600;letter-spacing:.11em;text-transform:uppercase;color:rgba(255,255,255,.86)}.breadcrumb span{padding:0 8px;color:rgba(255,255,255,.55)}.categories{overflow:hidden;border-bottom:1px solid var(--color-line)}.category-row{display:flex;min-height:73px;align-items:center;gap:12px;overflow-x:auto;overflow-y:hidden;overscroll-behavior-x:contain;scroll-behavior:smooth;scroll-snap-type:x proximity;scrollbar-width:none}.category-row::-webkit-scrollbar{display:none}.filter{flex:0 0 calc(15.3846% - 11.08px);min-height:46px;padding:7px 14px;border:0;background:var(--color-primary-soft);color:var(--color-ink);cursor:pointer;text-align:left;font-size:var(--text-xs);font-weight:700;scroll-snap-align:start}.filter small{display:block;margin-top:4px;font-size:10px;font-weight:500}.filter.active{color:var(--color-surface);background:var(--color-primary)}.content{padding:38px 0 54px}.feature{display:grid;grid-template-columns:1.13fr .87fr;min-height:330px;margin-bottom:35px}.feature>img{width:100%;height:100%;min-height:330px;object-fit:cover;background:var(--color-primary-dark)}.feature-copy{display:flex;flex-direction:column;align-items:flex-start;justify-content:center;padding:38px 47px;border:3px solid var(--color-primary);border-left:0}.eyebrow{margin:0 0 9px;color:var(--color-primary);font-size:var(--text-xs);font-weight:700;letter-spacing:.12em;text-transform:uppercase}.feature h2{max-width:370px;margin:0;color:var(--color-ink);font:700 var(--heading-lg)/1.2 var(--font-heading);letter-spacing:-.025em}.feature p:not(.eyebrow){margin:13px 0 19px;color:var(--color-muted);font-size:var(--text-sm);line-height:1.6}.button{display:inline-flex;align-items:center;min-height:31px;padding:0 14px;border:1px solid var(--color-primary);color:var(--color-primary);background:var(--color-surface);font-size:var(--text-xs);font-weight:700}.button:hover{color:var(--color-surface);background:var(--color-primary)}.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}.card{display:flex;flex-direction:column;border:1px solid var(--color-line);background:var(--color-surface);transition:.2s}.card:hover{transform:translateY(-4px);box-shadow:0 10px 23px rgba(62,32,32,.11)}.card[hidden]{display:none}.card img{width:100%;height:170px;object-fit:cover;background:var(--color-primary-dark)}.card-copy{display:flex;flex:1;flex-direction:column;padding:14px 15px 16px}.meta{display:flex;justify-content:space-between;gap:7px;margin-bottom:8px;color:var(--color-muted);font-size:10px}.card h3{min-height:37px;margin:0;color:var(--color-ink);font:700 var(--text-base)/1.35 var(--font-heading)}.card p{margin:9px 0 13px;color:var(--color-muted);font-size:var(--text-xs);line-height:1.5}.card .button{min-height:auto;margin-top:auto;padding:0;border:0}.card .button:hover{background:transparent;color:var(--color-primary-dark);text-decoration:underline}.pages{display:flex;justify-content:center;gap:8px;margin:34px 0 47px}.pages button{display:grid;width:27px;height:27px;place-items:center;border:0;background:transparent;color:var(--color-muted);cursor:pointer}.pages .active{color:var(--color-surface);background:var(--color-primary)}.cta{display:grid;grid-template-columns:1.03fr .97fr;min-height:210px;overflow:hidden;border-radius:12px;color:var(--color-surface);background:linear-gradient(120deg,var(--color-primary-dark),var(--color-primary))}.cta img{width:100%;height:100%;object-fit:cover;opacity:.8}.cta-copy{align-self:center;padding:34px 48px;background:radial-gradient(circle at 87% 89%,rgba(255,255,255,.17) 0 15%,transparent 15.5%)}.cta h2{margin:0;font:700 20px/1.25 var(--font-heading)}.cta p{margin:10px 0 18px;font-size:var(--text-sm);line-height:1.55;color:rgba(255,255,255,.88)}.cta .button{border-color:var(--color-surface);color:var(--color-primary)}@media(max-width:1250px){:root{--gutter:28px}.hero{height:350px}}@media(max-width:900px){:root{--gutter:22px;--heading-xl:35px}.feature{grid-template-columns:1fr}.feature>img{min-height:270px}.feature-copy{border:3px solid var(--color-primary);border-top:0}.grid{grid-template-columns:repeat(2,1fr)}.cta{grid-template-columns:1fr 1fr}}@media(max-width:600px){:root{--gutter:16px;--heading-xl:29px;--heading-lg:23px}.hero{height:270px;padding:0}.hero .container{height:100%}.hero h1{margin-top:16px}.category-row{margin:0 -16px;padding:0 16px}.content{padding-top:24px}.feature>img{min-height:200px}.feature-copy{padding:24px 20px}.grid{grid-template-columns:1fr;gap:14px}.card{display:grid;grid-template-columns:42% 58%}.card img{height:100%;min-height:146px}.card-copy{padding:13px}.card h3{min-height:0}.card p{display:none}.pages{margin:27px 0 34px}.cta{grid-template-columns:1fr}.cta img{height:150px}.cta-copy{padding:27px 22px}}
</style>
<style>
/* Figma Design Overrides */
.hero {
    background-image: linear-gradient(90deg, rgba(0,0,0,.82) 0%, rgba(0,0,0,.58) 42%, rgba(0,0,0,.12) 77%), url('{{ asset('uploads/hero-home-banner.webp') }}');
    background-position: center 52%;
    background-size: cover;
}
.filter {
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.filter .filter-icon { flex: 0 0 20px; }
.page {
    background: #FAF8F8;
    overflow: visible;
    width: 100%;
    max-width: none;
}
.content { padding-bottom: 0; }
.content > .cta-section { margin-top: 15px; padding-bottom: 24px; }
.hero {
    width: 100vw;
    max-width: none;
    margin-left: calc(50% - 50vw);
}
/* Match the hero edges to every other page section at browser zoom levels. */
.hero {
    width: 100vw;
    max-width: none;
}
.hero .container {
    width: min(calc(100% - (var(--gutter) * 2)), var(--section-width));
}
/* Give the breadcrumb clearer separation from the hero title. */
.hero .container > div {
    margin-top: -40px;
}
.hero .breadcrumb {
    position: relative;
    top: -8px;
}
.hero h1 {
    margin-top: 30px;
}
/* Keep the 1440px hero contained on narrower desktop viewports. */
@media (max-width: 1255px) {
    .hero {
        width: 100vw;
        max-width: none;
        margin-left: calc(50% - 50vw);
        overflow: hidden;
    }
    .hero .container { width: min(calc(100% - (var(--gutter) * 2)), var(--section-width)); }
}
.hero h1 {
    font-family: 'Open Sans', sans-serif;
    font-weight: 700;
    font-size: 40px;
    line-height: 56px;
    letter-spacing: 0px;
    color: #FFFFFF;
}
.categories {
    max-width: var(--section-width);
    margin: 0 auto;
    overflow: hidden;
    border-bottom: 1px solid var(--color-line);
}
.category-row {
    margin-right: 0;
    padding: 20px 0;
    padding-left: 0;
    gap: 24px;
    display: flex;
    justify-content: flex-start;
    overflow-x: auto;
    scrollbar-width: none;
}
@media (max-width: 1240px) {
    .category-row {
        padding-left: var(--gutter);
        padding-right: var(--gutter);
    }
}
.category-row::-webkit-scrollbar {
    display: none;
}
.filter {
    flex: 0 0 auto;
    width: auto;
    min-width: 169px;
    height: 76px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 10px;
    border-radius: 6px;
    background: #F9F1F0; /* Light pinkish */
    color: #000000;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
    font-weight: 600;
    line-height: 22px;
    letter-spacing: 0%;
    text-align: center;
    text-transform: capitalize;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}
.filter br { display: block; }
.filter.active {
    background: var(--color-primary);
    color: #fff;
}
.filter-icon {
    width: 24px;
    height: 24px;
    object-fit: contain;
    filter: brightness(0); /* Make icon black when unselected */
}
.filter.active .filter-icon {
    filter: brightness(0) invert(1); /* Make icon white when active */
}
/* Keep the desktop composition intact when browser zoom reduces the CSS viewport. */
@media (max-width: 1240px) and (min-width: 901px) {
    /* Buttons should not shrink/crop, let them scroll horizontally */
    .category-row { gap: clamp(6px, 1.5vw, 24px); }
    .feature { min-height: 470px; }
    .feature > img { height: 470px; }
    .feature-copy { width: 47%; padding: clamp(26px, 4vw, 60px); }
    .feature h2, .cta-copy h2 { font-size: clamp(24px, 2.55vw, 32px); line-height: 1.25; }
    .feature p:not(.eyebrow), .cta-copy p { font-size: clamp(13px, 1.4vw, 16px); line-height: 1.5; }
    .cta { gap: clamp(22px, 4vw, 50px); padding-right: clamp(30px, 6vw, 80px); }
}

.content {
    padding-top: 12px;
    padding-bottom: 24px;
}

.feature {
    display: block;
    position: relative;
    min-height: 545px;
    margin-bottom: 48px;
}
.feature > img {
    width: 68%;
    height: 545px;
    object-fit: cover;
}
.feature-copy {
    position: absolute;
    top: 50%;
    right: 12px; /* Leaves room for the 12px shadow */
    transform: translateY(-50%);
    width: 44%;
    background: #fff;
    border: none;
    box-shadow: 12px 12px 0px var(--color-primary); /* Maroon drop shadow */
    padding: 60px 50px;
    z-index: 10;
}
.eyebrow {
    color: #8D4445;
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    line-height: 20px;
    letter-spacing: 1.4px;
    text-transform: uppercase;
    margin-bottom: 15px;
}
.feature h2 {
    font-family: 'Open Sans', sans-serif;
    font-size: 32px;
    font-weight: 700;
    line-height: 40px;
    letter-spacing: 0px;
    color: #000000;
    margin: 0 0 20px 0;
    max-width: 100%;
    vertical-align: middle;
}
.feature p:not(.eyebrow) {
    font-family: 'Hanken Grotesk', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    letter-spacing: 0px;
    color: #444748;
    margin: 0 0 32px 0;
    text-align: justify;
    vertical-align: middle;
}
.feature-copy .button {
    border: 1px solid var(--color-primary);
    color: var(--color-primary);
    padding: 12px 28px;
    font-weight: 600;
    border-radius: 4px;
    font-size: 14px;
    background: transparent;
    cursor: pointer;
}
.feature-copy .button:hover {
    background: var(--color-primary);
    color: #fff;
}

/* Card Grid Overrides */
.grid {
    gap: 24.5px;
}
.card {
    min-height: 444px;
    height: 100%;
    border: none;
    background: #FFFFFF;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.06);
}
.card img {
    height: 233px !important;
    width: 100%;
    object-fit: cover;
    background: transparent !important;
}
.card-copy {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.card .meta {
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    color: #444748;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
}
.card h3 {
    font-family: 'Open Sans', sans-serif;
    font-size: 20px;
    font-weight: 700;
    line-height: 26px;
    letter-spacing: 0%;
    color: #000000;
    margin: 0 0 12px 0;
    text-transform: capitalize;
}
.card p {
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    color: #444748;
    margin: 9px 0 20px 0;
    text-align: justify;
}
.card .button {
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    font-weight: 700;
    line-height: 22px;
    color: #8D4445;
    padding: 0;
    border: none;
    margin-top: auto;
    text-transform: none;
    text-align: left;
}
.card .button:hover {
    text-decoration: none;
    background: transparent;
    color: #8D4445;
}

/* Pagination Overrides */
.pages {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin: 38px 0;
}
.pages button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 0;
    background: transparent;
    color: #444748;
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 4px;
}
.pages button.active {
    background: #8D4445;
    color: #fff;
    border-radius: 4px;
}
.pages button.text-btn {
    width: auto;
    padding: 0 16px;
    font-weight: 600;
    color: #444748;
}
.pages button.dots {
    width: auto;
    padding: 0 4px;
    cursor: default;
}

@media(max-width:900px) {
    .feature > img {
        width: 100%;
        height: 300px;
    }
    .feature-copy {
        position: relative;
        top: auto;
        right: auto;
        transform: none;
        width: 90%;
        margin: -50px auto 0;
        box-shadow: 8px 8px 0px var(--color-primary);
        padding: 30px;
    }
}


@media (max-width: 900px) {
    .categories { overflow: visible; }
    .category-row { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; padding: 20px var(--gutter); overflow: visible; }
    .filter { width: 100%; min-width: 0; height: auto; min-height: 62px; flex: none; font-size: 13px; line-height: 1.25; padding: 7px; white-space: normal; }
    .filter-icon { width: 20px; height: 20px; flex: 0 0 auto; }
    .feature { min-height: auto; margin-bottom: 55px; }
    .feature > img { height: 300px; }
    .feature-copy { width: min(90%, 600px); }
}

@media (max-width: 620px) {
    .category-row { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   UNIFIED BLOG LAYOUT â€” aligned with site header
   max-width: 1280px | gutter: 55px (matches header)
   â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
html, body { overflow-x: hidden; }
.page { width: 100%; max-width: none; overflow: visible; }
.hero { width: 100%; max-width: none; margin: 0; }
.hero .container,
.categories,
.content {
    width: 100%;
    max-width: 1280px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 55px;
    padding-right: 55px;
    box-sizing: border-box;
}
.category-row { width: 100%; padding-left: 0; padding-right: 0; }
.content { padding-bottom: 0; }
.content > .cta-section { margin: 40px 0 0; padding-bottom: 24px; }
@media (max-width: 1100px) {
    .hero .container, .categories, .content { padding-left: 32px; padding-right: 32px; }
}
@media (max-width: 768px) {
    .hero .container, .categories, .content { padding-left: 20px; padding-right: 20px; }
}
@media (max-width: 600px) {
    .hero .container, .categories, .content { padding-left: 16px; padding-right: 16px; }
    .hero h1, .hero p { max-width: 100%; overflow-wrap: anywhere; word-break: normal; }
    .feature, .grid, .feature > img, .card, .card img { max-width: 100%; }
    .content > .cta-section { margin-top: 24px; }
    .breadcrumb { display: none; }
}
</style>
</head><body>
@include('components.header')
<div class="page"><main>
<section class="hero"><div class="container"><div><div class="breadcrumb">Home <span>/</span> Blog</div><h1>Insights on Luxury Packaging &amp; Design</h1><p>Expert perspectives on packaging trends, sustainable materials, unboxing strategy and brand elevation - curated for discerning B2B leaders.</p></div></div></section>
<nav class="categories" aria-label="Blog categories"><div class="category-row">
<button class="filter active" data-filter="all"><img src="{{ asset('images/blog-filter-all.svg') }}" class="filter-icon" alt=""> All</button>
<button class="filter" data-filter="packaging"><img src="{{ asset('images/blog-filter-packaging.png') }}" class="filter-icon" alt=""> Packaging Basics</button>
<button class="filter" data-filter="marketing"><img src="{{ asset('images/01 align center.png') }}" class="filter-icon" alt=""> Marketing Tips</button>
<button class="filter" data-filter="sustainability"><img src="{{ asset('images/blog-filter-sustainability.png') }}" class="filter-icon" alt=""> Sustainable Packaging Guide</button>
<button class="filter" data-filter="production"><img src="{{ asset('images/blog-filter-production.png') }}" class="filter-icon" alt=""> Production &amp; MOQ Tips</button>
<button class="filter" data-filter="design"><img src="{{ asset('images/blog-filter-design.png') }}" class="filter-icon" alt=""> Design Tips</button>
<button class="filter" data-filter="industry"><img src="{{ asset('images/blog-filter-industry.png') }}" class="filter-icon" alt=""> Industry Specific Studies</button>
</div></nav>
<section class="container content">
@php
    $featuredBlog = null;
    $displayBlogs = [
        ['title' => 'Sustainable Packaging Trends For 2026', 'blog_category' => 'packaging', 'image' => 'images/Frame 571 (1).png', 'author_name' => 'Joe Danley', 'publish_date' => '2024-11-15', 'excerpt' => 'Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable', 'slug' => 'sustainable-packaging-trends'],
    ];
    if (!empty($blogs) && count($blogs) > 0) {
        $blogsArray = json_decode(json_encode($blogs), true);
        $featuredBlog = $blogsArray[0];
        $displayBlogs = array_slice($blogsArray, 1);
    }
@endphp

@if($featuredBlog)
    @php
        $fTitle = $featuredBlog['title'] ?? '';
        $fCat = str_replace('-', ' ', $featuredBlog['blog_category'] ?? 'Category');
        $fExcerpt = $featuredBlog['excerpt'] ?? '';
        $fSlug = $featuredBlog['slug'] ?? '';
        $fImg = !empty($featuredBlog['image']) ? asset($featuredBlog['image']) : asset('images/below-hero.png');
        $fUrl = url('/blog/' . $fSlug);
    @endphp
    <article class="feature">
        <img src="{{ $fImg }}" alt="{{ $ftitle }}" onerror="this.src='{{ asset('images/below-hero.png') }}'">
        <div class="feature-copy">
            <p class="eyebrow">{{ $fCat }}</p>
            <h2><a href="{{ $fUrl }}" style="color:inherit; text-decoration:none;">{{ $fTitle }}</a></h2>
            <p>{{ Str::limit(strip_tags($fExcerpt), 150) }}</p>
            <a class="button" href="{{ $fUrl }}">Read More &rarr;</a>
        </div>
    </article>
@else
    <article class="feature"><img src="{{ asset('images/below-hero.png') }}" alt="luxury rigid boxes"><div class="feature-copy"><p class="eyebrow">Structural Integrity</p><h2><a href="{{ url('/blog-detail') }}" style="color:inherit; text-decoration:none;">The Weight of Prestige: Why Mass Matters in Rigid Construction</a></h2><p>In the realm of high-end manufacturing, the tactile sensation of gravity serves as a silent communicator of quality. We analyze the psychology of physical weight and the engineering required to achieve it.</p><a class="button" href="{{ url('/blog-detail') }}">Read More &rarr;</a></div></article>
@endif

<div class="grid">
@foreach($displayBlogs as $item)
    @php
        $item = (array) $item;
        $bTitle = $item['title'] ?? 'Sustainable Packaging Trends For 2026';
        $bCat = $item['blog_category'] ?? 'packaging';
        $bAuthor = $item['author_name'] ?? 'Joe Danley';
        $bDate = !empty($item['publish_date']) ? date('M d, Y', strtotime($item['publish_date'])) : 'Nov 15, 2024';
        $bExcerpt = $item['excerpt'] ?? 'Explore how eco-friendly rigid boxes are transforming luxury packaging with sustainable';
        $bSlug = $item['slug'] ?? 'blog-detail';
        $bImg = !empty($item['image']) ? asset($item['image']) : asset('images/Frame 571 (1).png');
        $bUrl = url('/blog/' . $bSlug);
    @endphp
    <article class="card" data-category="{{ $bCat }}">
        <img src="{{ $bImg }}" alt="{{ $btitle }}" onerror="this.src='{{ asset('images/below-hero.png') }}'">
        <div class="card-copy">
            <div class="meta">
                @if(!empty($item['author_slug']))
                    <a href="{{ url('/author/' . $item['author_slug']) }}" style="color:inherit;text-decoration:none;"><span>{{ $bAuthor }}</span></a>
                @else
                    <span>{{ $bAuthor }}</span>
                @endif
                <time>{{ $bDate }}</time>
            </div>
            <h3><a href="{{ $bUrl }}" style="color:inherit; text-decoration:none;">{{ $bTitle }}</a></h3>
            <p>{{ Str::limit(strip_tags($bExcerpt), 90) }}</p>
            <a class="button" href="{{ $bUrl }}">Read More &rarr;</a>
        </div>
    </article>
@endforeach
</div>
<style>
/* CTA Overrides */
.cta {
    display: flex;
    align-items: center;
    gap: 50px;
    background: #985555;
    border-radius: 24px;
    padding: 30px 80px 30px 30px;
    margin: 24px 0 0 0;
    color: #fff;
    min-height: 340px;
    position: relative;
    overflow: hidden;
}

.cta > img {
    width: 45%;
    height: 100%;
    min-height: 280px;
    border-radius: 16px;
    object-fit: cover;
    position: relative;
    z-index: 2;
}

/* Overlapping circles */
.cta::before {
    content: "";
    position: absolute;
    width: 269px;
    height: 269px;
    background: rgba(255, 255, 255, 0.12);
    border-radius: 50%;
    right: -60px;
    bottom: -100px;
    z-index: 1;
}

.cta::after {
    content: "";
    position: absolute;
    width: 138px;
    height: 138px;
    background: rgba(255, 255, 255, 0.12);
    border-radius: 50%;
    right: 110px;
    top: 220px;
    z-index: 1;
}

.cta-copy {
    flex: 1;
    padding: 0;
    background: none;
    align-self: center;
    max-width: 500px;
    position: relative;
    z-index: 2;
}
.cta-copy h2 {
    font-family: 'Open Sans', sans-serif;
    font-size: 32px;
    font-weight: 700;
    line-height: 135%;
    letter-spacing: 0%;
    text-transform: capitalize;
    margin: 0 0 16px 0;
}
.cta-copy p {
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 165%;
    letter-spacing: 0%;
    margin: 0 0 32px 0;
    color: #FFFFFF;
}
.cta .button {
    background: #ffffff;
    color: #000000;
    border: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    font-weight: 700;
    padding: 14px 28px;
    border-radius: 6px;
    text-transform: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}
.cta .button:hover {
    background: var(--color-primary-soft);
    color: var(--color-primary);
}
@media (max-width: 900px) {
    .cta {
        flex-direction: column;
        text-align: center;
        padding: 30px;
    }
    .cta > img {
        width: 100%;
        min-height: auto;
    }
    .cta::before {
        right: -50px;
        bottom: -100px;
    }
    .cta::after {
        right: -30px;
        top: -30px;
        transform: none;
    }
    .cta-copy {
        max-width: 100%;
    }
}
</style>
@include('components.cta')
</section>
</main></div>
<script>
// Always start the page at the left edge; category scrolling stays local to its row.
window.scrollTo(0, 0);
document.documentElement.scrollLeft = 0;
// Category Filter JS
document.querySelectorAll('.filter').forEach(f=>f.addEventListener('click',()=>{
    document.querySelectorAll('.filter').forEach(x=>x.classList.remove('active'));
    f.classList.add('active');
    document.querySelectorAll('.card').forEach(c=>c.hidden=f.dataset.filter!=='all'&&c.dataset.category!==f.dataset.filter);
    // Scroll only the category strip; never move the whole page horizontally.
    const row = f.closest('.category-row');
    if (row) {
        const targetLeft = f.offsetLeft - ((row.clientWidth - f.offsetWidth) / 2);
        row.scrollTo({left: Math.max(0, targetLeft), behavior:'smooth'});
    }
}));

// Pagination JS
const pageButtons = document.querySelectorAll('.pages button:not(.dots):not(.text-btn)');
const prevBtn = document.querySelector('.pages button.text-btn:first-child');
const nextBtn = document.querySelector('.pages button.text-btn:last-child');
let activeIndex = 0;

function updatePagination(index) {
    if(index < 0 || index >= pageButtons.length) return;
    pageButtons.forEach(btn => btn.classList.remove('active'));
    pageButtons[index].classList.add('active');
    activeIndex = index;
    // Note: Here you can add logic to actually hide/show grid items based on the page number
}

pageButtons.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        updatePagination(index);
    });
});

prevBtn.addEventListener('click', () => {
    updatePagination(activeIndex - 1);
});

nextBtn.addEventListener('click', () => {
    updatePagination(activeIndex + 1);
});
</script>
<style>
/* Figma mobile layout */
@media (max-width: 600px) {
    .hero { height: 270px; }
    .hero h1 { font-size: 28px; line-height: 1.22; margin-top: 26px; }
    .hero p { font-size: 12px; line-height: 1.55; }
    .hero .breadcrumb { top: -4px; }

    .categories { overflow: hidden; }
    .category-row {
        display: flex;
        min-height: 0;
        gap: 10px;
        margin: 0;
        padding: 14px var(--gutter);
        overflow-x: auto;
        overflow-y: hidden;
    }
    .filter {
        flex: 0 0 142px;
        width: 142px;
        min-height: 58px;
        height: 58px;
        padding: 7px 8px;
        font-size: 12px;
    }
    .filter-icon { width: 19px; height: 19px; }

    .content { padding-top: 14px; padding-bottom: 30px; }
    .feature { display: none; }
    .feature > img { height: 150px; min-height: 0; }
    .feature-copy { width: calc(100% - 28px); margin-top: -28px; padding: 22px 18px; box-shadow: 6px 6px 0 var(--color-primary); }
    .eyebrow { margin-bottom: 8px; font-size: 11px; line-height: 1.3; }
    .feature h2 { margin-bottom: 10px; font-size: 22px; line-height: 1.27; }
    .feature p:not(.eyebrow) { margin-bottom: 18px; font-size: 13px; line-height: 1.5; text-align: left; }
    .feature-copy .button { padding: 9px 16px; font-size: 12px; }

    .grid { grid-template-columns: 1fr; gap: 14px; }
    .card { display: flex; min-height: 0; border-radius: 8px; }
    .card img { width: 100%; height: 128px !important; min-height: 0; }
    .card-copy { padding: 13px 14px 15px; }
    .card .meta { margin-bottom: 8px; font-size: 11px; }
    .card h3 { min-height: 0; margin-bottom: 8px; font-size: 16px; line-height: 1.3; }
    .card p { display: block; margin: 0 0 12px; font-size: 13px; line-height: 1.45; text-align: left; }
    .card .button { font-size: 13px; line-height: 1.3; }
    .pages { gap: 3px; margin: 26px 0; }
    .pages button { width: 32px; height: 32px; font-size: 12px; }
    .pages button.text-btn { padding: 0 7px; }

    .cta { gap: 16px; min-height: 0; margin: 24px 0; padding: 16px; border-radius: 12px; text-align: left; }
    .cta > img { width: 100%; min-height: 130px; border-radius: 8px; }
    .cta-copy h2 { margin-bottom: 10px; font-size: 22px; line-height: 1.3; }
    .cta-copy p { margin-bottom: 16px; font-size: 13px; line-height: 1.5; }
    .cta .button { padding: 10px 16px; font-size: 13px; }
}
</style>
@include('components.footer')
</body></html>

