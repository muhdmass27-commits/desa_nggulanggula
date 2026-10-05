<?php
namespace Database\Seeders;

use App\Models\PengaturanWebsite;
use Illuminate\Database\Seeder;

class PengaturanWebsiteSeeder extends Seeder
{
    public function run(): void
    {
        PengaturanWebsite::updateOrCreate(
            ['id' => 1],
            [
                'nama_website' => 'Website Resmi Desa Nggulanggula',
                'nama_desa' => 'Desa Nggulanggula',
                'tagline' => null,
                'logo' => null,
                'favicon' => null,
                'deskripsi' => null,
                'footer' => null,
            ]
        );
    }
}
