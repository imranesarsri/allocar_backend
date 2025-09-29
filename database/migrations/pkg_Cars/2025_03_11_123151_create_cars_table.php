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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('car_id');
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('car_brand_id');
            $table->unsignedBigInteger('car_model_id');
            $table->unsignedBigInteger('car_category_id');
            $table->unsignedBigInteger('car_color_id');
            $table->unsignedBigInteger('car_fuel_type_id');
            $table->unsignedBigInteger('car_city_id');
            $table->boolean('feature_car')->default(false);
            $table->integer('year');
            $table->integer('mileage')->nullable();
            $table->string('transmission', 20)->nullable();
            $table->string('registration_number', 20)->unique()->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->boolean('is_discount')->default(false);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->date('discount_end_date')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('agency_id')->references('agency_id')->on('agencies')->onDelete('cascade');
            $table->foreign('car_brand_id')->references('car_brand_id')->on('car_brands')->onDelete('cascade');
            $table->foreign('car_model_id')->references('car_model_id')->on('car_models')->onDelete('cascade');
            $table->foreign('car_category_id')->references('car_category_id')->on('car_categories')->onDelete('cascade');
            $table->foreign('car_color_id')->references('car_color_id')->on('car_colors')->onDelete('cascade');
            $table->foreign('car_fuel_type_id')->references('car_fuel_type_id')->on('car_fuel_types')->onDelete('cascade');
            $table->foreign('car_city_id')->references('car_city_id')->on('car_cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

