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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('category');
            $table->string('license_plate')->unique();
            $table->year('year');
            $table->string('color');
            $table->enum('status', ['tersedia', 'disewa', 'maintenance', 'unavailable'])->default('tersedia');

            $table->integer('passenger_capacity')->nullable();
            $table->enum('transmission_type', ['manual', 'automatic'])->nullable();
            $table->enum('fuel_type', ['bensin', 'diesel', 'listrik'])->nullable();
            $table->enum('features', ['ac', 'air_vent', 'helmet', 'open_tub'])->nullable();

            $table->integer('daily_price')->nullable();
            $table->integer('original_daily_price')->nullable();
            $table->integer('weekly_price')->nullable();
            $table->integer('monthly_price')->nullable();

            $table->string('engine_type')->nullable();
            $table->string('max_power')->nullable();
            $table->string('max_torque')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_efficiency')->nullable();

            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('wheelbase')->nullable();
            $table->integer('tank_capacity')->nullable();

            $table->json('additional_features')->nullable();
            $table->json('elite_features')->nullable();

            $table->text('long_description')->nullable();
            $table->text('rental_requirements')->nullable();
            $table->text('rental_terms')->nullable();
            $table->text('deposit_payment_info')->nullable();
            $table->text('prohibitions')->nullable();

            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
