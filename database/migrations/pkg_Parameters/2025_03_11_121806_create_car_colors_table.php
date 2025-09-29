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
        Schema::create('car_colors', function (Blueprint $table) {
            $table->id('car_color_id');
            $table->string('color_name', 30)->unique();
            $table->string('color_code', 10)->nullable(); // For hex codes like #FF5733
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_colors');
    }
};