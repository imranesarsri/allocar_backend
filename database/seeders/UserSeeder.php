<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Agence',
                'last_name' => 'agence',
                'email' => 'agence@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User',
                'last_name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Emma',
                'last_name' => 'Smith',
                'email' => 'emma.smith@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Liam',
                'last_name' => 'Brown',
                'email' => 'liam.brown@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Olivia',
                'last_name' => 'Wilson',
                'email' => 'olivia.wilson@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Noah',
                'last_name' => 'Taylor',
                'email' => 'noah.taylor@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Sophia',
                'last_name' => 'Anderson',
                'email' => 'sophia.anderson@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Martinez',
                'email' => 'james.martinez@example.com',
                'password' => Hash::make('T5051234'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
