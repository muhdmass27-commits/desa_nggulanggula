<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pengaturan_website', function (Blueprint $table) {
            $table->id();
            $table->string('nama_website')->nullable();
            $table->string('nama_desa')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('footer')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pengaturan_website'); }
};
