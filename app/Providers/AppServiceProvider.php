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

                // Load Global Settings for Header/Footer
                $defaults = [
                    'company_email' => 'example@gmail.com',
                    'company_phone' => '1800-315-8441',
                    'company_address' => '4000 N Montrose Ave<br>550 Chicago, IL 60641',
                    'footer_categories' => [],
                    'footer_quick_links' => []
                ];
                
                $rows = DB::table('homepage_contents')
                    ->whereIn('section', ['footer', 'company_info'])
                    ->get();
                    
                $settings = [];
                foreach ($rows as $row) {
                    $key = $row->field_key;
                    $val = $row->value;
                    $type = $row->value_type;
                    if ($type === 'json' || $type === 'array') {
                        $settings[$key] = json_decode($val, true) ?: [];
                    } else {
                        $settings[$key] = $val;
                    }
                }
                
                $siteSettings = array_merge($defaults, $settings);
                $view->with('siteSettings', $siteSettings);
            } catch (\Exception $e) {
                $view->with('navCategories', []);
                $view->with('siteSettings', [
                    'company_email' => 'example@gmail.com',
                    'company_phone' => '1800-315-8441',
                    'company_address' => '4000 N Montrose Ave<br>550 Chicago, IL 60641',
                    'footer_categories' => [],
                    'footer_quick_links' => []
                ]);
            }
        });
    }
}
