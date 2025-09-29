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
        Schema::create('agency_subscriptions', function (Blueprint $table) {
            $table->id('subscription_id');
            $table->unsignedBigInteger('agency_id');
            $table->unsignedBigInteger('package_id');
            $table->timestamp('start_date')->default(now());
            $table->timestamp('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('current_car_count')->default(0);
            $table->timestamps();

            $table->foreign('agency_id')->references('agency_id')->on('agencies')->onDelete('cascade');
            $table->foreign('package_id')->references('package_id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_subscriptions');
    }
};