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
        $urls = [];
        $addUrl = function (string $path = '', $lastModified = null) use (&$urls, $baseUrl) {
            $urls[] = [
                'loc' => $path === '' ? $baseUrl : $baseUrl . '/' . trim($path, '/') . '/',
                'lastmod' => $lastModified ? date('Y-m-d', strtotime($lastModified)) : null,
            ];
        };

        foreach ([
            '',
            'box-by-industry',
            'box-by-material',
            'box-by-style',
            'contact-us',
            'request-quote',
            'blog',
            'sitemap',
            'why-choose-us',
            'about-us',
        ] as $path) {
            $addUrl($path);
        }

        $faqSlug = DB::table('homepage_contents')
            ->where('section', 'faq_page')
            ->where('field_key', 'faq_page_slug')
            ->value('value') ?: 'frequentlyAskedQuestions';
        $addUrl($faqSlug);

        foreach (DB::table('admin_categories')->where('status', 'published')->select('slug', 'updated_at')->get() as $category) {
            if (!empty($category->slug)) $addUrl($category->slug, $category->updated_at);
        }

        foreach (DB::table('admin_products')->where('status', 'published')->select('slug', 'updated_at')->get() as $product) {
            if (!empty($product->slug)) $addUrl($product->slug, $product->updated_at);
        }

        foreach (DB::table('admin_blogs')->where('status', 'published')->select('slug', 'updated_at')->get() as $blog) {
            if (!empty($blog->slug)) $addUrl('blog/' . $blog->slug, $blog->updated_at);
        }

        foreach (DB::table('admin_pages')->where('status', 'published')->select('slug', 'updated_at')->get() as $page) {
            if (!empty($page->slug)) $addUrl($page->slug, $page->updated_at);
        }

        $urls = collect($urls)->unique('loc')->values()->all();

        return response()->view('sitemap-xml', compact('urls'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
