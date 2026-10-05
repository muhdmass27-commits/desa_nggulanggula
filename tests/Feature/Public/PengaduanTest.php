<?php
// FILE BARU: tests/Feature/Public/PengaduanTest.php
// Menguji TAHAP 12 (Pengaduan): masyarakat mengirim tanpa login, data
// tersimpan ke database, dan validasi aktif.

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengaduanTest extends TestCase
{
    use RefreshDatabase;

    public function test_masyarakat_dapat_mengirim_pengaduan_tanpa_login_dan_tersimpan_ke_database(): void
    {
        $response = $this->post(route('pengaduan.store'), [
            'nama' => 'Warga Uji Coba',
            'telepon' => '081234567890',
            'kategori' => 'Kebersihan',
            'isi' => 'Tumpukan sampah belum diangkut selama seminggu di dekat pasar.',
        ]);

        $response->assertRedirect(route('pengaduan.index'));
        $this->assertDatabaseHas('pengaduan', [
            'nama' => 'Warga Uji Coba',
            'kategori' => 'Kebersihan',
            'status' => 'menunggu',
        ]);
    }

    public function test_pengaduan_ditolak_jika_isi_terlalu_pendek(): void
    {
        $response = $this->post(route('pengaduan.store'), [
            'nama' => 'Warga Uji Coba',
            'telepon' => '081234567890',
            'kategori' => 'Umum',
            'isi' => 'pendek',
        ]);

        $response->assertSessionHasErrors('isi');
        $this->assertDatabaseCount('pengaduan', 0);
    }

    public function test_honeypot_anti_spam_diam_diam_menolak_tanpa_error_mencurigakan(): void
    {
        $response = $this->post(route('pengaduan.store'), [
            'nama' => 'Bot Spam',
            'telepon' => '0800000000',
            'kategori' => 'Umum',
            'isi' => 'Pesan spam otomatis dari bot pengisi form.',
            'website' => 'http://spam.example.com', // field honeypot tersembunyi, harus kosong
        ]);

        $response->assertRedirect(route('pengaduan.index'));
        $this->assertDatabaseCount('pengaduan', 0);
    }

    public function test_admin_dapat_mengubah_status_dan_memberi_tanggapan(): void
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        $pengaduan = \App\Models\Pengaduan::create([
            'nomor_pengaduan' => 'PGD-TEST-0001',
            'nama' => 'Warga', 'telepon' => '0812', 'kategori' => 'Umum',
            'isi' => 'Isi pengaduan uji.', 'status' => 'menunggu',
        ]);

        $this->actingAs($admin)->put(route('admin.pengaduan.update', $pengaduan), [
            'status' => 'selesai',
            'tanggapan' => 'Sudah ditindaklanjuti oleh petugas desa.',
        ])->assertRedirect(route('admin.pengaduan.show', $pengaduan));

        $this->assertDatabaseHas('pengaduan', [
            'id' => $pengaduan->id, 'status' => 'selesai',
            'tanggapan' => 'Sudah ditindaklanjuti oleh petugas desa.',
        ]);
    }
}
