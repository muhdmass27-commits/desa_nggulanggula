<?php
namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    // Semua field dikosongkan - belum ada data resmi kontak desa yang diberikan.
    // Diisi Admin melalui Dashboard Admin -> Kontak.
    public function run(): void
    {
        Kontak::updateOrCreate(['id' => 1], []);
    }
}
