<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kepala_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('jabatan')->default('Kepala Desa');
            $table->string('nip')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->string('status')->default('aktif'); // aktif / nonaktif
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kepala_desa'); }
};
