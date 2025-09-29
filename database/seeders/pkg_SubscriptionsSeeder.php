<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Subscriptions\{
    AgencySubscriptionsSeeder,
    PackagesSeeder,
};


class pkg_SubscriptionsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_SubscriptionsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            PackagesSeeder::class,
            AgencySubscriptionsSeeder::class ,
        ];
    }
}
