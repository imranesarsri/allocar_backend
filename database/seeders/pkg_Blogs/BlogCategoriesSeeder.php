<?php

namespace Database\Seeders\pkg_Blogs;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_categories')->insert([
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest updates and trends in technology.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health & Wellness',
                'slug' => 'health-wellness',
                'description' => 'Tips and insights for a healthy lifestyle.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Financial advice, investment, and money management.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Guides and news on business and startups.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Explore new destinations and travel tips.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => 'Recipes, food reviews, and cooking tips.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'News, updates, and analysis on sports events.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Articles on learning and academic success.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Movies, music, and pop culture updates.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Scientific discoveries and research insights.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
