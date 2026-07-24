<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminFooterController extends Controller
{
    private function getSettingsPath(): string
    {
        return storage_path('app/site-settings.json');
    }

    public function getSettings(): array
    {
        $defaults = [
            'company_email' => 'example@gmail.com',
            'company_phone' => '1800-315-8441',
            'company_address' => '4000 N Montrose Ave<br>550 Chicago, IL 60641',
            'footer_categories' => [],
            'footer_quick_links' => []
        ];

        try {
            $rows = DB::table('homepage_contents')
                ->whereIn('section', ['footer', 'company_info'])
                ->get();
                
            if ($rows->count() > 0) {
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
                return array_merge($defaults, $settings);
            }
        } catch (\Exception $e) {
            // Fallback
        }

        $path = $this->getSettingsPath();
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            if (is_array($data)) {
                return array_merge($defaults, $data);
            }
        }

        return $defaults;
    }

    public function edit()
    {
        $settings = $this->getSettings();
        $categories = DB::table('admin_categories')->get()->map(fn($r) => (array)$r)->all();
        
        return view('admin.footer_settings', compact('settings', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:100',
            'company_address' => 'nullable|string',
            'footer_categories' => 'nullable|array',
            'footer_quick_links_names' => 'nullable|array',
            'footer_quick_links_urls' => 'nullable|array',
        ]);

        $settings = $this->getSettings();

        $settings['company_email'] = $request->input('company_email');
        $settings['company_phone'] = $request->input('company_phone');
        $settings['company_address'] = $request->input('company_address');
        $settings['footer_categories'] = array_map('intval', (array) $request->input('footer_categories', []));

        $quickLinks = [];
        $names = (array) $request->input('footer_quick_links_names', []);
        $urls = (array) $request->input('footer_quick_links_urls', []);

        foreach ($names as $i => $name) {
            if (!empty(trim($name))) {
                $quickLinks[] = [
                    'name' => trim($name),
                    'url' => trim($urls[$i] ?? '#')
                ];
            }
        }
        $settings['footer_quick_links'] = $quickLinks;

        foreach ($settings as $key => $value) {
            $valueType = 'text';
            $section = 'company_info';

            if (in_array($key, ['footer_categories', 'footer_quick_links'])) {
                $section = 'footer';
                $valueType = 'json';
                $value = json_encode($value);
            }

            DB::table('homepage_contents')->updateOrInsert(
                ['field_key' => $key],
                [
                    'section' => $section,
                    'value' => $value,
                    'value_type' => $valueType,
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }

        file_put_contents($this->getSettingsPath(), json_encode($settings, JSON_PRETTY_PRINT));

        return redirect()->route('admin.footer.edit')->with('success', 'Footer & Company settings updated successfully.');
    }
}
