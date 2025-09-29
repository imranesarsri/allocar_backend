<?php

namespace Database\Seeders\pkg_Reviews;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('car_reviews')->insert([
            [
                'car_id' => 1,
                'user_id' => 1,
                'rating' => 5,
                'review_text' => 'Voiture très confortable et agréable à conduire.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 1,
                'user_id' => 2,
                'rating' => 4,
                'review_text' => 'Bonne voiture, mais la consommation est un peu élevée.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'user_id' => 3,
                'rating' => 3,
                'review_text' => 'Correcte mais pas exceptionnelle.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'user_id' => 4,
                'rating' => 5,
                'review_text' => 'Très satisfait, parfait pour la ville.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 3,
                'user_id' => 5,
                'rating' => 2,
                'review_text' => 'Déçu par la performance du moteur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 3,
                'user_id' => 6,
                'rating' => 4,
                'review_text' => 'Bonne tenue de route, mais intérieur un peu basique.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 4,
                'user_id' => 7,
                'rating' => 5,
                'review_text' => 'Super voiture, idéale pour les longs trajets.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 4,
                'user_id' => 8,
                'rating' => 3,
                'review_text' => 'Bonne voiture mais entretien un peu coûteux.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 5,
                'user_id' => 9,
                'rating' => 1,
                'review_text' => 'Très mauvaise expérience, trop de pannes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 5,
                'user_id' => 10,
                'rating' => 5,
                'review_text' => 'Excellente voiture, rapport qualité/prix imbattable.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
