<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('data_penduduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedInteger('jumlah_penduduk')->default(0);
            $table->unsignedInteger('jumlah_kk')->default(0);
            $table->unsignedInteger('laki_laki')->default(0);
            $table->unsignedInteger('perempuan')->default(0);
            $table->unsignedInteger('jumlah_dusun')->default(0);
            $table->unsignedInteger('jumlah_rt')->default(0);
            $table->unsignedInteger('jumlah_rw')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('data_penduduk'); }
};
