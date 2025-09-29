<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'super admin']);
        $agency = Role::create(['name' => 'agency']);
          // Create permissions
        $viewParameters = Permission::create(['name' => 'view_parameters']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo($viewParameters);

        // Assign roles to users
        $superAdminUser = User::find(2);
        $superAdminUser->assignRole('super admin');
    }
}
