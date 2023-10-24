<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class BrandSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            $name = $faker->word;
            $slug = Str::slug($name);
            $status = $faker->boolean;
            $category_id = $faker->numberBetween(1, 5); // Assuming 5 categories exist

            DB::table('brands')->insert([
                'name' => $name,
                'slug' => $slug,
                'status' => $status,
                'category_id' => $category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}