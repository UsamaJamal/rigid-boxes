{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach ($urls as $item)
    <url>
        <loc>{{ $item['loc'] }}</loc>
@if (!empty($item['lastmod']))
        <lastmod>{{ $item['lastmod'] }}</lastmod>
@endif
@if (!empty($item['changefreq']))
        <changefreq>{{ $item['changefreq'] }}</changefreq>
@endif
@foreach ($item['images'] as $img)
        <image:image>
            <image:loc>{{ str_replace(' ', '%20', $img['loc']) }}</image:loc>
@if (!empty($img['title']))
            <image:title>{{ $img['title'] }}</image:title>
@endif
        </image:image>
@endforeach
    </url>
@endforeach
</urlset>
