<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ppid', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori'); // Informasi Berkala / Informasi Setiap Saat / Informasi Serta Merta / Dasar Hukum
            $table->longText('deskripsi')->nullable();
            $table->string('file')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('status')->default('published'); // draft / published
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ppid'); }
};
