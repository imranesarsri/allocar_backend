<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Reviews\{
    AgencyReviewsSeeder,
    CarReviewsSeeder,
};


class pkg_ReviewsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_ReviewsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            AgencyReviewsSeeder::class,
            CarReviewsSeeder::class,
        ];
    }
}