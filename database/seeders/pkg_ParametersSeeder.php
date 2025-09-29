<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Parameters\{
    CarBrandsSeeder,
    CarCategoriesSeeder,
    CarCitiesSeeder,
    CarColorsSeeder,
    CarFuelTypesSeeder,
    CarModelsSeeder,
};


class pkg_ParametersSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_ParametersSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            CarBrandsSeeder::class,
            CarCategoriesSeeder::class,
            CarCitiesSeeder::class,
            CarColorsSeeder::class,
            CarFuelTypesSeeder::class,
            CarModelsSeeder::class,
        ];
    }
}
