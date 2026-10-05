<?php
namespace Database\Seeders;

use App\Models\KategoriPotensi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriPotensiSeeder extends Seeder
{
    public function run(): void
    {
        $list = ['Pertanian','Perikanan','Perkebunan','Peternakan','UMKM','Kerajinan','Produk Lokal','Sumber Daya Alam'];
        foreach ($list as $nama) {
            KategoriPotensi::updateOrCreate(['slug' => Str::slug($nama)], ['nama' => $nama]);
        }
    }
}
