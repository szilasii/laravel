<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i =0; $i<10; $i++ ) {
            Products::create([
                'productName' => $faker->sentence(2),
                'description' => $faker->text(),
                'price' => $faker->randomFloat(2,1,6),
                'stock' => $faker->numberBetween(0,20)
            ]);    
        }//
    }
}
