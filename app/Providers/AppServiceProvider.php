<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    private function footerSettingsBackup(): array
    {
        $path = storage_path('app/site-settings.json');

        if (!file_exists($path)) {
            return [];
        }

        $settings = json_decode(file_get_contents($path), true);

        return is_array($settings) ? $settings : [];
    }

    public function register()
    {
        //
    }

    public function boot()
    {
        // Shared hosts sometimes point APP_URL at "/public". Keep generated
        // links, assets, canonicals and schemas on the clean domain instead.
        $configuredUrl = rtrim((string) config('app.url'), '/');
        $cleanUrl = preg_replace('#/public$#i', '', $configuredUrl);
        if ($cleanUrl && $cleanUrl !== $configuredUrl) {
            URL::forceRootUrl($cleanUrl);
        }

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
                    ->whereIn('section', ['footer', 'company_info', 'social_links'])
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
                
                // The admin settings page also keeps a JSON backup. Use it here
                // as well so a deployment cannot make the public footer fall
                // back to the placeholder details while the backup is present.
                $siteSettings = array_merge($defaults, $this->footerSettingsBackup(), $settings);
                $view->with('siteSettings', $siteSettings);
            } catch (\Exception $e) {
                $view->with('navCategories', []);
                $view->with('siteSettings', array_merge([
                    'company_email' => 'example@gmail.com',
                    'company_phone' => '1800-315-8441',
                    'company_address' => '4000 N Montrose Ave<br>550 Chicago, IL 60641',
                    'footer_categories' => [],
                    'footer_quick_links' => []
                ], $this->footerSettingsBackup()));
            }
        });
    }
}
