<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengaduan')->unique();
            $table->string('nama');
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->string('kategori');
            $table->string('judul')->nullable();
            $table->longText('isi');
            $table->string('lokasi')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('status')->default('menunggu'); // menunggu/diproses/selesai/ditolak
            $table->longText('tanggapan')->nullable();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pengaduan'); }
};
