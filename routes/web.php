<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhyChooseUsController;
use App\Http\Controllers\FrequentlyAskedQuestionController;
use App\Http\Controllers\AboutUsController;

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

Route::get('/', function () {
    return view('homepage');
});

Route::get('/category', function () {
    return view('category');
});

Route::get('/all-category', function () {
    return view('all-category');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/whyChooseUs',[WhyChooseUsController::class, 'index']);

Route::get('/frequentlyAskedQuestions',[FrequentlyAskedQuestionController::class,'index']);

Route::get('/aboutUs',[AboutUsController::class,'index']);
