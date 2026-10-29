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
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
