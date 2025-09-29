<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agency_reviews', function (Blueprint $table) {
            $table->id('agency_review_id');
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rating')->check('rating BETWEEN 1 AND 5');
            $table->text('review_text')->nullable();
            $table->timestamps();

            $table->foreign('agency_id')->references('agency_id')->on('agencies')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_reviews');
    }
};
