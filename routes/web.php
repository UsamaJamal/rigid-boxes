<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminContentController;

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
    return view('category', compact('slug'));
});

Route::get('/all-category', function () {
    return view('all-category');
});

Route::get('/product/{slug?}', function ($slug = null) {
    return view('product', compact('slug'));
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/blog', function () {
    return view('blog');
});

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
