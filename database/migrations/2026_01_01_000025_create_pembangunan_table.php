<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pembangunan', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->string('nama_program');
            $table->string('lokasi')->nullable();
            $table->bigInteger('anggaran')->default(0);
            $table->string('sumber_dana')->nullable();
            $table->unsignedTinyInteger('progress')->default(0); // 0-100 (%)
            $table->string('status')->default('berjalan'); // berjalan / selesai / direncanakan
            $table->string('foto')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('pembangunan'); }
};
