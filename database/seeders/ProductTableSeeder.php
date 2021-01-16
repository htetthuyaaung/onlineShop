<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //digital
        for($i = 1 ; $i <= 22; $i++){
          
           Product::create([
            'name' =>'Digital' .$i,
            'slug' =>'digital-'.$i,
            'short_description' => [13, 14, 15][array_rand([13, 14, 15])]. 'inch, '.[1, 2, 3][array_rand([1, 2, 3])]. ' TB SSD, 32GB RAM',
            'description' =>'Lorem ' .$i. 'ipsum dolor sit amet, consectetur adipisicing elit.Ipsum temporibus iusto ipsam, asperiores voluptas unde aspernatur praesent in? Aliquam, dolore!',
            'price' => rand(149,1990),
            'stock_status' => 'instock',
            'image' => 'digital_' .$i.'.jpg',
           ])->categories()->attach(3);
           }

           $product = Product::find(1);
           $product->categories()->attach(2);

            //fashion
        for($i = 1 ; $i <= 10; $i++){
          
            Product::create([
             'name' =>'Fashion' .$i,
             'slug' =>'fashion-'.$i,
             'short_description' => 'Lorem',
             'description' =>'Lorem ' .$i. 'ipsum dolor sit amet, consectetur adipisicing elit.Ipsum temporibus iusto ipsam, asperiores voluptas unde aspernatur praesent in? Aliquam, dolore!',
             'price' => rand(149,1990),
             'stock_status' => 'instock',
             'image' => 'fashion_' .$i.'.jpg',
            ])->categories()->attach(1);
            }

             //furniture
        for($i = 1 ; $i <= 9; $i++){
          
            Product::create([
             'name' =>'Furniture' .$i,
             'slug' =>'furniture-'.$i,
             'short_description' =>'Lorem',
             'description' =>'Lorem ' .$i. 'ipsum dolor sit amet, consectetur adipisicing elit.Ipsum temporibus iusto ipsam, asperiores voluptas unde aspernatur praesent in? Aliquam, dolore!',
             'price' => rand(149,1990),
             'stock_status' => 'instock',
             'image' => 'furniture_' .$i.'.jpg',
            ])->categories()->attach(2);
            }

                 //kidtoy
        for($i = 1 ; $i <= 10; $i++){
          
            Product::create([
             'name' =>'Kidtoy' .$i,
             'slug' =>'kidtoy-'.$i,
             'short_description' =>'Lorem',
             'description' =>'Lorem ' .$i. 'ipsum dolor sit amet, consectetur adipisicing elit.Ipsum temporibus iusto ipsam, asperiores voluptas unde aspernatur praesent in? Aliquam, dolore!',
             'price' => rand(149,1990),
             'stock_status' => 'instock',
             'image' => 'kidtoy_' .$i.'.jpg',
            ])->categories()->attach(5);
            }

             //organics
            for($i = 1 ; $i <= 8; $i++){
          
                Product::create([
                 'name' =>'Organics' .$i,
                 'slug' =>'organics-'.$i,
                 'short_description' =>'Lorem',
                 'description' =>'Lorem ' .$i. 'ipsum dolor sit amet, consectetur adipisicing elit.Ipsum temporibus iusto ipsam, asperiores voluptas unde aspernatur praesent in? Aliquam, dolore!',
                 'price' => rand(149,1990),
                 'stock_status' => 'instock',
                 'image' => 'organics_' .$i.'.jpg',
                ])->categories()->attach(6);
                }

                  //tools
            for($i = 1 ; $i <= 8; $i++){
          
                Product::create([
                 'name' =>'Tools' .$i,
                 'slug' =>'tools-'.$i,
                 'short_description' =>'Lorem',
                 'description' =>'Lorem ' .$i. 'ipsum dolor sit amet, consectetur adipisicing elit.Ipsum temporibus iusto ipsam, asperiores voluptas unde aspernatur praesent in? Aliquam, dolore!',
                 'price' => rand(149,1990),
                 'stock_status' => 'instock',
                 'image' => 'tools_' .$i.'.jpg',
                ])->categories()->attach(4);
                }

            
    }
}
