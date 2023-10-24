<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $categories = Category::all();
        $brands = Brand::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 3; $i++) {
                $product = new Product();
                $product->category_id = $category->id;
                $product->name = $faker->word;
                $product->slug = Str::slug($product->name);
                $product->brand = $brands->random()->name;
                $product->small_description = $faker->sentence;
                $product->description = $faker->paragraph;
                $product->original_price = $faker->randomFloat(2, 10, 100);
                $product->selling_price = $faker->randomFloat(2, 5, $product->original_price);
                $product->quantity = $faker->randomNumber(2);
                $product->trending = $faker->boolean;
                $product->status = $faker->boolean;
                $product->meta_title = $faker->sentence;
                $product->meta_keyword = $faker->words(3, true);
                $product->meta_description = $faker->paragraph;

                $product->save();
            }
        }
    }
}