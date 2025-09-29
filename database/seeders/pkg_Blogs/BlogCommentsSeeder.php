<?php

namespace Database\Seeders\pkg_Blogs;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_comments')->insert([
            [
                'blog_post_id' => 1,
                'user_id' => 5,
                'content' => 'Super article, très intéressant !',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 1,
                'user_id' => 6,
                'content' => 'Merci pour ces informations, j\'ai appris beaucoup.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 2,
                'user_id' => 7,
                'content' => 'J\'adore ce sujet, hâte de lire plus d\'articles !',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 3,
                'user_id' => 8,
                'content' => 'Très bien expliqué, bravo à l\'auteur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 4,
                'user_id' => 9,
                'content' => 'Je ne suis pas totalement d\'accord avec ce point de vue.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 5,
                'user_id' => 10,
                'content' => 'Merci pour cet article détaillé, très utile !',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 6,
                'user_id' => 7,
                'content' => 'Superbe analyse, continuez comme ça !',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 7,
                'user_id' => 5,
                'content' => 'Je vais partager cet article avec mes amis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 8,
                'user_id' => 6,
                'content' => 'J\'ai une question sur un point précis, pouvez-vous m\'éclairer ?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => 9,
                'user_id' => 9,
                'content' => 'Excellent article, très bien structuré.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
