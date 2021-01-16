<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name'=>'Fashion & Accessories', 'slug'=>'fashion', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'Furniture & Home Decors', 'slug'=>'furniture', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'Digital & Electronics', 'slug'=>'digital', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'Tools & Equipments', 'slug'=>'tools', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>"Kid's Toys", 'slug'=>'kid', 'created_at'=>$now, 'updated_at'=>$now],
            ['name'=>'Organics & Spa', 'slug'=>'organics', 'created_at'=>$now, 'updated_at'=>$now]
        ]);
    }
}
