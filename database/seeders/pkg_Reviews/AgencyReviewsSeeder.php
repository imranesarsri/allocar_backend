<?php

namespace Database\Seeders\pkg_Reviews;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencyReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agency_reviews')->insert([
            [
                'agency_id' => 1,
                'user_id' => 1,
                'rating' => 5,
                'review_text' => 'Service excellent et très professionnel.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 1,
                'user_id' => 2,
                'rating' => 4,
                'review_text' => 'Très bon service, mais un peu d\'attente.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 2,
                'user_id' => 3,
                'rating' => 3,
                'review_text' => 'Expérience moyenne, peut être améliorée.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 2,
                'user_id' => 4,
                'rating' => 5,
                'review_text' => 'Rapide, efficace et personnel très sympathique.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 3,
                'user_id' => 5,
                'rating' => 2,
                'review_text' => 'Déçu par le service client.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 3,
                'user_id' => 6,
                'rating' => 4,
                'review_text' => 'Bonne expérience globale, quelques améliorations possibles.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 4,
                'user_id' => 7,
                'rating' => 5,
                'review_text' => 'Un des meilleurs services que j\'ai eus.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 4,
                'user_id' => 8,
                'rating' => 3,
                'review_text' => 'Bon service mais manque de communication.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 5,
                'user_id' => 9,
                'rating' => 1,
                'review_text' => 'Très mauvaise expérience, je ne recommande pas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 5,
                'user_id' => 10,
                'rating' => 5,
                'review_text' => 'Service impeccable, je reviendrai.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}