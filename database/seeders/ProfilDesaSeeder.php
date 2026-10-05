<?php
namespace Database\Seeders;

use App\Models\ProfilDesa;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    // Hanya lokasi administratif yang sudah pasti benar (sesuai permintaan Anda)
    // yang diisi. Field lain sengaja dikosongkan (NULL) / "Data belum tersedia"
    // supaya tidak ada data resmi desa yang dikarang. Admin mengisinya lewat
    // Dashboard Admin -> Profil Desa (Tahap 3-4).
    public function run(): void
    {
        ProfilDesa::updateOrCreate(
            ['id' => 1],
            [
                'nama_desa' => 'Desa Nggulanggula',
                'kecamatan' => 'Siompu',
                'kabupaten' => 'Buton Selatan',
                'provinsi' => 'Sulawesi Tenggara',
                'kode_pos' => null,
                'alamat' => null,
                'email' => null,
                'telepon' => null,
                'whatsapp' => null,
                'website' => null,
                'logo' => null,
                'foto_kantor' => null,
                'sejarah' => 'Data belum tersedia',
                'visi' => 'Data belum tersedia',
                'misi' => 'Data belum tersedia',
                'kondisi_geografis' => 'Data belum tersedia',
                'luas_wilayah' => null,
                'batas_utara' => null,
                'batas_selatan' => null,
                'batas_timur' => null,
                'batas_barat' => null,
                'latitude' => null,
                'longitude' => null,
            ]
        );
    }
}
