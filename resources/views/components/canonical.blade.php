@php
    $canonicalPath = trim(request()->path(), '/');
    if ($canonicalPath === '') {
        $canonicalUrl = rtrim(url('/'), '/');
    } elseif (strtolower($canonicalPath) === 'sitemap.xml') {
        $canonicalUrl = rtrim(url('/sitemap.xml'), '/');
    } else {
        $canonicalUrl = rtrim(url('/' . $canonicalPath), '/') . '/';
    }

    $siteMetaName = 'The Rigid Boxes';
    $pageAuthorName = $siteMetaName;
    if (!empty($blog ?? null)) {
        $schemaBlogMeta = (array) $blog;
        $pageAuthorName = trim((string) ($schemaBlogMeta['joined_author_name'] ?? $schemaBlogMeta['author_name'] ?? '')) ?: $siteMetaName;
    } elseif (!empty($author ?? null)) {
        $schemaAuthorMeta = (array) $author;
        $pageAuthorName = trim((string) ($schemaAuthorMeta['title'] ?? '')) ?: $siteMetaName;
    }

    $socialRecord = !empty($blog ?? null) ? (array) $blog : (!empty($product ?? null) ? (array) $product : (!empty($category ?? null) ? (array) $category : []));
    $socialTitle = trim((string) ($title ?? $socialRecord['meta_title'] ?? $socialRecord['title'] ?? ($author['title'] ?? null) ?? $siteMetaName)) ?: $siteMetaName;
    $socialDescriptionSource = $metaDescription ?? $socialRecord['meta_description'] ?? $socialRecord['excerpt'] ?? $socialRecord['description'] ?? $socialRecord['content'] ?? '';
    $socialDescription = preg_replace('/\s+/', ' ', trim(strip_tags(html_entity_decode((string) $socialDescriptionSource))));
    $socialDescription = $socialDescription ?: 'Custom rigid boxes and premium packaging solutions from The Rigid Boxes.';
    $socialImagePath = $socialRecord['image'] ?? $socialRecord['hero_image'] ?? $socialRecord['banner_image'] ?? 'uploads/Home-Banner.webp';
    $socialImage = \Illuminate\Support\Str::startsWith($socialImagePath, ['http://', 'https://'])
        ? $socialImagePath
        : asset(ltrim($socialImagePath, '/'));
    $socialType = !empty($blog ?? null) ? 'article' : 'website';
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}">
<meta name="theme-color" content="#8D4445">
<meta name="author" content="{{ $pageAuthorName }}">
<meta name="publisher" content="{{ $siteMetaName }}">
<meta property="og:type" content="{{ $socialType }}">
<meta property="og:site_name" content="{{ $siteMetaName }}">
<meta property="og:title" content="{{ $socialTitle }}">
<meta property="og:description" content="{{ $socialDescription }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $socialImage }}">
<meta property="og:image:alt" content="{{ $socialTitle }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $socialTitle }}">
<meta name="twitter:description" content="{{ $socialDescription }}">
<meta name="twitter:image" content="{{ $socialImage }}">
<!-- Google tag (gtag.js) -->
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-5VLT0GNXMD');
    (function() {
        var gtmLoaded = false;
        function loadGTM() {
            if (gtmLoaded) return;
            gtmLoaded = true;
            var s = document.createElement('script');
            s.async = true;
            s.src = 'https://www.googletagmanager.com/gtag/js?id=G-5VLT0GNXMD';
            document.head.appendChild(s);
        }
        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(function() { setTimeout(loadGTM, 5000); });
        } else {
            window.addEventListener('load', function() { setTimeout(loadGTM, 5000); });
        }
        ['scroll', 'touchstart', 'mousemove', 'keydown'].forEach(function(e) {
            window.addEventListener(e, loadGTM, { once: true, passive: true });
        });
    })();
</script>
<script>
    if (window.location.pathname === '/public' || window.location.pathname.startsWith('/public/')) {
        window.history.replaceState(
            null,
            document.title,
            (window.location.pathname.replace(/^\/public(?=\/|$)/, '') || '/')
                + window.location.search
                + window.location.hash
        );
    }
</script>
@include('components.schemas')
<link rel="preload" href="{{ asset('css/footer.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="{{ asset('css/footer.min.css') }}"></noscript>
<style>
    .sr-only {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        white-space: nowrap !important;
        border: 0 !important;
    }
    /* Keep paragraph copy consistent across all public pages on desktop. */
    @media (min-width: 769px) {
        p {
            font-size: 16px !important;
        }
    }

    @media (max-width: 768px) {
        p {
            font-size: 16px !important;
        }
    }
</style>
