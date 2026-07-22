<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeoSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_categories')->select('id', 'title', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'robots', 'schema')->get()->each(function ($category) {
            $title = $category->title;
            $updates = [];

            if (trim((string) $category->meta_title) === '') {
                $updates['meta_title'] = "Custom {$title} | Premium Packaging | The Rigid Boxes";
            }
            if (trim((string) $category->meta_description) === '') {
                $updates['meta_description'] = "Shop custom {$title} made with premium materials, professional printing, and protective designs. Request a wholesale quote from The Rigid Boxes.";
            }
            if (trim((string) $category->meta_keywords) === '') {
                $updates['meta_keywords'] = strtolower("custom {$title}, {$title} packaging, premium boxes, rigid packaging");
            }
            if (trim((string) $category->robots) === '') {
                $updates['robots'] = 'index,follow';
            }
            if (trim((string) $category->schema) === '') {
                $updates['schema'] = json_encode([
                    '@context' => 'https://schema.org',
                    '@type' => 'ProductGroup',
                    'name' => $title,
                    'url' => url('/category/' . ($category->slug ?: Str::slug($title))),
                    'description' => $updates['meta_description'] ?? $category->meta_description,
                ], JSON_UNESCAPED_SLASHES);
            }

            if ($updates) {
                $updates['updated_at'] = now();
                DB::table('admin_categories')->where('id', $category->id)->update($updates);
            }
        });
    }
}
