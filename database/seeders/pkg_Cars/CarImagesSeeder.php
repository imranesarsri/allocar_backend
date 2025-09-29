<?php

namespace Database\Seeders\pkg_Cars;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carImages = [
            ['car_id' => 1, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car1_1.jpg', 'is_primary' => true],
            ['car_id' => 1, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car1_2.jpg', 'is_primary' => false],
            ['car_id' => 1, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car1_3.jpg', 'is_primary' => false],

            ['car_id' => 2, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car2_1.jpg', 'is_primary' => true],
            ['car_id' => 2, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car2_1.jpg', 'is_primary' => false],

            ['car_id' => 3, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car3_1.jpg', 'is_primary' => true],
            ['car_id' => 3, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car3_2.jpg', 'is_primary' => false],

            ['car_id' => 4, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car4_1.jpg', 'is_primary' => true],
            ['car_id' => 4, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car4_2.jpg', 'is_primary' => false],
            ['car_id' => 4, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car4_3.jpg', 'is_primary' => false],
            ['car_id' => 4, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car4_4.jpg', 'is_primary' => false],

            ['car_id' => 5, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car5_1.jpg', 'is_primary' => true],
            ['car_id' => 5, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car5_2.jpg', 'is_primary' => false],
            ['car_id' => 5, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car5_3.jpg', 'is_primary' => false],

            ['car_id' => 6, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car6_1.jpg', 'is_primary' => true],
            ['car_id' => 6, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car6_2.jpg', 'is_primary' => false],
            ['car_id' => 6, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car6_3.jpg', 'is_primary' => false],

            ['car_id' => 7, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car7_1.jpg', 'is_primary' => true],

            ['car_id' => 8, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car8_1.jpg', 'is_primary' => true],
            ['car_id' => 8, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car8_2.jpg', 'is_primary' => false],
            ['car_id' => 8, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car8_3.jpeg', 'is_primary' => false],

            ['car_id' => 9, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car9_1.jpg', 'is_primary' => true],
            ['car_id' => 9, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car9_2.jpg', 'is_primary' => false],

            ['car_id' => 10, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car10_1.jpg', 'is_primary' => true],
            ['car_id' => 10, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car10_2.jpg', 'is_primary' => false],

            ['car_id' => 11, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car11_1.jpg', 'is_primary' => true],
            ['car_id' => 11, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car11_2.jpg', 'is_primary' => false],
            ['car_id' => 11, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car11_3.jpg', 'is_primary' => false],

            ['car_id' => 12, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car12_1.jpg', 'is_primary' => true],
            ['car_id' => 12, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car12_2.jpg', 'is_primary' => false],

            ['car_id' => 13, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car13_1.jpg', 'is_primary' => true],
            ['car_id' => 13, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car13_2.jpg', 'is_primary' => false],
            ['car_id' => 13, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car13_3.jpg', 'is_primary' => false],
            ['car_id' => 13, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car13_4.jpg', 'is_primary' => false],

            ['car_id' => 14, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car14_1.jpg', 'is_primary' => true],
            ['car_id' => 14, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car14_2.jpg', 'is_primary' => false],
            ['car_id' => 14, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car14_3.jpg', 'is_primary' => false],

            ['car_id' => 15, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car15_1.jpg', 'is_primary' => true],
            ['car_id' => 15, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car15_2.jpg', 'is_primary' => false],

            ['car_id' => 16, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car16_1.jpg', 'is_primary' => true],
            ['car_id' => 16, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car16_2.jpg', 'is_primary' => false],

            ['car_id' => 17, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car17_1.jpg', 'is_primary' => true],
            ['car_id' => 17, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car17_2.jpeg', 'is_primary' => false],

            ['car_id' => 18, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car18_1.jpg', 'is_primary' => true],
            ['car_id' => 18, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car18_2.jpg', 'is_primary' => false],

            ['car_id' => 19, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car19_1.jpg', 'is_primary' => true],
            ['car_id' => 19, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car19_2.jpg', 'is_primary' => false],

            ['car_id' => 20, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car20_1.jpg', 'is_primary' => true],
            ['car_id' => 20, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car20_2.png', 'is_primary' => false],

            ['car_id' => 21, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car21_1.jpg', 'is_primary' => false],

            ['car_id' => 22, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car22_1.jpeg', 'is_primary' => true],
            ['car_id' => 22, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car22_2.jpg', 'is_primary' => false],

            ['car_id' => 23, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car23_1.png', 'is_primary' => true],
            ['car_id' => 23, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car23_2.png', 'is_primary' => false],

            ['car_id' => 24, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car24_1.jpg', 'is_primary' => true],
            ['car_id' => 24, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car24_2.jpg', 'is_primary' => false],

            ['car_id' => 25, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car25_1.jpg', 'is_primary' => true],
            ['car_id' => 25, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car25_2.jpg', 'is_primary' => false],

            ['car_id' => 26, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car26_1.jpg', 'is_primary' => true],
            ['car_id' => 26, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car26_2.jpg', 'is_primary' => false],

            ['car_id' => 27, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car27_1.jpg', 'is_primary' => true],

            ['car_id' => 28, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car28_1.jpg', 'is_primary' => true],
            ['car_id' => 28, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car28_2.jpg', 'is_primary' => false],

            ['car_id' => 29, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car29_1.png', 'is_primary' => true],

            ['car_id' => 30, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car30_1.jpg', 'is_primary' => true],

            ['car_id' => 31, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car31_1.jpg', 'is_primary' => true],

            ['car_id' => 32, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car32_1.jpg', 'is_primary' => true],

            ['car_id' => 33, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car33_1.jpg', 'is_primary' => true],

            ['car_id' => 34, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car34_1.jpg', 'is_primary' => true],

            ['car_id' => 35, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car35_1.jpg', 'is_primary' => true],

            ['car_id' => 36, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car36_1.jpg', 'is_primary' => true],
            ['car_id' => 36, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car36_2.jpg', 'is_primary' => false],

            ['car_id' => 37, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car37_1.png', 'is_primary' => true],
            ['car_id' => 37, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car37_2.png', 'is_primary' => false],
            ['car_id' => 37, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car37_4.jpg', 'is_primary' => false],

            ['car_id' => 38, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car38_1.jpg', 'is_primary' => true],
            ['car_id' => 38, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car38_2.jpg', 'is_primary' => false],
            ['car_id' => 38, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car38_3.jpg', 'is_primary' => false],

            ['car_id' => 39, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car39_1.jpg', 'is_primary' => true],

            ['car_id' => 40, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car39_1.jpg', 'is_primary' => true],

            ['car_id' => 40, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car40_1.jpg', 'is_primary' => true],
            ['car_id' => 40, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car40_2.jpg', 'is_primary' => false],

            ['car_id' => 41, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car41_1.jpg', 'is_primary' => true],

            ['car_id' => 42, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car42_1.jpg', 'is_primary' => true],

            ['car_id' => 43, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car43_1.jpg', 'is_primary' => true],
            ['car_id' => 43, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car43_2.jpg', 'is_primary' => false],

            ['car_id' => 44, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car44_1.jpg', 'is_primary' => true],

            ['car_id' => 45, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car45_1.jpg', 'is_primary' => true],

            ['car_id' => 46, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car46_1.jpg', 'is_primary' => true],

            ['car_id' => 47, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car47_1.jpg', 'is_primary' => true],

            ['car_id' => 48, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car48_1.jpg', 'is_primary' => true],

            ['car_id' => 49, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car49_1.jpg', 'is_primary' => true],

            ['car_id' => 50, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car50_1.jpg', 'is_primary' => true],

            ['car_id' => 51, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car51_1.jpg', 'is_primary' => true],
            ['car_id' => 51, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car51_2.jpg', 'is_primary' => false],
            ['car_id' => 51, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car51_3.jpg', 'is_primary' => false],


            ['car_id' => 52, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car52_1.jpg', 'is_primary' => true],

            ['car_id' => 53, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car53_1.jpg', 'is_primary' => true],
            ['car_id' => 53, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car53_2.jpg', 'is_primary' => false],
            ['car_id' => 53, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car53_3.jpg', 'is_primary' => false],
            ['car_id' => 53, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car53_4.jpg', 'is_primary' => false],

            ['car_id' => 54, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car54_1.jpg', 'is_primary' => true],
            ['car_id' => 54, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car54_2.jpg', 'is_primary' => false],

            ['car_id' => 55, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car55_1.jpg', 'is_primary' => true],

            ['car_id' => 56, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car56_1.jpg', 'is_primary' => true],

            ['car_id' => 57, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car57_1.jpg', 'is_primary' => true],
            ['car_id' => 57, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car57_2.jpg', 'is_primary' => false],

            ['car_id' => 58, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car58_1.jpg', 'is_primary' => true],

            ['car_id' => 59, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car59_1.jpg', 'is_primary' => true],

            ['car_id' => 60, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car60_1.jpg', 'is_primary' => true],

            ['car_id' => 61, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car61_1.jpg', 'is_primary' => true],

            ['car_id' => 62, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car62_1.jpg', 'is_primary' => true],

            ['car_id' => 63, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car63_1.jpg', 'is_primary' => true],

            ['car_id' => 64, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car64_1.jpg', 'is_primary' => true],

            ['car_id' => 65, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car65_1.jpg', 'is_primary' => true],

            ['car_id' => 66, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car66_1.jpg', 'is_primary' => true],

            ['car_id' => 67, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car67_1.jpg', 'is_primary' => true],

            ['car_id' => 68, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car68_1.jpg', 'is_primary' => true],

            ['car_id' => 69, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car69_1.jpg', 'is_primary' => true],

            ['car_id' => 70, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car70_1.jpg', 'is_primary' => true],

            ['car_id' => 71, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car71_1.jpg', 'is_primary' => true],

            ['car_id' => 72, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car72_1.jpg', 'is_primary' => true],

            ['car_id' => 73, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car73_1.jpg', 'is_primary' => true],

            ['car_id' => 74, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car74_1.jpg', 'is_primary' => true],

            ['car_id' => 75, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car75_1.jpg', 'is_primary' => true],

            ['car_id' => 76, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car76_1.jpg', 'is_primary' => true],

            ['car_id' => 77, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car77_1.jpg', 'is_primary' => true],

            ['car_id' => 78, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car78_1.jpg', 'is_primary' => true],

            ['car_id' => 79, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car79_1.jpg', 'is_primary' => true],

            ['car_id' => 80, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car80_1.jpg', 'is_primary' => true],

            ['car_id' => 81, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car81_1.jpg', 'is_primary' => true],

            ['car_id' => 81, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car81_1.jpg', 'is_primary' => true],

            ['car_id' => 82, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car82_1.jpg', 'is_primary' => true],

            ['car_id' => 83, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car83_1.jpg', 'is_primary' => true],

            ['car_id' => 83, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car83_1.jpg', 'is_primary' => true],

            ['car_id' => 84, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car84_1.jpg', 'is_primary' => true],

            ['car_id' => 85, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car85_1.jpg', 'is_primary' => true],

            ['car_id' => 86, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car86_1.jpg', 'is_primary' => true],

            ['car_id' => 87, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car87_1.jpg', 'is_primary' => true],

            ['car_id' => 88, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car88_1.jpg', 'is_primary' => true],

            ['car_id' => 89, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car89_1.jpg', 'is_primary' => true],

            ['car_id' => 90, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car90_1.jpg', 'is_primary' => true],

            ['car_id' => 91, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car91_1.jpg', 'is_primary' => true],

            ['car_id' => 92, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car92_1.jpg', 'is_primary' => true],

            ['car_id' => 93, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car93_1.jpg', 'is_primary' => true],

            ['car_id' => 94, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car94_1.jpg', 'is_primary' => true],

            ['car_id' => 95, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car95_1.jpg', 'is_primary' => true],

            ['car_id' => 96, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car96_1.jpg', 'is_primary' => true],

            ['car_id' => 98, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car98_1.jpg', 'is_primary' => true],

            ['car_id' => 99, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car99_1.jpg', 'is_primary' => true],

            ['car_id' => 100, 'image_url' => 'http://127.0.0.1:8000/storage/seed_images/car_images/car100_1.jpg', 'is_primary' => true],
        ];

        foreach ($carImages as $image) {
            DB::table('car_images')->insert([
                'car_id' => $image['car_id'],
                'image_url' => $image['image_url'],
                'is_primary' => $image['is_primary'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
