<?php

namespace Database\Seeders\pkg_Blogs;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_tags')->insert([
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Posts related to the latest technology trends.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health',
                'slug' => 'health',
                'description' => 'Articles covering health and wellness topics.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'description' => 'Financial insights, tips, and investment strategies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Advice and insights for entrepreneurs and businesses.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Exploring destinations and travel experiences.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => 'Cooking recipes, restaurant reviews, and food trends.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Guides and resources for learning and development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'News and updates from the world of sports.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Movies, music, and pop culture discussions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Discoveries and innovations in science.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
