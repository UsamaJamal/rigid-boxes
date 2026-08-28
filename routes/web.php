<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\WhyChooseUsController;
use App\Http\Controllers\FrequentlyAskedQuestionController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SitemapController;
Route::get('/', function () {
    $settings = (new \App\Http\Controllers\AdminHomepageController())->loadSettings();
    $categories = DB::table('admin_categories')->where('status', 'published')->get()->map(fn($r)=>(array)$r)->all();
    $products = DB::table('admin_products')->where('status', 'published')->get()->map(fn($r)=>(array)$r)->all();
    $recentBlogs = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as author_name', 'admin_authors.slug as author_slug')
        ->where('admin_blogs.status', 'published')->limit(4)->get();
    return view('homepage', compact('settings', 'categories', 'products', 'recentBlogs'));
});

Route::get('/search', function (\Illuminate\Http\Request $request) {
    $q = trim((string) $request->input('q', ''));
    $products = [];
    $categories = [];
    $blogs = [];
    $totalCount = 0;

    if ($q) {
        $products = DB::table('admin_products')
            ->where('status', 'published')
            ->where('title', 'like', "%{$q}%")
            ->get()->map(fn($r)=>(array)$r)->all();
            
        $categories = DB::table('admin_categories')
            ->where('status', 'published')
            ->where('title', 'like', "%{$q}%")
            ->get()->map(fn($r)=>(array)$r)->all();
            
        $blogs = DB::table('admin_blogs')
            ->where('status', 'published')
            ->where('title', 'like', "%{$q}%")
            ->get()->map(fn($r)=>(array)$r)->all();
            
        $totalCount = count($products) + count($categories) + count($blogs);
    }
    
    return view('search', compact('q', 'products', 'categories', 'blogs', 'totalCount'));
});



Route::get('/all-category/{slug}', function (string $slug) {
    return redirect('/' . $slug . '/', 301);
});

Route::get('/product', function () {
    return redirect('/', 301);
});
Route::get('/product/{slug}', function ($slug) {
    return redirect('/' . $slug . '/', 301);
});

/* Parent-category landing pages use clean root-level URLs without a route catch-all. */
$parentCategoryLanding = function (string $slug) {
    $parentCategory = DB::table('admin_categories')
        ->where('slug', $slug)
        ->where('status', 'published')
        ->whereNull('parent_id')
        ->first();

    abort_unless($parentCategory, 404);

    $categories = DB::table('admin_categories')
        ->where('parent_id', $parentCategory->id)
        ->where('status', 'published')
        ->get()
        ->map(fn($r) => (array) $r)
        ->all();

    return view('all-category', [
        'categories' => $categories,
        'parentCategory' => (array) $parentCategory,
    ]);
};

Route::get('/box-by-industry', fn () => $parentCategoryLanding('box-by-industry'));
Route::get('/box-by-material', fn () => $parentCategoryLanding('box-by-material'));
Route::get('/box-by-style', fn () => $parentCategoryLanding('box-by-style'));

Route::get('/contact-us', function () {
    return view('contact');
});

Route::get('/blog', function () {
    $blogs = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as author_name', 'admin_authors.image as author_image', 'admin_authors.slug as author_slug')
        ->where('admin_blogs.status', 'published')
        ->get()->map(fn($r) => (array) $r)->all();
    return view('blog', compact('blogs'));
});

Route::get('/blog-detail', function () {
    $blog = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as author_name', 'admin_authors.image as author_image', 'admin_authors.description as author_description', 'admin_authors.facebook as author_facebook', 'admin_authors.twitter as author_twitter', 'admin_authors.linkedin as author_linkedin', 'admin_authors.slug as author_slug')
        ->where('admin_blogs.status', 'published')->first();
    $blog = $blog ? (array) $blog : [];
    $recentBlogs = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as author_name', 'admin_authors.slug as author_slug')
        ->where('admin_blogs.status', 'published')->limit(4)->get();
    return view('blog-detail', compact('blog', 'recentBlogs'));
});

Route::get('/blog/{slug}', function ($slug) {
    $blog = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as joined_author_name', 'admin_authors.image as joined_author_image', 'admin_authors.description as joined_author_desc', 'admin_authors.facebook as joined_author_facebook', 'admin_authors.twitter as joined_author_twitter', 'admin_authors.linkedin as joined_author_linkedin', 'admin_authors.slug as joined_author_slug')
        ->where('admin_blogs.slug', $slug)
        ->where('admin_blogs.status', 'published')
        ->first();
    abort_unless($blog, 404);
    $blog = (array) $blog;
    $recentBlogs = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as joined_author_name', 'admin_authors.slug as joined_author_slug')
        ->where('admin_blogs.status', 'published')->limit(4)->get();
    return view('blog-detail', compact('blog', 'recentBlogs'));
});

Route::get('/author/{slug?}', function ($slug = null) {
    if ($slug) {
        $author = DB::table('admin_authors')->where('slug', $slug)->where('status', 'published')->first();
    } else {
        $author = DB::table('admin_authors')->where('status', 'published')->first();
    }
    if (!$author) abort(404);
    $author = (array) $author;
    $blogs = DB::table('admin_blogs')
        ->leftJoin('admin_authors', 'admin_blogs.author_id', '=', 'admin_authors.id')
        ->select('admin_blogs.*', 'admin_authors.title as author_name', 'admin_authors.image as author_image', 'admin_authors.slug as author_slug')
        ->where('admin_blogs.author_id', $author['id'])
        ->where('admin_blogs.status', 'published')
        ->get()->map(fn($r) => (array) $r)->all();
    return view('author', compact('author', 'blogs'));
});

Route::get('/request-quote', [QuotationController::class, 'index']);
Route::get('/sitemap', [SitemapController::class, 'index']);
Route::get('/sitemap.xml', [SitemapController::class, 'xml']);

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminHomepageController;
use App\Http\Controllers\AdminFooterController;
use App\Http\Controllers\AdminFaqPageController;
use App\Http\Controllers\AdminAboutUsController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminContentController::class, 'dashboard'])->name('dashboard');
        Route::get('/homepage-settings', [AdminHomepageController::class, 'edit'])->name('homepage.edit');
        Route::post('/homepage-settings', [AdminHomepageController::class, 'update'])->name('homepage.update');
        Route::get('/footer-settings', [AdminFooterController::class, 'edit'])->name('footer.edit');
        Route::post('/footer-settings', [AdminFooterController::class, 'update'])->name('footer.update');
        Route::get('/faq-page-settings', [AdminFaqPageController::class, 'edit'])->name('faqpage.edit');
        Route::post('/faq-page-settings', [AdminFaqPageController::class, 'update'])->name('faqpage.update');
        Route::get('/about-us-settings', [AdminAboutUsController::class, 'edit'])->name('aboutus.edit');
        Route::post('/about-us-settings', [AdminAboutUsController::class, 'update'])->name('aboutus.update');
        Route::post('/tinymce/upload', [AdminContentController::class, 'uploadTinyMceMedia'])->name('tinymce.upload');
        Route::get('/{module}', [AdminContentController::class, 'index'])->name('module.index');
        Route::get('/{module}/create', [AdminContentController::class, 'create'])->name('module.create');
        Route::post('/{module}', [AdminContentController::class, 'store'])->name('module.store');
        Route::get('/{module}/{id}/edit', [AdminContentController::class, 'edit'])->name('module.edit');
        Route::put('/{module}/{id}', [AdminContentController::class, 'update'])->name('module.update');
        Route::delete('/{module}/{id}', [AdminContentController::class, 'destroy'])->name('module.destroy');
    });
});

Route::get('/why-choose-us',[WhyChooseUsController::class, 'index']);

try {
    $faqRow = DB::table('homepage_contents')->where('section', 'faq_page')->where('field_key', 'faq_page_slug')->first();
    $faqSlug = $faqRow ? $faqRow->value : 'frequently-asked-questions';
} catch (\Exception $e) {
    $faqSlug = 'frequently-asked-questions';
}
Route::get('/' . ltrim($faqSlug, '/'), [FrequentlyAskedQuestionController::class, 'index']);

Route::get('/about-us',[AboutUsController::class,'index']);

use App\Http\Controllers\FormSubmitController;
Route::post('/submit-contact', [FormSubmitController::class, 'submitContact']);
Route::post('/submit-quote', [FormSubmitController::class, 'submitQuote']);
Route::post('/submit-newsletter', [FormSubmitController::class, 'submitNewsletter']);

// Temporary route to preview email design
Route::get('/preview-email', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '1234567890',
        'company_name' => 'Acme Corp',
        'width' => '10',
        'length' => '15',
        'depth' => '5',
        'units' => 'cm',
        'box_style' => 'Mailer Box',
        'material' => 'Kraft',
        'color' => '4/0',
        'quantity' => '500',
        'message' => 'This is a test message to preview the email design.'
    ];
    return new \App\Mail\QuoteFormMail($data);
});

// Catch-all route for categories and products
Route::get('/{slug}', function ($slug) {
    // 1. Check if it's a category
    $category = DB::table('admin_categories')->where('slug', $slug)->where('status', 'published')->first();
    if ($category) {
        $categoryArr = (array) $category;
        $categories = DB::table('admin_categories')->where('status', 'published')->get()->map(fn($r)=>(array)$r)->all();
        
        $products = [];
        $faqs = [];
        if (!empty($categoryArr['id'])) {
            $productIds = DB::table('admin_category_product')->where('category_id', $categoryArr['id'])->pluck('product_id');
            $products = DB::table('admin_products')->where('status', 'published')->whereIn('id', $productIds)->get()->map(fn($r)=>(array)$r)->all();
            
            $childIds = DB::table('admin_categories')->where('parent_id', $categoryArr['id'])->where('status', 'published')->pluck('id');
            if ($childIds->count() > 0) {
                $childProductIds = DB::table('admin_category_product')->whereIn('category_id', $childIds)->pluck('product_id');
                $moreProducts = DB::table('admin_products')->where('status', 'published')->whereIn('id', $childProductIds)->get()->map(fn($r)=>(array)$r)->all();
                $products = array_merge($products, $moreProducts);
            }

            $faqs = DB::table('admin_category_faqs')->where('category_id', $categoryArr['id'])->get()->map(fn($r)=>(array)$r)->all();
        }

        return view('category', [
            'slug' => $slug,
            'category' => $categoryArr,
            'categories' => $categories,
            'products' => $products,
            'faqs' => $faqs
        ]);
    }

    // 2. Check if it's a product
    $product = DB::table('admin_products')->where('slug', $slug)->where('status', 'published')->first();
    if ($product) {
        $productArr = (array) $product;
        $categories = DB::table('admin_categories')->where('status', 'published')->get()->map(fn($r)=>(array)$r)->all();
        $faqs = [];
        $relatedProducts = [];

        if (!empty($productArr['id'])) {
            $faqs = DB::table('admin_product_faqs')->where('product_id', $productArr['id'])->get()->map(fn($r)=>(array)$r)->all();
            $relatedProducts = DB::table('admin_products')->where('status', 'published')->where('id', '!=', $productArr['id'])->limit(4)->get()->map(fn($r)=>(array)$r)->all();
        }

        return view('product', [
            'slug' => $slug,
            'product' => $productArr,
            'categories' => $categories,
            'faqs' => $faqs,
            'relatedProducts' => $relatedProducts
        ]);
    }

    // 3. Check if it's a dynamic page
    $page = DB::table('admin_pages')->where('slug', $slug)->where('status', 'published')->first();
    if ($page) {
        return view('dynamic-page', ['page' => (array) $page]);
    }

    // If neither category, product, nor page
    abort(404);
});
