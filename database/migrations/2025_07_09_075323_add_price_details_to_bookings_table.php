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
            // Tambahkan kolom setelah 'total_price'
            $table->integer('sub_total_price')->after('total_price')->nullable();
            $table->integer('tax_admin_fee')->after('sub_total_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['tax_admin_fee', 'sub_total_price']);
        });
    }
};
