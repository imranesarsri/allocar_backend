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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id('agency_id');
            $table->string('agency_name', 100)->unique();
            $table->text('description')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('phone_fix', 20);
            $table->string('phone_number_1', 20);
            $table->string('phone_number_2', 20)->nullable();
            $table->string('email', 100);
            $table->string('website', 100)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->string('cover_image_url', 255)->nullable();
            $table->string('facebook_url', 100)->nullable();
            $table->string('instagram_url', 100)->nullable();
            $table->string('other_social_media_url', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
