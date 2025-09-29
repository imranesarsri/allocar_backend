<?php

namespace Database\Seeders\pkg_Parameters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            // Toyota Models
            ['car_brand_id' => 1, 'model_name' => 'Corolla', 'description' => 'A compact sedan from Toyota.'],
            ['car_brand_id' => 1, 'model_name' => 'Camry', 'description' => 'A midsize sedan from Toyota.'],
            ['car_brand_id' => 1, 'model_name' => 'RAV4', 'description' => 'A compact crossover SUV from Toyota.'],

            // Mercedes-Benz Models
            ['car_brand_id' => 2, 'model_name' => 'C-Class', 'description' => 'A luxury compact sedan from Mercedes-Benz.'],
            ['car_brand_id' => 2, 'model_name' => 'E-Class', 'description' => 'A luxury midsize sedan from Mercedes-Benz.'],
            ['car_brand_id' => 2, 'model_name' => 'S-Class', 'description' => 'A luxury full-size sedan from Mercedes-Benz.'],

            // BMW Models
            ['car_brand_id' => 3, 'model_name' => 'X5', 'description' => 'A luxury midsize SUV from BMW.'],
            ['car_brand_id' => 3, 'model_name' => '3 Series', 'description' => 'A compact executive sedan from BMW.'],
            ['car_brand_id' => 3, 'model_name' => '5 Series', 'description' => 'A luxury midsize sedan from BMW.'],

            // Ford Models
            ['car_brand_id' => 4, 'model_name' => 'Mustang', 'description' => 'A classic American sports car from Ford.'],
            ['car_brand_id' => 4, 'model_name' => 'F-150', 'description' => 'A full-size pickup truck from Ford.'],
            ['car_brand_id' => 4, 'model_name' => 'Focus', 'description' => 'A compact car from Ford.'],

            // Audi Models
            ['car_brand_id' => 5, 'model_name' => 'A4', 'description' => 'A luxury compact sedan from Audi.'],
            ['car_brand_id' => 5, 'model_name' => 'Q7', 'description' => 'A luxury full-size SUV from Audi.'],
            ['car_brand_id' => 5, 'model_name' => 'A6', 'description' => 'A luxury midsize sedan from Audi.'],

            // Hyundai Models
            ['car_brand_id' => 6, 'model_name' => 'Elantra', 'description' => 'A compact sedan from Hyundai.'],
            ['car_brand_id' => 6, 'model_name' => 'Sonata', 'description' => 'A midsize sedan from Hyundai.'],
            ['car_brand_id' => 6, 'model_name' => 'Tucson', 'description' => 'A compact SUV from Hyundai.'],

            // Nissan Models
            ['car_brand_id' => 7, 'model_name' => 'Altima', 'description' => 'A midsize sedan from Nissan.'],
            ['car_brand_id' => 7, 'model_name' => '370Z', 'description' => 'A two-seater sports car from Nissan.'],
            ['car_brand_id' => 7, 'model_name' => 'Rogue', 'description' => 'A compact SUV from Nissan.'],

            // Volkswagen Models
            ['car_brand_id' => 8, 'model_name' => 'Golf', 'description' => 'A compact hatchback from Volkswagen.'],
            ['car_brand_id' => 8, 'model_name' => 'Passat', 'description' => 'A midsize sedan from Volkswagen.'],
            ['car_brand_id' => 8, 'model_name' => 'Tiguan', 'description' => 'A compact SUV from Volkswagen.'],

            // Honda Models
            ['car_brand_id' => 9, 'model_name' => 'Civic', 'description' => 'A compact sedan from Honda.'],
            ['car_brand_id' => 9, 'model_name' => 'Accord', 'description' => 'A midsize sedan from Honda.'],
            ['car_brand_id' => 9, 'model_name' => 'CR-V', 'description' => 'A compact SUV from Honda.'],

            // Chevrolet Models
            ['car_brand_id' => 10, 'model_name' => 'Camaro', 'description' => 'A performance sports car from Chevrolet.'],
            ['car_brand_id' => 10, 'model_name' => 'Malibu', 'description' => 'A midsize sedan from Chevrolet.'],
            ['car_brand_id' => 10, 'model_name' => 'Equinox', 'description' => 'A compact SUV from Chevrolet.'],
        ];

        foreach ($models as $model) {
            DB::table('car_models')->insert([
                'car_brand_id' => $model['car_brand_id'],
                'model_name' => $model['model_name'],
                'description' => $model['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
