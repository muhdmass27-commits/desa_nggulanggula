<?php
// FILE BARU (migration ALTER, bukan tabel baru).
// Alasan: tabel perangkat_desa dari Tahap 2 belum punya kolom 'bidang'
// (bidang tugas) yang diminta di Tahap 4 Bagian 2.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('perangkat_desa', function (Blueprint $table) {
            $table->string('bidang')->nullable()->after('jabatan');
        });
    }
    public function down(): void {
        Schema::table('perangkat_desa', function (Blueprint $table) {
            $table->dropColumn('bidang');
        });
    }
};
