<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminContentSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/admin-content.json');
        if (! is_file($path)) return;
        $data = json_decode(file_get_contents($path), true) ?: [];
        $categories = [];

        foreach ($data['categories'] ?? [] as $row) {
            $id = DB::table('admin_categories')->insertGetId($this->pick($row, [
                'title', 'slug', 'status', 'show_in_nav', 'show_home',
            ]));
            $categories[$row['id']] = $id;
        }

        foreach ($data['categories'] ?? [] as $row) {
            if (! empty($row['parent_id']) && isset($categories[$row['id']], $categories[$row['parent_id']])) {
                DB::table('admin_categories')->where('id', $categories[$row['id']])
                    ->update(['parent_id' => $categories[$row['parent_id']]]);
            }
        }

        foreach ($data['products'] ?? [] as $row) {
            $product = $this->pick($row, [
                'title', 'slug', 'status', 'show_home', 'image', 'description',
                'long_description', 'alt_text', 'box_style', 'material', 'printing',
                'finishing', 'moq', 'turnaround', 'meta_title', 'meta_description',
                'meta_keywords', 'robots',
            ]);
            $product['images'] = json_encode($row['images'] ?? []);
            $product['related'] = json_encode($row['related'] ?? []);
            $id = DB::table('admin_products')->insertGetId($product);

            foreach ($row['categories'] ?? [] as $category) {
                if (isset($categories[$category])) {
                    DB::table('admin_category_product')->insert([
                        'product_id' => $id, 'category_id' => $categories[$category],
                    ]);
                }
            }
        }
    }

    private function pick(array $row, array $fields): array
    {
        $result = [];
        foreach ($fields as $field) if (array_key_exists($field, $row)) $result[$field] = $row[$field];
        $result['created_at'] = now();
        $result['updated_at'] = now();
        return $result;
    }
}
