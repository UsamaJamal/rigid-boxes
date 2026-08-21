<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomepageContentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'section' => 'seo',
                'field_key' => 'meta_title',
                'value' => 'Custom Printed Boxes & Packaging - The Rigid Boxes',
                'value_type' => 'text',
                'sort_order' => 1
            ],
            [
                'section' => 'seo',
                'field_key' => 'meta_description',
                'value' => 'Custom printed rigid packaging boxes at wholesale rates. Premium luxury boxes for retail, cosmetic, and gift packaging.',
                'value_type' => 'text',
                'sort_order' => 2
            ],
            [
                'section' => 'seo',
                'field_key' => 'meta_keywords',
                'value' => '',
                'value_type' => 'text',
                'sort_order' => 3
            ],
            [
                'section' => 'hero',
                'field_key' => 'hero_title',
                'value' => 'Custom Printed Boxes & Packaging Manufacturer',
                'value_type' => 'text',
                'sort_order' => 4
            ],
            [
                'section' => 'hero',
                'field_key' => 'hero_description',
                'value' => 'Get premium custom rigid boxes and packaging solutions designed for your brand.',
                'value_type' => 'text',
                'sort_order' => 4
            ],
            [
                'section' => 'hero',
                'field_key' => 'hero_image',
                'value' => '',
                'value_type' => 'text',
                'sort_order' => 5
            ],
            [
                'section' => 'list',
                'field_key' => 'featured_categories',
                'value' => json_encode([1, 2, 3, 4, 5]),
                'value_type' => 'json',
                'sort_order' => 6
            ],
            [
                'section' => 'list',
                'field_key' => 'bestseller_products',
                'value' => json_encode([1, 2, 3, 4]),
                'value_type' => 'json',
                'sort_order' => 7
            ],
            [
                'section' => 'content',
                'field_key' => 'content_section',
                'value' => '<h2>Why Choose Rigid Boxes</h2><p>We craft high quality luxury packaging for all industries.</p>',
                'value_type' => 'html',
                'sort_order' => 8
            ],
            [
                'section' => 'list',
                'field_key' => 'faqs',
                'value' => json_encode([
                    ['question' => 'What is the Minimum Order Quantity (MOQ)?', 'answer' => 'Our minimum order quantity starts from 100 units.'],
                    ['question' => 'Do you provide free design support?', 'answer' => 'Yes, our expert design team provides 100% free design support.']
                ]),
                'value_type' => 'json',
                'sort_order' => 9
            ],
        ];

        foreach ($items as $item) {
            DB::table('homepage_contents')->updateOrInsert(
                ['field_key' => $item['field_key']],
                [
                    'section' => $item['section'],
                    'value' => $item['value'],
                    'value_type' => $item['value_type'],
                    'sort_order' => $item['sort_order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
