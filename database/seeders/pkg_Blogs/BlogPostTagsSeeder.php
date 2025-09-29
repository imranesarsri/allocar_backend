<?php

namespace Database\Seeders\pkg_Blogs;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogPostTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_post_tags')->insert([
            ['blog_post_id' => 1, 'blog_tag_id' => 1],
            ['blog_post_id' => 1, 'blog_tag_id' => 3],
            ['blog_post_id' => 2, 'blog_tag_id' => 2],
            ['blog_post_id' => 2, 'blog_tag_id' => 4],
            ['blog_post_id' => 3, 'blog_tag_id' => 3],
            ['blog_post_id' => 3, 'blog_tag_id' => 5],
            ['blog_post_id' => 4, 'blog_tag_id' => 4],
            ['blog_post_id' => 4, 'blog_tag_id' => 6],
            ['blog_post_id' => 5, 'blog_tag_id' => 5],
            ['blog_post_id' => 5, 'blog_tag_id' => 7],
            ['blog_post_id' => 6, 'blog_tag_id' => 6],
            ['blog_post_id' => 6, 'blog_tag_id' => 8],
            ['blog_post_id' => 7, 'blog_tag_id' => 7],
            ['blog_post_id' => 7, 'blog_tag_id' => 9],
            ['blog_post_id' => 8, 'blog_tag_id' => 8],
            ['blog_post_id' => 8, 'blog_tag_id' => 10],
            ['blog_post_id' => 9, 'blog_tag_id' => 9],
            ['blog_post_id' => 9, 'blog_tag_id' => 1],
            ['blog_post_id' => 10, 'blog_tag_id' => 10],
            ['blog_post_id' => 10, 'blog_tag_id' => 2],
        ]);
    }

}
