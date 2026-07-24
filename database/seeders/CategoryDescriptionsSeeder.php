<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryDescriptionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_categories')->select('id', 'title', 'description')->get()->each(function ($category) {
            // Never replace copy entered by an administrator; only seed empty fields.
            if (trim((string) $category->description) !== '') {
                return;
            }

            $name = $category->title;
            $description = "<p>Discover premium custom {$name} designed to protect products and create a memorable unboxing experience. Our packaging combines durable construction with polished presentation for growing brands.</p>"
                . "<p>Choose from custom sizes, quality materials, full-colour printing, and premium finishing options. Every detail can be tailored to your product, brand identity, and order requirements.</p>"
                . '<ul><li>Custom dimensions and structures</li><li>Premium printing and finishing</li><li>Protective inserts and brand-ready presentation</li><li>Wholesale production and reliable delivery</li></ul>';

            DB::table('admin_categories')->where('id', $category->id)->update([
                'description' => $description,
                'updated_at' => now(),
            ]);
        });
    }
}
