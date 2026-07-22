<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share all categories with every view so the header nav dropdown works dynamically
        View::composer('*', function ($view) {
            try {
                $allCats = DB::table('admin_categories')
                    ->select('id', 'title', 'slug', 'parent_id', 'icon')
                    ->where('show_in_nav', 1)
                    ->get()
                    ->map(fn($r) => (array) $r)
                    ->all();
                $view->with('navCategories', $allCats);
            } catch (\Exception $e) {
                $view->with('navCategories', []);
            }
        });
    }
}
