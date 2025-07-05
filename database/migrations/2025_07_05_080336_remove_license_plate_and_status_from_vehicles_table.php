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
        Schema::table('vehicles', function (Blueprint $table) {
            // Hapus kolom license_plate dan status
            $table->dropUnique(['license_plate']);
            $table->dropColumn('license_plate');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Tambahkan kembali kolom license_plate dan status
            // Perhatikan bahwa menambahkan kembali kolom dengan unique constraint dan default value
            // di metode down() mungkin perlu penanganan khusus jika ada data,
            // namun untuk keperluan rollback skema, ini adalah pendekatan dasarnya.
            $table->string('license_plate')->unique()->after('category'); // Sesuaikan posisi jika perlu
            $table->enum('status', ['tersedia', 'disewa', 'maintenance', 'unavailable'])->default('tersedia')->after('color'); // Sesuaikan posisi jika perlu
        });
    }
};
