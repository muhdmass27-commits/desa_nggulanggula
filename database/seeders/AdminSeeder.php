<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Password sementara: lihat PANDUAN-TAHAP2.md.
        // WAJIB diganti setelah login pertama kali (fitur ganti password
        // akan dibuat di Tahap 3 - Admin Authentication).
        User::updateOrCreate(
            ['email' => 'admin@nggulangula.desa.id'],
            [
                'name' => 'Administrator Desa Nggulanggula',
                'password' => Hash::make('NggulaAdmin!2026'),
                'role' => 'admin',
                'status' => 'aktif',
            ]
        );
    }
}
