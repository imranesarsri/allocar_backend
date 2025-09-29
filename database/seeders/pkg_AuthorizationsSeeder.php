<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Authorizations\{
    ExampleSeeder,
// MissionPersonnelSeeder,
// TransportsSeeder,
// MoyensTransportsSeeder,
};


class pkg_AuthorizationsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_AuthorizationsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            // ExampleSeeder::class,
            // MissionPersonnelSeeder::class,
            // MoyensTransportsSeeder::class,
            // TransportsSeeder::class,
        ];
    }
}