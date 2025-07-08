<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_duration_to_bookings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('duration_type')->nullable()->after('end_date');
            $table->integer('quantity')->nullable()->after('duration_type');
        });
    }
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['duration_type', 'quantity']);
        });
    }
};
