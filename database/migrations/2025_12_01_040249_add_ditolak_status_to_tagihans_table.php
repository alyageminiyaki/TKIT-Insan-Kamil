<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah enum status untuk menambahkan 'ditolak'
        DB::statement("ALTER TABLE tagihans MODIFY COLUMN status ENUM('belum_lunas', 'menunggu_verifikasi', 'lunas', 'ditolak') DEFAULT 'belum_lunas'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum sebelumnya
        DB::statement("ALTER TABLE tagihans MODIFY COLUMN status ENUM('belum_lunas', 'menunggu_verifikasi', 'lunas') DEFAULT 'belum_lunas'");
    }
};
