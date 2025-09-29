<?php

namespace Database\Seeders\pkg_Configs;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_config')->insert([
            'site_name' => 'My Awesome Site',
            'site_description' => 'The best platform for amazing content.',
            'site_logo' => 'http://127.0.0.1:8000/storage/site_config/alocar.png',
            'site_logo_dark' => 'images/site_logo_dark.png',
            'favicon_url' => 'images/favicon.ico',
            'site_primary_color' => '#007bff',

            // Meta Information
            'meta_title' => 'Welcome to My Awesome Site',
            'meta_description' => 'Discover amazing content and experiences on My Awesome Site.',

            // Contact Information
            'site_email' => 'info@myawesomesite.com',
            'contact_form_email' => 'contact@myawesomesite.com',
            'support_email' => 'support@myawesomesite.com',
            'contact_phone' => '+212 600-123456',
            'address' => '123 Boulevard Hassan II, Casablanca, Morocco',
            'map_url' => 'https://goo.gl/maps/example',

            // Social Media Links
            'social_media_facebook' => 'https://facebook.com/myawesomesite',
            'social_media_instagram' => 'https://instagram.com/myawesomesite',
            'social_media_twitter' => 'https://twitter.com/myawesomesite',

            // Language & Regional Settings
            'default_language' => 'en',

            // Site Status
            'site_status' => 'live',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}