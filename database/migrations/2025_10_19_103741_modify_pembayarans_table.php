<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Ubah tipe kolom tanggal_transfer menjadi DATETIME
            $table->dateTime('tanggal_transfer')->change();
            // Hapus kolom waktu_transfer yang sudah tidak perlu
            $table->dropColumn('waktu_transfer');
        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Kembalikan jika migrasi di-rollback
            $table->date('tanggal_transfer')->change();
            $table->time('waktu_transfer');
        });
    }
};