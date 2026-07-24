<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductFaqsSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_products')->select('id', 'title')->get()->each(function ($product) {
            $name = $product->title;
            DB::table('admin_product_faqs')->where('product_id', $product->id)->delete();
            $faqs = [
                ["What are {$name} used for?", "{$name} provide dependable product protection with a professional branded presentation."],
                ["Can {$name} be customized?", "Yes. Sizes, materials, printing, finishing, inserts, and closures can all be customized."],
                ["What materials are available for {$name}?", "We offer premium paperboard, rigid board, kraft, greyboard, and other suitable packaging materials."],
                ["How do I order custom {$name}?", "Send your dimensions, quantity, artwork, and finishing preferences to receive a tailored wholesale quote."],
            ];
            DB::table('admin_product_faqs')->insert(collect($faqs)->map(fn($faq) => [
                'product_id' => $product->id,
                'question' => $faq[0],
                'answer' => $faq[1],
                'created_at' => now(),
                'updated_at' => now(),
            ])->all());
        });
    }
}
