<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryFaqsSeeder extends Seeder
{
    public function run()
    {
        $categories = DB::table('admin_categories')->select('id', 'title')->get();

        foreach ($categories as $category) {
            $name = $category->title;

            // Keep exactly four editable FAQs for every category.
            DB::table('admin_category_faqs')->where('category_id', $category->id)->delete();
            DB::table('admin_category_faqs')->insert([
                [
                    'category_id' => $category->id,
                    'question' => "What are {$name} used for?",
                    'answer' => "{$name} are designed to protect products while giving your brand a premium, professional presentation.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'category_id' => $category->id,
                    'question' => "Can I customize {$name}?",
                    'answer' => "Yes. You can customize the size, structure, material, printing, finishing, and inserts to match your packaging requirements.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'category_id' => $category->id,
                    'question' => "Which materials are available for {$name}?",
                    'answer' => "We offer premium paperboard, rigid board, kraft, greyboard, and other suitable materials based on your product and sustainability goals.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'category_id' => $category->id,
                    'question' => "How do I order custom {$name}?",
                    'answer' => "Share your dimensions, quantity, artwork, and finishing preferences with our packaging team to receive a tailored quote.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
