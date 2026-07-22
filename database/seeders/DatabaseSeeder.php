<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminContentSeeder::class);
        $this->call(ImportPremiumBoxesSeeder::class);
        $this->call(CategoryFaqsSeeder::class);
        $this->call(CategoryDescriptionsSeeder::class);
    }
}
