<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\QuotationController;

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

Route::get('/', function () {
    $settings = (new \App\Http\Controllers\AdminHomepageController())->loadSettings();
    $categories = DB::table('admin_categories')->get()->map(fn($r)=>(array)$r)->all();
    $products = DB::table('admin_products')->get()->map(fn($r)=>(array)$r)->all();
    return view('homepage', compact('settings', 'categories', 'products'));
});

Route::get('/category/{slug?}', function ($slug = null) {
    $category = null;
    if ($slug) {
        $category = DB::table('admin_categories')->where('slug', $slug)->first();
    }
    if (!$category) {
        $category = DB::table('admin_categories')->whereNotNull('parent_id')->first();
    }
    if (!$category) {
        $category = DB::table('admin_categories')->first();
    }
    $categoryArr = $category ? (array) $category : [];
    
    $categories = DB::table('admin_categories')->get()->map(fn($r)=>(array)$r)->all();
    
    $products = [];
    $faqs = [];
    if (!empty($categoryArr['id'])) {
        $productIds = DB::table('admin_category_product')->where('category_id', $categoryArr['id'])->pluck('product_id');
        $products = DB::table('admin_products')->whereIn('id', $productIds)->get()->map(fn($r)=>(array)$r)->all();
        
        $childIds = DB::table('admin_categories')->where('parent_id', $categoryArr['id'])->pluck('id');
        if ($childIds->count() > 0) {
            $childProductIds = DB::table('admin_category_product')->whereIn('category_id', $childIds)->pluck('product_id');
            $moreProducts = DB::table('admin_products')->whereIn('id', $childProductIds)->get()->map(fn($r)=>(array)$r)->all();
            $products = array_merge($products, $moreProducts);
        }

        $faqs = DB::table('admin_category_faqs')->where('category_id', $categoryArr['id'])->get()->map(fn($r)=>(array)$r)->all();
    }
    if (empty($products)) {
        $products = DB::table('admin_products')->limit(8)->get()->map(fn($r)=>(array)$r)->all();
    }

    return view('category', [
        'slug' => $slug,
        'category' => $categoryArr,
        'categories' => $categories,
        'products' => $products,
        'faqs' => $faqs
    ]);
});

Route::get('/categories', function () {
    $categories = DB::table('admin_categories')->get()->map(fn($r)=>(array)$r)->all();
    return view('all-category', compact('categories'));
});

Route::get('/all-category', function () {
    return redirect('/categories', 301);
});

Route::get('/all-category/{slug}', function (string $slug) {
    return redirect('/' . $slug, 301);
});

Route::get('/product/{slug?}', function ($slug = null) {
    $product = null;
    if ($slug) {
        $product = DB::table('admin_products')->where('slug', $slug)->first();
    }
    if (!$product) {
        $product = DB::table('admin_products')->first();
    }
    $productArr = $product ? (array) $product : [];

    $categories = DB::table('admin_categories')->get()->map(fn($r)=>(array)$r)->all();
    $faqs = [];
    $relatedProducts = [];

    if (!empty($productArr['id'])) {
        $faqs = DB::table('admin_product_faqs')->where('product_id', $productArr['id'])->get()->map(fn($r)=>(array)$r)->all();
        $relatedProducts = DB::table('admin_products')->where('id', '!=', $productArr['id'])->limit(4)->get()->map(fn($r)=>(array)$r)->all();
    }

    return view('product', [
        'slug' => $slug,
        'product' => $productArr,
        'categories' => $categories,
        'faqs' => $faqs,
        'relatedProducts' => $relatedProducts
    ]);
});

/* Parent-category landing pages use clean root-level URLs without a route catch-all. */
$parentCategoryLanding = function (string $slug) {
    $parentCategory = DB::table('admin_categories')
        ->where('slug', $slug)
        ->whereNull('parent_id')
        ->first();

    abort_unless($parentCategory, 404);

    $categories = DB::table('admin_categories')
        ->where('parent_id', $parentCategory->id)
        ->get()
        ->map(fn($r) => (array) $r)
        ->all();

    return view('all-category', [
        'categories' => $categories,
        'parentCategory' => (array) $parentCategory,
    ]);
};

Route::get('/box-by-industry', $parentCategoryLanding);
Route::get('/box-by-material', $parentCategoryLanding);
Route::get('/box-by-style', $parentCategoryLanding);

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/request-quote', [QuotationController::class, 'index']);

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminHomepageController;

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
        Route::get('/{module}', [AdminContentController::class, 'index'])->name('module.index');
        Route::get('/{module}/create', [AdminContentController::class, 'create'])->name('module.create');
        Route::post('/{module}', [AdminContentController::class, 'store'])->name('module.store');
        Route::get('/{module}/{id}/edit', [AdminContentController::class, 'edit'])->name('module.edit');
        Route::put('/{module}/{id}', [AdminContentController::class, 'update'])->name('module.update');
        Route::delete('/{module}/{id}', [AdminContentController::class, 'destroy'])->name('module.destroy');
    });
});
