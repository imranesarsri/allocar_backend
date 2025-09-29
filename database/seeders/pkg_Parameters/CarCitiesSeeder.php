<?php

namespace Database\Seeders\pkg_Parameters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['city_name' => 'Casablanca', 'country' => 'Morocco'],
            ['city_name' => 'Rabat', 'country' => 'Morocco'],
            ['city_name' => 'Marrakech', 'country' => 'Morocco'],
            ['city_name' => 'Fes', 'country' => 'Morocco'],
            ['city_name' => 'Tangier', 'country' => 'Morocco'],
            ['city_name' => 'Agadir', 'country' => 'Morocco'],
            ['city_name' => 'Oujda', 'country' => 'Morocco'],
            ['city_name' => 'Kenitra', 'country' => 'Morocco'],
            ['city_name' => 'Tetouan', 'country' => 'Morocco'],
            ['city_name' => 'Laayoune', 'country' => 'Morocco'],
        ];

        foreach ($cities as $city) {
            DB::table('car_cities')->insert([
                'city_name' => $city['city_name'],
                'country' => $city['country'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
