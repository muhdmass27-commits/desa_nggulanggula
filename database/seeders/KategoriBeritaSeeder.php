<?php
namespace Database\Seeders;

use App\Models\KategoriBerita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Pemerintahan','Kegiatan Desa','Pembangunan','Sosial','Masyarakat','Pengumuman'] as $nama) {
            KategoriBerita::updateOrCreate(['slug' => Str::slug($nama)], ['nama' => $nama]);
        }
    }
}
