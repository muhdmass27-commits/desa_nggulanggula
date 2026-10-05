<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kelompok_umur', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->string('rentang_usia'); // contoh: 0-14, 15-24, dst
            $table->unsignedInteger('jumlah')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kelompok_umur'); }
};
