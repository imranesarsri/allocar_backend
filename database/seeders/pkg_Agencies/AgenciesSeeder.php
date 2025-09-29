<?php

namespace Database\Seeders\pkg_Agencies;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agencies')->insert([
            [
                'agency_name' => 'Casablanca Auto',
                'description' => 'Luxury car dealership based in Casablanca.',
                'address' => '23 Boulevard Zerktouni, Casablanca',
                'city' => 'Casablanca',
                'phone_fix' => '+212 522-345678', // Moroccan landline (Casablanca)
                'phone_number_1' => '+212 661-234567', // Mobile number
                'phone_number_2' => '+212 670-987654', // Mobile number
                'email' => 'contact@casablancaauto.ma',
                'website' => 'https://www.casablancaauto.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_1.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/casablancaauto',
                'instagram_url' => 'https://instagram.com/casablancaauto',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Marrakech Motors',
                'description' => 'Leading supplier of high-end vehicles in Marrakech.',
                'address' => '15 Avenue Mohammed VI, Marrakech',
                'city' => 'Marrakech',
                'phone_fix' => '+212 524-567890', // Moroccan landline (Marrakech)
                'phone_number_1' => '+212 662-345678', // Mobile number
                'phone_number_2' => null, // No second mobile
                'email' => 'info@marrakechmotors.ma',
                'website' => 'https://www.marrakechmotors.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_2.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/marrakechmotors',
                'instagram_url' => 'https://instagram.com/marrakechmotors',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Rabat Auto Sales',
                'description' => 'Trusted car dealership in Rabat specializing in new and used cars.',
                'address' => '40 Avenue Hassan II, Rabat',
                'city' => 'Rabat',
                'phone_fix' => '+212 537-123456', // Moroccan landline (Rabat)
                'phone_number_1' => '+212 663-456789', // Mobile number
                'phone_number_2' => '+212 664-567890', // Mobile number
                'email' => 'sales@rabatautosales.ma',
                'website' => 'https://www.rabatautosales.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_3.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/rabatautosales',
                'instagram_url' => 'https://instagram.com/rabatautosales',
                'other_social_media_url' => 'https://twitter.com/rabatautosales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Fes Auto Market',
                'description' => 'A top-tier car dealership in Fes, offering both new and used vehicles.',
                'address' => '12 Rue Ibn Khaldoun, Fes',
                'city' => 'Fes',
                'phone_fix' => '+212 535-678901',
                'phone_number_1' => '+212 665-789012',
                'phone_number_2' => null,
                'email' => 'contact@fesautomarket.ma',
                'website' => 'https://www.fesautomarket.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_4.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/fesautomarket',
                'instagram_url' => 'https://instagram.com/fesautomarket',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Tangier Speed Cars',
                'description' => 'Premium auto dealership in Tangier with a variety of sports and luxury cars.',
                'address' => '78 Avenue Moulay Ismail, Tangier',
                'city' => 'Tangier',
                'phone_fix' => '+212 539-123456',
                'phone_number_1' => '+212 666-890123',
                'phone_number_2' => '+212 667-901234',
                'email' => 'info@tangierspeedcars.ma',
                'website' => 'https://www.tangierspeedcars.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_5.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/tangierspeedcars',
                'instagram_url' => 'https://instagram.com/tangierspeedcars',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Agadir Auto Hub',
                'description' => 'A well-known dealership in Agadir offering high-quality used and new cars.',
                'address' => '5 Boulevard Hassan II, Agadir',
                'city' => 'Agadir',
                'phone_fix' => '+212 528-234567',
                'phone_number_1' => '+212 668-012345',
                'phone_number_2' => null,
                'email' => 'support@agadirautohub.ma',
                'website' => 'https://www.agadirautohub.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_6.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/agadirautohub',
                'instagram_url' => 'https://instagram.com/agadirautohub',
                'other_social_media_url' => 'https://twitter.com/agadirautohub',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Oujda Car Select',
                'description' => 'Oujda-based dealership with a large selection of economy and luxury vehicles.',
                'address' => '32 Rue Al Massira, Oujda',
                'city' => 'Oujda',
                'phone_fix' => '+212 536-345678',
                'phone_number_1' => '+212 669-123456',
                'phone_number_2' => null,
                'email' => 'sales@oujdacarselect.ma',
                'website' => 'https://www.oujdacarselect.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_7.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/oujdacarselect',
                'instagram_url' => 'https://instagram.com/oujdacarselect',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Meknes Drive',
                'description' => 'Reliable car dealership in Meknes with competitive prices and financing options.',
                'address' => '10 Avenue Allal Ben Abdellah, Meknes',
                'city' => 'Meknes',
                'phone_fix' => '+212 535-789012',
                'phone_number_1' => '+212 670-234567',
                'phone_number_2' => null,
                'email' => 'info@meknesdrive.ma',
                'website' => 'https://www.meknesdrive.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_8.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/meknesdrive',
                'instagram_url' => 'https://instagram.com/meknesdrive',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Kenitra Auto Elite',
                'description' => 'Kenitra’s best dealership for premium vehicles and exclusive brands.',
                'address' => '50 Route Nationale, Kenitra',
                'city' => 'Kenitra',
                'phone_fix' => '+212 537-890123',
                'phone_number_1' => '+212 671-345678',
                'phone_number_2' => null,
                'email' => 'elite@kenitraauto.ma',
                'website' => 'https://www.kenitraautoelite.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_9.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/kenitraautoelite',
                'instagram_url' => 'https://instagram.com/kenitraautoelite',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_name' => 'Nador Speed Motors',
                'description' => 'Trusted dealership in Nador, offering a variety of vehicles for every budget.',
                'address' => '8 Avenue Al Wahda, Nador',
                'city' => 'Nador',
                'phone_fix' => '+212 536-901234',
                'phone_number_1' => '+212 672-456789',
                'phone_number_2' => null,
                'email' => 'contact@nadorspeedmotors.ma',
                'website' => 'https://www.nadorspeedmotors.ma',
                'logo_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/logos/logo_10.png',
                'cover_image_url' => 'http://127.0.0.1:8000/storage/seed_images/agencies/cover/bg.svg',
                'facebook_url' => 'https://facebook.com/nadorspeedmotors',
                'instagram_url' => 'https://instagram.com/nadorspeedmotors',
                'other_social_media_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
