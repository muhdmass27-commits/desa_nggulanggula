<?php
// FILE BARU (migration ALTER, bukan tabel baru).
// Alasan: tabel kepala_desa dari Tahap 2 belum punya kolom 'periode' (masa
// jabatan) dan 'sambutan' (teks sambutan untuk beranda) yang diminta di
// Tahap 4 Bagian 2. Kolom lain (nama, foto, jabatan, status) sudah ada.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('kepala_desa', function (Blueprint $table) {
            $table->string('periode')->nullable()->after('jabatan');
            $table->longText('sambutan')->nullable()->after('deskripsi');
        });
    }
    public function down(): void {
        Schema::table('kepala_desa', function (Blueprint $table) {
            $table->dropColumn(['periode', 'sambutan']);
        });
    }
};
