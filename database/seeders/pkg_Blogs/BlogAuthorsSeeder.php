<?php

namespace Database\Seeders\pkg_Blogs;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogAuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_authors')->insert([
            [
                'name' => 'John Doe',
                'bio' => 'John is a passionate writer about technology and innovation.',
                'email' => 'john.doe@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'bio' => 'Jane specializes in blogging about health and wellness.',
                'email' => 'jane.smith@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alex Johnson',
                'bio' => 'Alex writes about finance and entrepreneurship.',
                'email' => 'alex.johnson@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emma Williams',
                'bio' => 'Emma is an expert in digital marketing and SEO.',
                'email' => 'emma.williams@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Brown',
                'bio' => 'Michael covers news about artificial intelligence.',
                'email' => 'michael.brown@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sophia Davis',
                'bio' => 'Sophia writes travel blogs and adventure stories.',
                'email' => 'sophia.davis@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daniel Wilson',
                'bio' => 'Daniel is a tech reviewer and gadget enthusiast.',
                'email' => 'daniel.wilson@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Olivia Martinez',
                'bio' => 'Olivia shares tips on personal development and productivity.',
                'email' => 'olivia.martinez@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'William Anderson',
                'bio' => 'William covers business strategies and leadership tips.',
                'email' => 'william.anderson@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Thomas',
                'bio' => 'Emily blogs about psychology and mental health awareness.',
                'email' => 'emily.thomas@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
