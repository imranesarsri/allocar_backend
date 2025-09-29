<?php

namespace Database\Seeders\pkg_Parameters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Sedan', 'description' => 'A compact car with a separate trunk for storage.'],
            ['category_name' => 'SUV', 'description' => 'A sport utility vehicle designed for off-road and rough terrain.'],
            ['category_name' => 'Hatchback', 'description' => 'A car with a rear door that swings upwards.'],
            ['category_name' => 'Coupe', 'description' => 'A two-door car typically with a sporty design.'],
            ['category_name' => 'Convertible', 'description' => 'A car with a roof that can be retracted or removed.'],
            ['category_name' => 'Pickup', 'description' => 'A truck with an open cargo area at the back.'],
            ['category_name' => 'Minivan', 'description' => 'A vehicle designed for maximum passenger and cargo capacity.'],
            ['category_name' => 'Crossover', 'description' => 'A mix of an SUV and a sedan, often designed for better fuel efficiency.'],
            ['category_name' => 'Wagon', 'description' => 'A car with an extended rear cargo area.'],
            ['category_name' => 'Sports Car', 'description' => 'A car designed for high performance and speed.'],
            ['category_name' => 'Luxury', 'description' => 'A high-end vehicle offering superior comfort, features, and performance.'],
            ['category_name' => 'Electric', 'description' => 'A car powered solely by electric motors, with no internal combustion engine.'],
        ];

        foreach ($categories as $category) {
            DB::table('car_categories')->insert([
                'category_name' => $category['category_name'],
                'description' => $category['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}