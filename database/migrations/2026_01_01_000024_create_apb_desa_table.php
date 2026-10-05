<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('apb_desa', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->string('kategori'); // Pendapatan / Belanja / Pembiayaan
            $table->string('subkategori')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->bigInteger('anggaran')->default(0);
            $table->bigInteger('realisasi')->default(0);
            $table->longText('keterangan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('apb_desa'); }
};
