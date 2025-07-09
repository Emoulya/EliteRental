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
        Schema::table('bookings', function (Blueprint $table) {
            // Tambahkan indeks untuk kolom yang mungkin sering difilter atau dicari
            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('user_id');
            $table->index('vehicle_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Hapus indeks saat rollback
            $table->dropIndex(['status']);
            $table->dropIndex(['start_date']);
            $table->dropIndex(['end_date']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['vehicle_unit_id']);
        });
    }
};
