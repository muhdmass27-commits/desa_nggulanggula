<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->string('jenjang'); // contoh: SD, SMP, SMA/SMK, Diploma/S1+
            $table->unsignedInteger('jumlah')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pendidikan'); }
};
