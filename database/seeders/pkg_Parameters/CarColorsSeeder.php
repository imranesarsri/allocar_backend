<?php

namespace Database\Seeders\pkg_Parameters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color_name' => 'Red', 'color_code' => '#FF0000'],
            ['color_name' => 'Blue', 'color_code' => '#0000FF'],
            ['color_name' => 'Black', 'color_code' => '#000000'],
            ['color_name' => 'White', 'color_code' => '#FFFFFF'],
            ['color_name' => 'Silver', 'color_code' => '#C0C0C0'],
            ['color_name' => 'Gray', 'color_code' => '#808080'],
            ['color_name' => 'Green', 'color_code' => '#008000'],
            ['color_name' => 'Yellow', 'color_code' => '#FFFF00'],
            ['color_name' => 'Orange', 'color_code' => '#FFA500'],
            ['color_name' => 'Purple', 'color_code' => '#800080'],
            ['color_name' => 'Brown', 'color_code' => '#A52A2A'],
            ['color_name' => 'Gold', 'color_code' => '#FFD700'],
            ['color_name' => 'Beige', 'color_code' => '#F5F5DC'],
            ['color_name' => 'Pink', 'color_code' => '#FFC0CB'],
            ['color_name' => 'Turquoise', 'color_code' => '#40E0D0'],
            ['color_name' => 'Copper', 'color_code' => '#B87333'],
            ['color_name' => 'Champagne', 'color_code' => '#F7E7CE'],
            ['color_name' => 'Mint', 'color_code' => '#98FF98'],
            ['color_name' => 'Ivory', 'color_code' => '#FFFFF0'],
        ];

        foreach ($colors as $color) {
            DB::table('car_colors')->insert([
                'color_name' => $color['color_name'],
                'color_code' => $color['color_code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}