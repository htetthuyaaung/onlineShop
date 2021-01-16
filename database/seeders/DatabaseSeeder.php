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
        // \App\Models\User::factory(10)->create();
       $this->call(CategoriesTableSeeder::class);
       $this->call(ProductTableSeeder::class);
       $this->call(CouponsTableSeeder::class);
        // \App\Models\Product::factory(22)->create();
    }
}
