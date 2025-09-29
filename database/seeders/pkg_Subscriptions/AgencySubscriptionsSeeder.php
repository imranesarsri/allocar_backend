<?php

namespace Database\Seeders\pkg_Subscriptions;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencySubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agency_subscriptions')->insert([
            [
                'agency_id' => 1,
                'package_id' => 1,
                'start_date' => now(),
                'end_date' => now()->addMonths(6),
                'is_active' => true,
                'current_car_count' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 2,
                'package_id' => 2,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'is_active' => true,
                'current_car_count' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 3,
                'package_id' => 3,
                'start_date' => now()->subMonths(3),
                'end_date' => now()->addMonths(9),
                'is_active' => true,
                'current_car_count' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 4,
                'package_id' => 1,
                'start_date' => now(),
                'end_date' => now()->addMonths(12),
                'is_active' => true,
                'current_car_count' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 5,
                'package_id' => 2,
                'start_date' => now()->subMonths(6),
                'end_date' => now()->addMonths(6),
                'is_active' => true,
                'current_car_count' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

}