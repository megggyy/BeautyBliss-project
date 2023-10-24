<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
use Faker\Factory as Faker;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            $color = Color::create([
                'name' => $faker->colorName,
                'code' => $faker->hexcolor,
                'status' => $faker->boolean,
            ]);
        }
    }
}