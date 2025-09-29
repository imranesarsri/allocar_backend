<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\pkg_Blogs\{
    BlogAuthorsSeeder,
    BlogCategoriesSeeder,
    BlogTagsSeeder,
    BlogPostsSeeder,
    BlogPostTagsSeeder,
    BlogCommentsSeeder,
};


class pkg_BlogsSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(pkg_BlogsSeeder::Classes());
    }

    public static function Classes(): array
    {
        return [
            BlogAuthorsSeeder::class,
            BlogCategoriesSeeder::class,
            BlogTagsSeeder::class,
            BlogPostsSeeder::class,
            BlogPostTagsSeeder::class,
            BlogCommentsSeeder::class,
        ];
    }
}
