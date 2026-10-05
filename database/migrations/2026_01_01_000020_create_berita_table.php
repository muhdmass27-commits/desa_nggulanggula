<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_berita')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan')->nullable();
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->date('tanggal_publish')->nullable();
            $table->string('status')->default('draft'); // draft / published
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('berita'); }
};
