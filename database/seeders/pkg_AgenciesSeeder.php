<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Agencies\{
    AgenciesSeeder,
};


class pkg_AgenciesSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_AgenciesSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            AgenciesSeeder::class,
        ];
    }
}
