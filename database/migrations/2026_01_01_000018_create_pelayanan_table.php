<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->longText('persyaratan')->nullable();
            $table->longText('prosedur')->nullable();
            $table->string('waktu_pelayanan')->nullable();
            $table->string('biaya')->nullable();
            $table->string('kontak')->nullable();
            $table->string('status')->default('aktif'); // aktif / nonaktif
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pelayanan'); }
};
