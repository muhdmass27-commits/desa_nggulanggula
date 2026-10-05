<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('potensi_desa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_potensi')->nullOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('pengelola')->nullable();
            $table->string('kontak')->nullable();
            $table->string('status')->default('draft'); // draft / published
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('potensi_desa'); }
};
