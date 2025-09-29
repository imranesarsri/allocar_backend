<?php

namespace Database\Seeders\pkg_Parameters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['brand_name' => 'Toyota', 'description' => 'Japanese automobile manufacturer.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Toyota.svg'],
            ['brand_name' => 'Mercedes-Benz', 'description' => 'Luxury vehicle brand from Germany.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Mercedes.svg'],
            ['brand_name' => 'BMW', 'description' => 'German automobile manufacturer.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/BMW.svg'],
            ['brand_name' => 'Ford', 'description' => 'American multinational automaker.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Ford.svg'],
            ['brand_name' => 'Audi', 'description' => 'Luxury brand under Volkswagen Group.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Audi.svg'],
            ['brand_name' => 'Hyundai', 'description' => 'South Korean automobile manufacturer.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Hyundai.svg'],
            ['brand_name' => 'Nissan', 'description' => 'Japanese automaker known for innovation.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Nissan.svg'],
            ['brand_name' => 'Volkswagen', 'description' => 'One of the largest automakers in the world.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Volkswagen.svg'],
            ['brand_name' => 'Honda', 'description' => 'Reliable Japanese automobile brand.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Honda.svg'],
            ['brand_name' => 'Chevrolet', 'description' => 'American car brand under General Motors.', 'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/brand_logos/Chevrolet.svg'],
        ];

        foreach ($brands as $brand) {
            DB::table('car_brands')->insert([
                'brand_name' => $brand['brand_name'],
                'description' => $brand['description'],
                'logo_url' => $brand['logo_url'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
