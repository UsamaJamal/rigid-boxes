@php
    $schemaSiteUrl = rtrim(url('/'), '/');
    $schemaPath = trim(request()->path(), '/');
    $schemaPageUrl = $canonicalUrl ?? (
        $schemaPath === ''
            ? $schemaSiteUrl
            : (strtolower($schemaPath) === 'sitemap.xml'
                ? rtrim(url('/sitemap.xml'), '/')
                : rtrim(url('/' . $schemaPath), '/') . '/')
    );
    $schemaLogo = asset('uploads/logo-rigid-boxes.svg');
    $schemaSettings = $siteSettings ?? [];

    $schemaImageUrl = function ($path) {
        if (empty($path)) {
            return null;
        }
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        $path = ltrim($path, '/');
        if (\Illuminate\Support\Str::startsWith($path, ['storage/', 'images/'])) {
            return asset($path);
        }
        if (\Illuminate\Support\Str::startsWith($path, 'uploads/')) {
            return file_exists(public_path($path))
                ? asset($path)
                : asset('storage/' . $path);
        }
        return asset('storage/' . $path);
    };

    $schemaProduct = isset($product) ? (array) $product : [];
    $schemaCategory = isset($category) ? (array) $category : [];
    $schemaBlog = isset($blog) ? (array) $blog : [];
    $schemaAuthor = isset($author) ? (array) $author : [];

    $schemaPageName = $title
        ?? ($schemaProduct['meta_title'] ?? $schemaProduct['title'] ?? null)
        ?? ($schemaCategory['meta_title'] ?? $schemaCategory['title'] ?? null)
        ?? ($schemaBlog['meta_title'] ?? $schemaBlog['title'] ?? null)
        ?? ($schemaAuthor['title'] ?? null)
        ?? (($settings ?? [])['meta_title'] ?? null)
        ?? (trim(request()->path(), '/') === ''
            ? 'The Rigid Boxes'
            : ucwords(str_replace(['-', '/'], [' ', ' - '], trim(request()->path(), '/'))));

    $schemaPageDescription = $metaDescription
        ?? ($schemaProduct['meta_description'] ?? $schemaProduct['description'] ?? null)
        ?? ($schemaCategory['meta_description'] ?? $schemaCategory['description'] ?? null)
        ?? ($schemaBlog['meta_description'] ?? $schemaBlog['excerpt'] ?? null)
        ?? (($settings ?? [])['meta_description'] ?? null)
        ?? 'Custom rigid boxes and premium packaging solutions designed for brands and products.';
    $schemaPageDescription = trim(strip_tags((string) $schemaPageDescription));

    $schemaAddress = trim(preg_replace('/\s+/', ' ', strip_tags(str_replace(
        ['<br>', '<br/>', '<br />'],
        ' ',
        $schemaSettings['company_address'] ?? ''
    ))));

    $schemaOrganizationId = $schemaSiteUrl . '#organization';
    $schemaBusinessId = $schemaSiteUrl . '#localbusiness';
    $schemaWebsiteId = $schemaSiteUrl . '#website';
    $schemaWebPageId = $schemaPageUrl . '#webpage';

    $schemaGraph = [
        [
            '@type' => 'Organization',
            '@id' => $schemaOrganizationId,
            'name' => 'The Rigid Boxes',
            'url' => $schemaSiteUrl,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $schemaLogo,
            ],
            'description' => 'Custom rigid box and premium packaging manufacturer.',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $schemaSettings['company_phone'] ?? '',
                'email' => $schemaSettings['company_email'] ?? '',
                'contactType' => 'customer service',
                'availableLanguage' => 'English',
            ],
        ],
        [
            '@type' => 'LocalBusiness',
            '@id' => $schemaBusinessId,
            'name' => 'The Rigid Boxes',
            'url' => $schemaSiteUrl,
            'logo' => $schemaLogo,
            'image' => asset('uploads/Home-Banner.webp'),
            'description' => 'Custom rigid boxes and premium packaging solutions for businesses.',
            'telephone' => $schemaSettings['company_phone'] ?? '',
            'email' => $schemaSettings['company_email'] ?? '',
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $schemaAddress,
                'addressCountry' => 'US',
            ],
            'parentOrganization' => ['@id' => $schemaOrganizationId],
        ],
        [
            '@type' => 'WebSite',
            '@id' => $schemaWebsiteId,
            'url' => $schemaSiteUrl,
            'name' => 'The Rigid Boxes',
            'publisher' => ['@id' => $schemaOrganizationId],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $schemaSiteUrl . '/search?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ],
    ];

    $schemaWebPageType = 'WebPage';
    if (request()->is('contact-us')) {
        $schemaWebPageType = 'ContactPage';
    } elseif (request()->is('about-us')) {
        $schemaWebPageType = 'AboutPage';
    } elseif (request()->is('search')) {
        $schemaWebPageType = 'SearchResultsPage';
    } elseif (
        request()->is('blog') ||
        request()->is('categories') ||
        request()->is('box-by-*') ||
        request()->is('category') ||
        request()->is('category/*')
    ) {
        $schemaWebPageType = 'CollectionPage';
    } elseif (!empty($schemaAuthor)) {
        $schemaWebPageType = 'ProfilePage';
    }

    $schemaWebPageIndex = count($schemaGraph);
    $schemaGraph[] = [
        '@type' => $schemaWebPageType,
        '@id' => $schemaWebPageId,
        'url' => $schemaPageUrl,
        'name' => trim(strip_tags((string) $schemaPageName)),
        'description' => $schemaPageDescription,
        'isPartOf' => ['@id' => $schemaWebsiteId],
        'about' => ['@id' => $schemaBusinessId],
    ];

    $schemaBreadcrumbs = [[
        '@type' => 'ListItem',
        'position' => 1,
        'name' => 'Home',
        'item' => $schemaSiteUrl,
    ]];
    if (trim(request()->path(), '/') !== '') {
        $schemaBreadcrumbs[] = [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => trim(strip_tags((string) $schemaPageName)),
            'item' => $schemaPageUrl,
        ];
    }
    $schemaGraph[] = [
        '@type' => 'BreadcrumbList',
        '@id' => $schemaPageUrl . '#breadcrumb',
        'itemListElement' => $schemaBreadcrumbs,
    ];

    $schemaFaqs = [];
    if (!empty($faqs) && is_iterable($faqs)) {
        $schemaFaqs = $faqs;
    } elseif (!empty(($settings ?? [])['faqs'])) {
        $schemaFaqs = $settings['faqs'];
    }
    $schemaFaqEntities = collect($schemaFaqs)
        ->map(fn ($faq) => (array) $faq)
        ->filter(fn ($faq) => !empty(trim($faq['question'] ?? '')) && !empty(trim($faq['answer'] ?? '')))
        ->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => trim(strip_tags($faq['question'])),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => trim(strip_tags($faq['answer'])),
            ],
        ])
        ->values()
        ->all();
    if (!empty($schemaFaqEntities)) {
        $schemaGraph[] = [
            '@type' => 'FAQPage',
            '@id' => $schemaPageUrl . '#faq',
            'mainEntity' => $schemaFaqEntities,
        ];
    }

    if ($schemaWebPageType === 'CollectionPage') {
        $schemaCollectionRows = [];
        $schemaCollectionKind = null;
        if (request()->is('blog') && !empty($blogs)) {
            $schemaCollectionRows = $blogs;
            $schemaCollectionKind = 'blog';
        } elseif (!empty($products)) {
            $schemaCollectionRows = $products;
            $schemaCollectionKind = 'product';
        } elseif (!empty($categories)) {
            $schemaCollectionRows = $categories;
            $schemaCollectionKind = 'category';
        }

        $schemaListItems = collect($schemaCollectionRows)
            ->take(20)
            ->map(function ($row, $index) use ($schemaCollectionKind) {
                $row = (array) $row;
                $slug = trim($row['slug'] ?? '', '/');
                if ($slug === '') {
                    return null;
                }
                if ($schemaCollectionKind === 'blog') {
                    $itemUrl = url('/blog/' . $slug) . '/';
                } elseif ($schemaCollectionKind === 'product') {
                    $itemUrl = url('/' . $slug) . '/';
                } else {
                    $itemUrl = url('/' . $slug) . '/';
                }
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => trim(strip_tags($row['title'] ?? '')),
                    'url' => $itemUrl,
                ];
            })
            ->filter()
            ->values()
            ->all();

        if (!empty($schemaListItems)) {
            $schemaItemListId = $schemaPageUrl . '#itemlist';
            $schemaGraph[] = [
                '@type' => 'ItemList',
                '@id' => $schemaItemListId,
                'name' => trim(strip_tags((string) $schemaPageName)),
                'itemListElement' => $schemaListItems,
            ];
            $schemaGraph[$schemaWebPageIndex]['mainEntity'] = ['@id' => $schemaItemListId];
        }
    }

    if (!empty($schemaProduct)) {
        $schemaProductImages = [];
        if ($schemaProductImage = $schemaImageUrl($schemaProduct['image'] ?? null)) {
            $schemaProductImages[] = $schemaProductImage;
        }
        $schemaGallery = is_string($schemaProduct['images'] ?? null)
            ? (json_decode($schemaProduct['images'], true) ?: [])
            : (array) ($schemaProduct['images'] ?? []);
        foreach ($schemaGallery as $schemaGalleryImage) {
            if ($schemaResolvedImage = $schemaImageUrl($schemaGalleryImage)) {
                $schemaProductImages[] = $schemaResolvedImage;
            }
        }

        $schemaGraph[] = array_filter([
            '@type' => 'Product',
            '@id' => $schemaPageUrl . '#product',
            'name' => $schemaProduct['title'] ?? $schemaPageName,
            'url' => $schemaPageUrl,
            'image' => array_values(array_unique($schemaProductImages)),
            'description' => trim(strip_tags(
                $schemaProduct['meta_description']
                ?? $schemaProduct['long_description']
                ?? $schemaProduct['description']
                ?? ''
            )),
            'sku' => !empty($schemaProduct['id']) ? (string) $schemaProduct['id'] : null,
            'brand' => [
                '@type' => 'Brand',
                'name' => 'The Rigid Boxes',
            ],
            'mainEntityOfPage' => ['@id' => $schemaWebPageId],
        ], fn ($value) => $value !== null && $value !== '' && $value !== []);
    }

    if (!empty($schemaBlog)) {
        $schemaBlogAuthor = $schemaBlog['joined_author_name']
            ?? $schemaBlog['author_name']
            ?? 'The Rigid Boxes';
        $schemaGraph[] = array_filter([
            '@type' => 'BlogPosting',
            '@id' => $schemaPageUrl . '#article',
            'headline' => $schemaBlog['title'] ?? $schemaPageName,
            'description' => trim(strip_tags(
                $schemaBlog['meta_description']
                ?? $schemaBlog['excerpt']
                ?? $schemaBlog['content']
                ?? ''
            )),
            'image' => $schemaImageUrl($schemaBlog['image'] ?? null),
            'datePublished' => $schemaBlog['publish_date'] ?? $schemaBlog['created_at'] ?? null,
            'dateModified' => $schemaBlog['updated_at'] ?? $schemaBlog['publish_date'] ?? null,
            'author' => [
                '@type' => !empty($schemaBlog['joined_author_name']) ? 'Person' : 'Organization',
                'name' => $schemaBlogAuthor,
            ],
            'publisher' => ['@id' => $schemaOrganizationId],
            'mainEntityOfPage' => ['@id' => $schemaWebPageId],
        ], fn ($value) => $value !== null && $value !== '');
    }

    if (!empty($schemaAuthor)) {
        $schemaPersonId = $schemaPageUrl . '#person';
        $schemaGraph[] = array_filter([
            '@type' => 'Person',
            '@id' => $schemaPersonId,
            'name' => $schemaAuthor['title'] ?? $schemaPageName,
            'url' => $schemaPageUrl,
            'image' => $schemaImageUrl($schemaAuthor['image'] ?? null),
            'description' => trim(strip_tags($schemaAuthor['description'] ?? '')),
            'worksFor' => ['@id' => $schemaOrganizationId],
        ], fn ($value) => $value !== null && $value !== '');
        $schemaGraph[$schemaWebPageIndex]['mainEntity'] = ['@id' => $schemaPersonId];
    }

    $schemaPayload = [
        '@context' => 'https://schema.org',
        '@graph' => $schemaGraph,
    ];

    $schemaCustomRaw = $schemaProduct['schema']
        ?? $schemaCategory['schema']
        ?? $schemaBlog['schema']
        ?? (($settings ?? [])['schema'] ?? null)
        ?? ($schema ?? null);
    $schemaCustomPayload = null;

    if (is_array($schemaCustomRaw)) {
        $schemaCustomPayload = $schemaCustomRaw;
    } elseif (is_string($schemaCustomRaw) && trim($schemaCustomRaw) !== '') {
        $schemaCustomDecoded = json_decode($schemaCustomRaw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($schemaCustomDecoded)) {
            $schemaCustomPayload = $schemaCustomDecoded;
        }
    }
@endphp
@if($schemaCustomPayload === null)
<script type="application/ld+json">
{!! json_encode(
    $schemaPayload,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>
@endif
@if($schemaCustomPayload !== null)
<script type="application/ld+json">
{!! json_encode(
    $schemaCustomPayload,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>
@endif
