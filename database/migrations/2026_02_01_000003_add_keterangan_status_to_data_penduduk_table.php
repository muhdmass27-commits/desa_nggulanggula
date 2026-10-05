<?php
// FILE BARU (migration ALTER, bukan tabel baru).
// Alasan: tabel data_penduduk dari Tahap 2 hanya menyimpan angka statistik
// per tahun, belum punya kolom 'keterangan' dan 'status' yang diminta di
// Tahap 4 Bagian 2 (status dipakai untuk menandai data tahun mana yang
// sedang ditampilkan di halaman publik nantinya di Tahap 5).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('data_penduduk', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->after('jumlah_rw');
            $table->string('status')->default('aktif')->after('keterangan'); // aktif / nonaktif
        });
    }
    public function down(): void {
        Schema::table('data_penduduk', function (Blueprint $table) {
            $table->dropColumn(['keterangan', 'status']);
        });
    }
};
