<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->string('foto_kantor')->nullable();
            $table->longText('sejarah')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('kondisi_geografis')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('batas_barat')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('profil_desa'); }
};
