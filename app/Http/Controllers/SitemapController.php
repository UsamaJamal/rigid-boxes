<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index()
    {
        $blogs = DB::table('admin_blogs')->get();
        $pages = DB::table('admin_pages')->get();
        
        $parentCategories = DB::table('admin_categories')->whereNull('parent_id')->get();
        $allCategories = DB::table('admin_categories')->whereNotNull('parent_id')->get();
        $allProducts = DB::table('admin_products')
            ->join('admin_category_product', 'admin_products.id', '=', 'admin_category_product.product_id')
            ->select('admin_products.id', 'admin_products.title', 'admin_products.slug', 'admin_category_product.category_id')
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

    /** XML sitemap: page URLs use '/', while the sitemap endpoint does not. */
    public function xml()
    {
        $baseUrl = rtrim(url('/'), '/');
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

        $contentLastModified = DB::table('homepage_contents')->max('updated_at');
        $defaultLastModified = $contentLastModified
            ? date('Y-m-d', strtotime($contentLastModified))
            : date('Y-m-d', filemtime(resource_path('views/homepage.blade.php')));

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
            ['path' => '', 'lastmod' => $contentLastModified, 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['path' => 'box-by-industry', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => 'box-by-material', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => 'box-by-style', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => 'contact-us', 'changefreq' => 'yearly', 'priority' => '0.5'],
            ['path' => 'request-quote', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => 'blog', 'lastmod' => $blogs->max('updated_at'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['path' => 'sitemap', 'changefreq' => 'monthly', 'priority' => '0.3'],
            ['path' => 'why-choose-us', 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['path' => 'about-us', 'changefreq' => 'monthly', 'priority' => '0.6'],
        ];

        foreach ($staticPages as $page) {
            $category = $categories->firstWhere('slug', $page['path']);
            $lastModified = $page['lastmod'] ?? ($category->updated_at ?? null);
            $addUrl($page['path'], $lastModified, $page['changefreq'], $page['priority']);
        }

        $faqSlug = DB::table('homepage_contents')
            ->where('section', 'faq_page')
            ->where('field_key', 'faq_page_slug')
            ->value('value') ?: 'frequentlyAskedQuestions';
        $addUrl($faqSlug, $contentLastModified, 'monthly', '0.6');

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
}
