<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminHomepageController extends Controller
{
    private function getSettingsPath(): string
    {
        return storage_path('app/homepage-settings.json');
    }

    public function loadSettings(): array
    {
        $defaults = [
            'meta_title' => 'Custom Printed Boxes & Packaging - The Rigid Boxes',
            'meta_description' => 'Custom printed rigid packaging boxes at wholesale rates. Premium luxury boxes for retail, cosmetic, and gift packaging.',
            'meta_keywords' => '',
            'schema' => '',
            'hero_title' => 'Custom Printed Boxes & Packaging Manufacturer',
            'hero_description' => 'Get premium custom rigid boxes and packaging solutions designed for your brand.',
            'hero_image' => '',
            'featured_categories' => [],
            'bestseller_products' => [],
            'content_section' => '<h2>Why Choose Rigid Boxes</h2><p>We craft high quality luxury packaging for all industries.</p>',
            'faqs' => [
                ['question' => 'What is the Minimum Order Quantity (MOQ)?', 'answer' => 'Our minimum order quantity starts from 100 units.'],
                ['question' => 'Do you provide free design support?', 'answer' => 'Yes, our expert design team provides 100% free design support.']
            ]
        ];

        // 1. Try reading from MySQL database table `homepage_contents`
        try {
            $rows = DB::table('homepage_contents')->get();
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
            // Fallback if table query fails
        }

        // 2. Fallback to storage file if DB is empty
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
        $settings = $this->loadSettings();
        $categories = DB::table('admin_categories')->get()->map(fn($r) => (array)$r)->all();
        $products = DB::table('admin_products')->get()->map(fn($r) => (array)$r)->all();

        return view('admin.homepage_settings', compact('settings', 'categories', 'products'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',
            'schema' => 'nullable|json',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'featured_categories' => 'nullable|array',
            'bestseller_products' => 'nullable|array',
            'content_section' => 'nullable|string',
            'faq_questions' => 'nullable|array',
            'faq_answers' => 'nullable|array',
        ]);

        $settings = $this->loadSettings();

        $settings['meta_title'] = $request->input('meta_title');
        $settings['meta_description'] = $request->input('meta_description');
        $settings['meta_keywords'] = $request->input('meta_keywords');
        $settings['schema'] = $request->input('schema');
        $settings['hero_title'] = $request->input('hero_title');
        $settings['hero_description'] = $request->input('hero_description');

        if ($request->input('remove_hero_image') == '1') {
            $settings['hero_image'] = null;
        }
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $settings['hero_image'] = 'uploads/' . $fileName;
        }

        $settings['featured_categories'] = array_map('intval', (array) $request->input('featured_categories', []));
        $settings['bestseller_products'] = array_map('intval', (array) $request->input('bestseller_products', []));
        $settings['content_section'] = $request->input('content_section');

        // Reconstruct FAQs array
        $faqs = [];
        $questions = (array) $request->input('faq_questions', []);
        $answers = (array) $request->input('faq_answers', []);

        foreach ($questions as $i => $q) {
            if (!empty(trim($q))) {
                $faqs[] = [
                    'question' => trim($q),
                    'answer' => trim($answers[$i] ?? '')
                ];
            }
        }
        $settings['faqs'] = $faqs;

        // Save into MySQL database table `homepage_contents`
        foreach ($settings as $key => $value) {
            $valueType = 'text';
            $section = 'general';

            if (in_array($key, ['meta_title', 'meta_description', 'meta_keywords', 'schema'])) {
                $section = 'seo';
            } elseif (in_array($key, ['hero_title', 'hero_description', 'hero_image'])) {
                $section = 'hero';
            } elseif (in_array($key, ['featured_categories', 'bestseller_products', 'faqs'])) {
                $section = 'list';
                $valueType = 'json';
                $value = json_encode($value);
            } elseif ($key === 'content_section') {
                $section = 'content';
                $valueType = 'html';
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

        // Also save to JSON file as backup
        file_put_contents($this->getSettingsPath(), json_encode($settings, JSON_PRETTY_PRINT));

        return redirect()->route('admin.homepage.edit')->with('success', 'Home Page Settings updated and saved to Database table successfully.');
    }
}
