<?php

namespace Database\Seeders\pkg_Subscriptions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('packages')->insert([
        [
            'package_name' => 'Starter',
            'price' => 00.00,
            'max_car_limit' => 5,            
            'max_feature_cars' => 0,
            'description' => 'Forfait d\'entrée pour les très petites agences.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'package_name' => 'Basic',
            'price' => 29.99,
            'max_car_limit' => 20,
            'max_feature_cars' => 5,
            'description' => 'Forfait économique pour les petites agences.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'package_name' => 'Standard',
            'price' => 49.99,
            'max_car_limit' => 50,
            'max_feature_cars' => 10,
            'description' => 'Forfait intermédiaire pour agences en croissance.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        
    ]);
}

}
