<?php
// GANTI SELURUH ISI FILE database/seeders/DatabaseSeeder.php bawaan dengan ini.

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ProfilDesaSeeder::class,
            KontakSeeder::class,
            PengaturanWebsiteSeeder::class,
            KategoriBeritaSeeder::class,
            KategoriPotensiSeeder::class,
        ]);
    }
}
