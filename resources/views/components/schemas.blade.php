
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

    $schemaGraph = [];
    // LocalBusiness schema belongs to site and commerce pages, not individual blog posts.
    if (empty($schemaBlog)) {
        $schemaGraph[] = [
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
        ];
    }

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

    $schemaFaqs = [];
    if (!empty($faqs) && is_iterable($faqs)) {
        $schemaFaqs = $faqs;
    } elseif (!empty(($settings ?? [])['faqs']) && is_iterable($settings['faqs'])) {
        $schemaFaqs = $settings['faqs'];
    } elseif (!empty(($settings ?? [])['faq_page_sections']) && is_iterable($settings['faq_page_sections'])) {
        foreach ($settings['faq_page_sections'] as $faqSection) {
            $faqSectionArr = (array) $faqSection;
            if (!empty($faqSectionArr['faqs']) && is_iterable($faqSectionArr['faqs'])) {
                foreach ($faqSectionArr['faqs'] as $sectionFaq) {
                    $schemaFaqs[] = $sectionFaq;
                }
            }
        }
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

    if (!empty($schemaCategory) && !empty($products)) {
        $schemaListItems = collect($products)
            ->take(20)
            ->map(function ($row, $index) {
                $row = (array) $row;
                $slug = trim($row['slug'] ?? '', '/');
                if ($slug === '') {
                    return null;
                }
                $itemUrl = url('/' . $slug) . '/';
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
                'description' => $schemaPageDescription,
                'url' => $schemaPageUrl,
                'itemListOrder' => 'https://schema.org/ItemListOrderAscending',
                'numberOfItems' => count($schemaListItems),
                'itemListElement' => $schemaListItems,
            ];
            // WebPage schema removed, skip mainEntity addition
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

        // Rating, review count and price come from the product's admin fields.
        $schemaRating = (float) ($schemaProduct['rating_value'] ?? 0);
        $schemaReviews = (int) ($schemaProduct['review_count'] ?? 0);
        $schemaPrice = (float) ($schemaProduct['price'] ?? 0);

        $schemaAggregateRating = ($schemaRating > 0 && $schemaReviews > 0) ? [
            '@type' => 'AggregateRating',
            'ratingValue' => rtrim(rtrim(number_format($schemaRating, 1, '.', ''), '0'), '.'),
            'reviewCount' => (string) $schemaReviews,
            'bestRating' => '5',
            'worstRating' => '1',
        ] : null;

        $schemaOffer = $schemaPrice > 0 ? [
            '@type' => 'Offer',
            'url' => $schemaPageUrl,
            'priceCurrency' => 'USD',
            'price' => number_format($schemaPrice, 2, '.', ''),
            // Always a year ahead, so the price never shows as expired.
            'priceValidUntil' => now()->addYear()->toDateString(),
            'availability' => 'https://schema.org/InStock',
            'itemCondition' => 'https://schema.org/NewCondition',
            'seller' => [
                '@type' => 'Organization',
                'name' => 'The Rigid Boxes',
            ],
            'shippingDetails' => [
                '@type' => 'OfferShippingDetails',
                'shippingDestination' => [
                    '@type' => 'DefinedRegion',
                    'addressCountry' => 'US',
                ],
                'deliveryTime' => [
                    '@type' => 'ShippingDeliveryTime',
                    'handlingTime' => ['@type' => 'QuantitativeValue', 'minValue' => 1, 'maxValue' => 2, 'unitCode' => 'd'],
                    'transitTime' => ['@type' => 'QuantitativeValue', 'minValue' => 7, 'maxValue' => 8, 'unitCode' => 'd'],
                ],
                'shippingRate' => [
                    '@type' => 'MonetaryAmount',
                    'currency' => 'USD',
                    'value' => 0,
                ],
            ],
            'hasMerchantReturnPolicy' => [
                '@type' => 'MerchantReturnPolicy',
                'applicableCountry' => 'US',
                'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                'merchantReturnDays' => 180,
                'returnMethod' => 'https://schema.org/ReturnByMail',
                'returnFees' => 'https://schema.org/FreeReturn',
                'refundType' => 'https://schema.org/FullRefund',
            ],
            'validFrom' => !empty($schemaProduct['updated_at'])
                ? date('Y-m-d', strtotime($schemaProduct['updated_at']))
                : now()->toDateString(),
        ] : null;

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
            'aggregateRating' => $schemaAggregateRating,
            'offers' => $schemaOffer,
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
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'The Rigid Boxes',
                'url' => $schemaSiteUrl,
                'logo' => $schemaLogo,
            ],
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
            'worksFor' => ['@id' => $schemaBusinessId],
        ], fn ($value) => $value !== null && $value !== '');
    }

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

    // A custom schema replaces the generated schema for this page entirely.
    // If it is removed, the generated defaults below are rendered again.
    if ($schemaCustomPayload !== null) {
        $schemaGraph = [];
    }

    // Exception: FAQs added separately in admin are still output even when
    // a custom schema is pasted, unless that custom schema already has a FAQPage.
    $schemaProductFaqPayload = null;
    if (
        $schemaCustomPayload !== null
        && !empty($schemaFaqEntities)
        && stripos(json_encode($schemaCustomPayload), 'FAQPage') === false
    ) {
        $schemaProductFaqPayload = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            '@id' => $schemaPageUrl . '#faq',
            'mainEntity' => $schemaFaqEntities,
        ];
    }

    if (!empty($schemaProduct)) {
        $allowedProductSchemas = ['Product', 'FAQPage'];
        $schemaGraph = array_values(array_filter(
            $schemaGraph,
            fn ($node) => in_array($node['@type'] ?? null, $allowedProductSchemas, true)
        ));
    }

    $schemaPayload = [
        '@context' => 'https://schema.org',
        '@graph' => $schemaGraph,
    ];
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

@if($schemaProductFaqPayload !== null)
<script type="application/ld+json">
{!! json_encode(
    $schemaProductFaqPayload,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>
@endif
