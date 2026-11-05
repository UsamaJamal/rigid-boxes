{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach ($urls as $item)
@if (!empty($item['images']) && count($item['images']) > 0)
    <url>
        <loc>{{ $item['loc'] }}</loc>
@if (!empty($item['lastmod']))
        <lastmod>{{ $item['lastmod'] }}</lastmod>
@endif
@foreach ($item['images'] as $img)
        <image:image>
            <image:loc>{{ $img['loc'] }}</image:loc>
@if (!empty($img['title']))
            <image:title><![CDATA[{{ $img['title'] }}]]></image:title>
@endif
@if (!empty($img['caption']))
            <image:caption><![CDATA[{{ $img['caption'] }}]]></image:caption>
@endif
        </image:image>
@endforeach
    </url>
@endif
@endforeach
</urlset>

