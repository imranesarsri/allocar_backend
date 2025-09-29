<?php

namespace Database\Seeders\pkg_Cars;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [];
        for ($i = 0; $i < 100; $i++) {
            $price = round(rand(10000, 50000) + rand(0, 99) / 100, 2);
            $isDiscount = rand(0, 1) && rand(1, 100) <= 30; // 30% de chance d'avoir une remise
            
            // Calculer le prix de remise (entre 10% et 40% de réduction)
            $discountPrice = null;
            $discountEndDate = null;
            
            if ($isDiscount) {
                $discountPercentage = rand(10, 40); // Entre 10% et 40% de réduction
                $discountPrice = round($price - ($price * $discountPercentage / 100), 2);
                
                // Date de fin de remise entre 1 jour et 3 mois dans le futur
                $daysToAdd = rand(1, 90);
                $discountEndDate = Carbon::now()->addDays($daysToAdd)->format('Y-m-d');
            }
            $cars[] = [
                'agency_id' => rand(1, 10),
                'car_brand_id' => rand(1, 10),
                'car_model_id' => rand(1, 10),
                'car_category_id' => rand(1, 10),
                'car_color_id' => rand(1, 10),
                'car_fuel_type_id' => rand(1, 7),
                'car_city_id' => rand(1, 10),
                'feature_car' => rand(0, 1),
                'year' => rand(2015, 2025),
                'mileage' => rand(5000, 100000),
                'transmission' => rand(0, 1) ? 'Automatic' : 'Manual',
                'registration_number' => strtoupper(substr(md5(rand()), 0, 7)),
                'price' => round(rand(10000, 50000) + rand(0, 99) / 100, 2),
                'is_available' => rand(0, 1),
                'description' => 'Description of car ' . ($i + 1),
                'features' => 'Feature 1, Feature 2, Feature 3',
                'is_discount' => $isDiscount,
                'discount_price' => $discountPrice,
                'discount_end_date' => $discountEndDate,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('cars')->insert($cars);
    }
}
