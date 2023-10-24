<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            DB::table('categories')->insert([
                'name' => $faker->word,
                'slug' => Str::slug($faker->word),
                'description' => $faker->sentence,
                'image' => $faker->imageUrl(),
                'meta_title' => $faker->sentence,
                'meta_keyword' => $faker->words(3, true),
                'meta_description' => $faker->paragraph,
                'status' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
