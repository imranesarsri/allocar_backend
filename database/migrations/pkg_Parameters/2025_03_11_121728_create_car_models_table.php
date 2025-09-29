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
        Schema::create('car_models', function (Blueprint $table) {
            $table->id('car_model_id');
            $table->unsignedBigInteger('car_brand_id');
            $table->string('model_name', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('car_brand_id')->references('car_brand_id')->on('car_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};