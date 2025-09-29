<?php

namespace Database\Seeders\pkg_Parameters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarFuelTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuelTypes = [
            ['fuel_type_name' => 'Petrol', 'description' => 'Gasoline-powered vehicles.'],
            ['fuel_type_name' => 'Diesel', 'description' => 'Diesel-powered vehicles.'],
            ['fuel_type_name' => 'Electric', 'description' => 'Fully electric vehicles with rechargeable batteries.'],
            ['fuel_type_name' => 'Hybrid', 'description' => 'Combination of petrol/diesel and electric power.'],
            ['fuel_type_name' => 'Hydrogen', 'description' => 'Hydrogen fuel cell-powered vehicles.'],
            ['fuel_type_name' => 'CNG', 'description' => 'Compressed Natural Gas vehicles.'],
            ['fuel_type_name' => 'LPG', 'description' => 'Liquefied Petroleum Gas vehicles.'],
        ];

        foreach ($fuelTypes as $fuelType) {
            DB::table('car_fuel_types')->insert([
                'fuel_type_name' => $fuelType['fuel_type_name'],
                'description' => $fuelType['description'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }    }
}
