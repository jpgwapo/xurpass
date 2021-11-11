<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use DB;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                "name" => $faker->word(),
                "available_stock" => random_int(1, 30)
            ];
        }

        foreach ($data as $chunk) {
            Product::insert($chunk);
        }
    }
}
