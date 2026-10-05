<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('fasilitas')->nullable();
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->string('kontak_pengelola')->nullable();
            $table->string('status')->default('draft'); // draft / published
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('wisata'); }
};
