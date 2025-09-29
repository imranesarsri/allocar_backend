<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Cars\{
    CarsSeeder,
    CarImagesSeeder,

};


class pkg_CarsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_CarsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            CarsSeeder::class,
            CarImagesSeeder::class,
        ];
    }
}
