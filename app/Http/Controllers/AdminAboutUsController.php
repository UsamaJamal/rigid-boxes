<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAboutUsController extends Controller
{
    public function getSettings(): array
    {
        $defaults = [
            'about_page_title' => 'About Us',
            'about_meta_title' => '',
            'about_meta_description' => '',
            'about_meta_keywords' => '',
            'about_robots' => 'index,follow'
        ];

        try {
            $rows = DB::table('homepage_contents')
                ->where('section', 'about_us_page')
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

        return $defaults;
    }

    public function edit()
    {
        $settings = $this->getSettings();
        return view('admin.about_us_settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_page_title' => 'nullable|string|max:255',
            'about_meta_title' => 'nullable|string|max:255',
            'about_meta_description' => 'nullable|string',
            'about_meta_keywords' => 'nullable|string|max:255',
            'about_robots' => 'nullable|string|max:50',
        ]);

        $settings = $this->getSettings();
        $settings['about_page_title'] = $request->input('about_page_title');
        $settings['about_meta_title'] = $request->input('about_meta_title');
        $settings['about_meta_description'] = $request->input('about_meta_description');
        $settings['about_meta_keywords'] = $request->input('about_meta_keywords');
        $settings['about_robots'] = $request->input('about_robots', 'index,follow');

        foreach ($settings as $key => $value) {
            $isJson = is_array($value);
            $strValue = $isJson ? json_encode($value) : (string) $value;

            DB::table('homepage_contents')->updateOrInsert(
                ['section' => 'about_us_page', 'field_key' => $key],
                [
                    'value' => $strValue,
                    'value_type' => $isJson ? 'json' : 'string',
                    'updated_at' => now()
                ]
            );
        }

        return redirect()->back()->with('success', 'About Us Settings updated successfully!');
    }
}
