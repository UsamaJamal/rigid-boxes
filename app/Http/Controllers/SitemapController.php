<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index()
    {
        $blogs = DB::table('admin_blogs')->where('status', 'published')->get();
        $pages = DB::table('admin_pages')->where('status', 'published')->get();
        
        $parentCategories = DB::table('admin_categories')->where('status', 'published')->whereNull('parent_id')->get();
        $allCategories = DB::table('admin_categories')->where('status', 'published')->whereNotNull('parent_id')->get();
        $allProducts = DB::table('admin_products')
            ->join('admin_category_product', 'admin_products.id', '=', 'admin_category_product.product_id')
            ->select('admin_products.id', 'admin_products.title', 'admin_products.slug', 'admin_category_product.category_id')
            ->where('admin_products.status', 'published')
            ->get();
            
        $sitemapData = [];
        foreach ($parentCategories as $parent) {
            $subs = $allCategories->where('parent_id', $parent->id);
            $subcategoriesData = [];
            foreach ($subs as $sub) {
                $prods = $allProducts->where('category_id', $sub->id);
                $subcategoriesData[] = [
                    'category' => $sub,
                    'products' => $prods
                ];
            }
            $sitemapData[] = [
                'parent' => $parent,
                'subcategories' => $subcategoriesData,
                'direct_products' => $allProducts->where('category_id', $parent->id)
            ];
        }
        
        return view('sitemap', compact('blogs', 'pages', 'sitemapData'));
    }

    /** 
     * Original XML sitemap: 100% unchanged standard page URL sitemap.
     */
    /**
     * Get the clean canonical base URL (ensures production https:// domain on live).
     */
    /** The newest of the given dates (any may be empty), or null. */
    protected function latestDate(...$dates): ?string
    {
        $stamps = array_filter(array_map(fn ($date) => $date ? strtotime((string) $date) : false, $dates));
        return $stamps ? date('Y-m-d H:i:s', max($stamps)) : null;
    }

    /** Last change to the given settings sections of homepage_contents. */
    protected function settingsChanged(array $sections): ?string
    {
        return DB::table('homepage_contents')->whereIn('section', $sections)->max('updated_at');
    }

    /** When a page's Blade template file last changed. */
    protected function viewChanged(string $view): ?string
    {
        $path = resource_path('views/' . $view . '.blade.php');
        return is_file($path) ? date('Y-m-d H:i:s', filemtime($path)) : null;
    }

    /** Last change to the homepage: its own settings fields or its template. */
    protected function homepageLastModified(): ?string
    {
        return $this->latestDate(
            DB::table('homepage_contents')->whereIn('field_key', [
                'meta_title', 'meta_description', 'meta_keywords', 'schema', 'hero_title', 'hero_description',
                'hero_image', 'featured_categories', 'bestseller_products', 'faqs', 'content_section',
            ])->max('updated_at'),
            $this->viewChanged('homepage')
        );
    }

    protected function getBaseUrl(): string
    {
        $configured = rtrim((string) config('app.url'), '/');
        if (!empty($configured) && !in_array(parse_url($configured, PHP_URL_HOST), ['localhost', '127.0.0.1'])) {
            return $configured;
        }
        return rtrim(url('/'), '/');
    }

    /** 
     * Original XML sitemap: 100% unchanged standard page URL sitemap.
     */
    public function xml()
    {
        $baseUrl = $this->getBaseUrl();
        $categories = DB::table('admin_categories')
            ->where('status', 'published')
            ->select('slug', 'updated_at')
            ->get();
        $products = DB::table('admin_products')
            ->where('status', 'published')
            ->select('slug', 'updated_at')
            ->get();
        $blogs = DB::table('admin_blogs')
            ->where('status', 'published')
            ->select('slug', 'updated_at')
            ->get();
        $pages = DB::table('admin_pages')
            ->where('status', 'published')
            ->select('slug', 'updated_at')
            ->get();

        // Each page's lastmod comes only from what that page shows, so editing
        // one settings page (homepage, About Us, FAQ, footer) does not move the
        // dates of unrelated pages.
        $homepageLastModified = $this->homepageLastModified();
        $companyInfoLastModified = $this->settingsChanged(['company_info']);
        $contentLastModified = $this->latestDate(
            $categories->max('updated_at'),
            $products->max('updated_at'),
            $blogs->max('updated_at'),
            $pages->max('updated_at')
        );
        $defaultLastModified = date('Y-m-d', strtotime($homepageLastModified ?: 'now'));

        $urls = [];
        $addUrl = function (
            string $path = '',
            $lastModified = null,
            string $changeFrequency = 'monthly',
            string $priority = '0.5'
        ) use (&$urls, $baseUrl, $defaultLastModified) {
            $lastModifiedTimestamp = $lastModified ? strtotime((string) $lastModified) : false;

            $urls[] = [
                'loc' => $path === '' ? $baseUrl : $baseUrl . '/' . trim($path, '/') . '/',
                'lastmod' => $lastModifiedTimestamp
                    ? date('Y-m-d', $lastModifiedTimestamp)
                    : $defaultLastModified,
                'changefreq' => $changeFrequency,
                'priority' => $priority,
            ];
        };

        $staticPages = [
            ['path' => '', 'lastmod' => $homepageLastModified, 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['path' => 'box-by-industry', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => 'box-by-material', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => 'box-by-style', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => 'contact-us', 'lastmod' => $this->latestDate($this->viewChanged('contact'), $companyInfoLastModified), 'changefreq' => 'yearly', 'priority' => '0.5'],
            ['path' => 'request-quote', 'lastmod' => $this->latestDate($this->viewChanged('qotation'), $companyInfoLastModified), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => 'blog', 'lastmod' => $blogs->max('updated_at'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['path' => 'sitemap', 'lastmod' => $contentLastModified, 'changefreq' => 'monthly', 'priority' => '0.3'],
            ['path' => 'why-choose-us', 'lastmod' => $this->viewChanged('whyChooseUs'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['path' => 'about-us', 'lastmod' => $this->latestDate($this->settingsChanged(['about_us_page']), $this->viewChanged('aboutUs')), 'changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        foreach ($staticPages as $page) {
            $category = $categories->firstWhere('slug', $page['path']);
            $lastModified = $page['lastmod'] ?? ($category->updated_at ?? null);
            $addUrl($page['path'], $lastModified, $page['changefreq'], $page['priority']);
        }

        $faqSlug = DB::table('homepage_contents')
            ->where('section', 'faq_page')
            ->where('field_key', 'faq_page_slug')
            ->value('value') ?: 'frequently-asked-questions';
        $addUrl($faqSlug, $this->latestDate($this->settingsChanged(['faq_page']), $this->viewChanged('faqpage')), 'monthly', '0.6');

        foreach ($categories as $category) {
            if (!empty($category->slug)) $addUrl($category->slug, $category->updated_at, 'weekly', '0.8');
        }

        foreach ($products as $product) {
            if (!empty($product->slug)) $addUrl($product->slug, $product->updated_at, 'weekly', '0.9');
        }

        foreach ($blogs as $blog) {
            if (!empty($blog->slug)) $addUrl('blog/' . $blog->slug, $blog->updated_at, 'monthly', '0.7');
        }

        foreach ($pages as $page) {
            if (!empty($page->slug)) $addUrl($page->slug, $page->updated_at, 'monthly', '0.6');
        }

        $urls = collect($urls)->unique('loc')->values()->all();

        return response()->view('sitemap-xml', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    /* =========================================================================
     * SEPARATE DYNAMIC IMAGE SITEMAP
     * ========================================================================= */

    /**
     * Resolve relative/storage image paths to absolute canonical URLs.
     */
    protected function resolveImageUrl(?string $raw, string $baseUrl): ?string
    {
        if (empty($raw)) return null;
        $raw = trim($raw);
        if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://')) {
            return $raw;
        }
        $rel = ltrim($raw, '/');
        $candidates = [
            $rel,
            'storage/' . $rel,
            'uploads/' . $rel,
            'images/' . $rel
        ];
        foreach ($candidates as $cand) {
            if (file_exists(public_path($cand))) {
                return $baseUrl . '/' . $cand;
            }
        }
        if (str_starts_with($rel, 'uploads/') || str_starts_with($rel, 'storage/') || str_starts_with($rel, 'images/')) {
            return $baseUrl . '/' . $rel;
        }
        return $baseUrl . '/storage/' . $rel;
    }

    /**
     * Collect all published site URLs mapped with their respective image data.
     */
    protected function getImageSitemapData(string $baseUrl): array
    {
        $urls = [];

        // 1. Homepage
        $homeImages = [];
        $heroImage = DB::table('homepage_contents')
            ->where('section', 'hero')
            ->where('field_key', 'hero_image')
            ->value('value');
        if ($resolved = $this->resolveImageUrl($heroImage, $baseUrl)) {
            $homeImages[] = [
                'loc' => $resolved,
                'title' => 'The Rigid Boxes - Custom Luxury Packaging',
                'caption' => 'Leading custom packaging manufacturer delivering premium boxes and packaging solutions'
            ];
        }
        $homepageLastModified = $this->homepageLastModified();
        $urls['/'] = [
            'loc' => $baseUrl . '/',
            'lastmod' => date('Y-m-d', strtotime($homepageLastModified ?: 'now')),
            'changefreq' => 'weekly',
            'priority' => '1.0',
            'images' => $homeImages
        ];

        // 2. Static Pages with images
        $staticPages = [
            [
                'slug' => 'about-us',
                'lastmod' => $this->latestDate($this->settingsChanged(['about_us_page']), $this->viewChanged('aboutUs')),
                'title' => 'About The Rigid Boxes',
                'changefreq' => 'monthly',
                'priority' => '0.6',
                'images' => [
                    ['path' => 'uploads/born-from-passion.png', 'title' => 'Born From Passion - The Rigid Boxes', 'caption' => 'The Rigid Boxes craftsmanship and heritage'],
                    ['path' => 'uploads/year-of-expertise.png', 'title' => 'Years of Packaging Expertise', 'caption' => 'Industry-leading box manufacturing expertise'],
                    ['path' => 'uploads/circular-future.png', 'title' => 'Sustainable Packaging Future', 'caption' => '100% recyclable, eco-friendly rigid packaging']
                ]
            ],
            [
                'slug' => 'why-choose-us',
                'lastmod' => $this->viewChanged('whyChooseUs'),
                'title' => 'Why Choose The Rigid Boxes',
                'changefreq' => 'monthly',
                'priority' => '0.6',
                'images' => [
                    ['path' => 'uploads/craftmenship.png', 'title' => 'Custom Packaging Craftsmanship', 'caption' => 'Premium materials and bespoke box design'],
                    ['path' => 'uploads/sustainable-packaging.png', 'title' => 'Sustainable Rigid Packaging', 'caption' => 'Eco-friendly and sustainable packaging manufacturing']
                ]
            ]
        ];

        foreach ($staticPages as $sp) {
            $sImgs = [];
            foreach ($sp['images'] as $imgDef) {
                if ($loc = $this->resolveImageUrl($imgDef['path'], $baseUrl)) {
                    $sImgs[] = [
                        'loc' => $loc,
                        'title' => $imgDef['title'],
                        'caption' => $imgDef['caption']
                    ];
                }
            }
            $urls[$sp['slug']] = [
                'loc' => $baseUrl . '/' . $sp['slug'] . '/',
                'lastmod' => date('Y-m-d', strtotime($sp['lastmod'] ?: 'now')),
                'changefreq' => $sp['changefreq'],
                'priority' => $sp['priority'],
                'images' => $sImgs
            ];
        }

        // 3. Categories
        $categories = DB::table('admin_categories')
            ->where('status', 'published')
            ->get();
        foreach ($categories as $c) {
            if (empty($c->slug)) continue;
            $cImages = [];
            $seen = [];
            $title = $c->title ?? 'Custom Boxes';
            $caption = $title . ' - Custom Packaging Boxes';

            $add = function(?string $img) use (&$cImages, &$seen, $baseUrl, $title, $caption) {
                if ($loc = $this->resolveImageUrl($img, $baseUrl)) {
                    if (!isset($seen[$loc])) {
                        $seen[$loc] = true;
                        $cImages[] = ['loc' => $loc, 'title' => $title, 'caption' => $caption];
                    }
                }
            };

            if (!empty($c->image)) $add($c->image);
            if (!empty($c->hero_image)) $add($c->hero_image);
            if (!empty($c->banner_image)) $add($c->banner_image);

            $urls[$c->slug] = [
                'loc' => $baseUrl . '/' . trim($c->slug, '/') . '/',
                'lastmod' => !empty($c->updated_at) ? date('Y-m-d', strtotime($c->updated_at)) : null,
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'images' => $cImages
            ];
        }

        // 4. Products
        $products = DB::table('admin_products')
            ->where('status', 'published')
            ->get();
        foreach ($products as $p) {
            if (empty($p->slug)) continue;
            $pImages = [];
            $seen = [];
            $title = $p->title ?? 'Custom Packaging Box';
            $caption = !empty($p->alt_text) ? $p->alt_text : ($title . ' - The Rigid Boxes');

            $add = function(?string $img) use (&$pImages, &$seen, $baseUrl, $title, $caption) {
                if ($loc = $this->resolveImageUrl($img, $baseUrl)) {
                    if (!isset($seen[$loc])) {
                        $seen[$loc] = true;
                        $pImages[] = ['loc' => $loc, 'title' => $title, 'caption' => $caption];
                    }
                }
            };

            if (!empty($p->image)) $add($p->image);
            if (!empty($p->hover_image)) $add($p->hover_image);
            if (!empty($p->images)) {
                $arr = is_string($p->images) ? json_decode($p->images, true) : (array)$p->images;
                if (is_array($arr)) {
                    foreach ($arr as $gImg) {
                        $add($gImg);
                    }
                }
            }

            $urls[$p->slug] = [
                'loc' => $baseUrl . '/' . trim($p->slug, '/') . '/',
                'lastmod' => !empty($p->updated_at) ? date('Y-m-d', strtotime($p->updated_at)) : null,
                'changefreq' => 'weekly',
                'priority' => '0.9',
                'images' => $pImages
            ];
        }

        // 5. Blogs
        $blogs = DB::table('admin_blogs')
            ->where('status', 'published')
            ->get();
        foreach ($blogs as $b) {
            if (empty($b->slug)) continue;
            $bImages = [];
            $seen = [];
            $title = $b->title ?? 'Packaging Blog';
            $caption = !empty($b->alt_text) ? $b->alt_text : $title;

            $add = function(?string $img) use (&$bImages, &$seen, $baseUrl, $title, $caption) {
                if ($loc = $this->resolveImageUrl($img, $baseUrl)) {
                    if (!isset($seen[$loc])) {
                        $seen[$loc] = true;
                        $bImages[] = ['loc' => $loc, 'title' => $title, 'caption' => $caption];
                    }
                }
            };

            if (!empty($b->image)) $add($b->image);

            if (!empty($b->content)) {
                if (preg_match_all('/<img[^>]+src=([\'"])(.*?)\1/i', $b->content, $matches)) {
                    foreach ($matches[2] as $inlineSrc) {
                        $add($inlineSrc);
                    }
                }
            }

            $urls['blog/' . $b->slug] = [
                'loc' => $baseUrl . '/blog/' . trim($b->slug, '/') . '/',
                'lastmod' => !empty($b->updated_at) ? date('Y-m-d', strtotime($b->updated_at)) : null,
                'changefreq' => 'monthly',
                'priority' => '0.7',
                'images' => $bImages
            ];
        }

        // 6. Other Pages
        $pages = DB::table('admin_pages')
            ->where('status', 'published')
            ->get();
        foreach ($pages as $page) {
            if (empty($page->slug)) continue;
            $pgImages = [];
            $seen = [];
            $title = $page->title ?? 'Page';
            $caption = !empty($page->alt_text) ? $page->alt_text : $title;

            $add = function(?string $img) use (&$pgImages, &$seen, $baseUrl, $title, $caption) {
                if ($loc = $this->resolveImageUrl($img, $baseUrl)) {
                    if (!isset($seen[$loc])) {
                        $seen[$loc] = true;
                        $pgImages[] = ['loc' => $loc, 'title' => $title, 'caption' => $caption];
                    }
                }
            };

            if (!empty($page->image)) $add($page->image);
            if (!empty($page->content)) {
                if (preg_match_all('/<img[^>]+src=([\'"])(.*?)\1/i', $page->content, $matches)) {
                    foreach ($matches[2] as $inlineSrc) {
                        $add($inlineSrc);
                    }
                }
            }

            $urls[$page->slug] = [
                'loc' => $baseUrl . '/' . trim($page->slug, '/') . '/',
                'lastmod' => !empty($page->updated_at) ? date('Y-m-d', strtotime($page->updated_at)) : null,
                'changefreq' => 'monthly',
                'priority' => '0.6',
                'images' => $pgImages
            ];
        }

        return $urls;
    }

    /**
     * Dedicated Google Image Sitemap (100% Dynamic & Completely Separate).
     */
    public function imagesXml()
    {
        $baseUrl = $this->getBaseUrl();
        $allData = $this->getImageSitemapData($baseUrl);

        // Filter only URLs that contain one or more images
        $urls = array_values(array_filter($allData, function ($item) {
            return !empty($item['images']) && count($item['images']) > 0;
        }));

        return response()->view('sitemap-images-xml', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
