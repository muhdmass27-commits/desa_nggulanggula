<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->nullable()->constrained('album_galeri')->nullOnDelete();
            $table->string('judul')->nullable();
            $table->string('file'); // path file gambar/video di storage
            $table->string('tipe')->default('image'); // image / video
            $table->longText('deskripsi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('galeri'); }
};
