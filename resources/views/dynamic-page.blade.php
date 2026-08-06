@php
    $title = $page['meta_title'] ?? $page['title'];
    $metaDescription = $page['meta_description'] ?? null;
    $metaKeywords = $page['meta_keywords'] ?? null;
    $robots = $page['robots'] ?? 'index,follow';
@endphp
@include('components.htmlboilerplate', ['title' => $title, 'metaDescription' => $metaDescription, 'metaKeywords' => $metaKeywords, 'robots' => $robots])
<style>
    .dynamic-hero {
        background-color: #ffffff;
        padding: 40px 24px 30px;
        text-align: center;
        border-bottom: 1px solid #eaeaea;
        font-family: 'DM Sans', sans-serif;
    }
    .dynamic-hero h1 {
        font-family: 'Open Sans', sans-serif;
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 0px;
        color: var(--section-text-color, #111);
    }
    .dynamic-breadcrumb {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        color: var(--section-text-color, #111);
        text-align: left;
        max-width: var(--site-container-width, 1280px);
        margin: 0 auto 20px auto;
        padding: 0 var(--site-container-gutter, 55px);
        font-family: 'Open Sans', sans-serif;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dynamic-breadcrumb span {
        font-weight: 700;
        color: var(--section-text-color, #111);
    }
    .dynamic-container {
        max-width: var(--site-container-width, 1000px);
        margin: 30px auto 60px auto;
        padding: 0 var(--site-container-gutter, 55px);
        font-family: 'DM Sans', sans-serif;
        color: #333;
        line-height: 1.8;
        font-size: 16px;
    }
    .dynamic-container h2, .dynamic-container h3, .dynamic-container h4, .dynamic-container h5, .dynamic-container h6 {
        font-family: 'Open Sans', sans-serif;
        color: #111;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .dynamic-container p {
        margin-bottom: 20px;
        color: #444;
    }
    .dynamic-container ul, .dynamic-container ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }
    .dynamic-container li {
        margin-bottom: 10px;
    }
    .dynamic-container a {
        color: var(--primary-color, #8D4445);
        text-decoration: none;
    }
    .dynamic-container a:hover {
        text-decoration: underline;
    }
    .dynamic-container img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    @media (max-width: 767px) {
        .dynamic-hero h1 {
            font-size: 28px;
        }
        .dynamic-breadcrumb {
            display: none;
        }
        .dynamic-container {
            margin: 30px auto;
            padding: 0 20px;
        }
    }
</style>

<main class="dynamic-page">
    @include('components.header')
    
    <div class="dynamic-hero">
        <div class="dynamic-breadcrumb">
            HOME / <span>{{ strtoupper($page['title']) }}</span>
        </div>
        <h1>{{ $page['heading'] ?? $page['title'] }}</h1>
    </div>

    <div class="dynamic-container">
        {!! $page['content'] !!}
    </div>

    @include('components.cta')
    @include('components.footer')
</main>
