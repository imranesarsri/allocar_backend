<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(pkg_ConfigsSeeder::class);
        $this->call(pkg_BlogsSeeder::class);
        $this->call(pkg_ParametersSeeder::class);
        $this->call(pkg_AgenciesSeeder::class);
        $this->call(pkg_CarsSeeder::class);
        $this->call(pkg_ReviewsSeeder::class);
        $this->call(pkg_SubscriptionsSeeder::class);
        $this->call(RolePermissionSeeder::class);
    }
}
