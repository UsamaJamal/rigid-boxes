@php
    $canonicalPath = trim(request()->path(), '/');
    $canonicalUrl = $canonicalPath === ''
        ? rtrim(url('/'), '/')
        : rtrim(url('/' . $canonicalPath), '/') . '/';
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}">
@include('components.schemas')
