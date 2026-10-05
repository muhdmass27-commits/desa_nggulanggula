<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('album_galeri', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->longText('deskripsi')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('album_galeri'); }
};
