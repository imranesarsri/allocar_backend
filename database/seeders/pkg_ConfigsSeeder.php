<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Configs\{
    SiteConfigSeeder,
};


class pkg_ConfigsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_ConfigsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            SiteConfigSeeder::class,
        ];
    }
}
