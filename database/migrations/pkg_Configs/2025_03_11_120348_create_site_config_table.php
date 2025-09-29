<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_config', function (Blueprint $table) {
            $table->id('config_id');

            // Basic Site Information
            $table->string('site_name', 255);
            $table->text('site_description')->nullable();
            $table->string('site_logo', 255)->nullable();
            $table->string('site_logo_dark', 255)->nullable();
            $table->string('favicon_url', 255)->nullable();
            $table->string('site_primary_color', 7)->nullable(); // Code couleur HEX (#FFFFFF)

            // Meta Information for SEO
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();

            // Contact Information
            $table->string('site_email', 100)->nullable();
            $table->string('contact_form_email', 100)->nullable();
            $table->string('support_email', 100)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('map_url', 255)->nullable();

            // Social Media Links
            $table->string('social_media_facebook', 100)->nullable();
            $table->string('social_media_instagram', 100)->nullable();
            $table->string('social_media_twitter', 100)->nullable();

            // Language & Regional Settings
            $table->enum('default_language', ['en', 'ar', 'fr', 'es'])->default('en');

            // Site Status
            $table->enum('site_status', ['live', 'maintenance', 'coming_soon'])->default('live');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_config');
    }
};