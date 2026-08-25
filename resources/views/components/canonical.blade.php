@php
    $canonicalPath = trim(request()->path(), '/');
    if ($canonicalPath === '') {
        $canonicalUrl = rtrim(url('/'), '/');
    } elseif (strtolower($canonicalPath) === 'sitemap.xml') {
        $canonicalUrl = rtrim(url('/sitemap.xml'), '/');
    } else {
        $canonicalUrl = rtrim(url('/' . $canonicalPath), '/') . '/';
    }
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}">
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
