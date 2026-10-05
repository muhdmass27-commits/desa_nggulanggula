<?php
// FILE BARU: tests/Feature/Public/PublicPagesTest.php
// Smoke test: TAHAP 17 (Halaman Publik) - semua 13 halaman + sitemap/robots
// harus bisa dibuka TANPA login dan TIDAK error walau database masih kosong
// (TAHAP 17 juga mensyaratkan "jangan tampilkan data palsu jika database kosong").

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<string, array{0: string}>
     */
    public static function halamanPublik(): array
    {
        return [
            'beranda' => ['home'],
            'profil' => ['profil'],
            'pemerintahan' => ['pemerintahan'],
            'penduduk' => ['penduduk'],
            'berita' => ['berita.index'],
            'potensi' => ['potensi.index'],
            'wisata' => ['wisata.index'],
            'transparansi' => ['transparansi'],
            'galeri' => ['galeri.index'],
            'ppid' => ['ppid'],
            'pelayanan' => ['pelayanan.index'],
            'pengaduan' => ['pengaduan.index'],
            'kontak' => ['kontak'],
            'sitemap' => ['sitemap'],
        ];
    }

    /**
     * @dataProvider halamanPublik
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('halamanPublik')]
public function test_halaman_publik_bisa_dibuka_tanpa_login_walau_database_kosong(string $namaRoute): void
    {
        $response = $this->get(route($namaRoute));

        $response->assertOk();
    }

    public function test_robots_txt_melarang_crawler_mengakses_folder_admin(): void
    {
        // Catatan perbaikan: request HTTP sungguhan ke /robots.txt hanya akan
        // sampai ke Laravel kalau web server (Apache/Nginx) tidak menemukan
        // file statis itu duluan. Saat browser dibuka, web server MEMANG
        // menemukan public/robots.txt dan menyajikannya langsung - permintaan
        // itu tidak pernah sampai ke router Laravel sama sekali. Tapi client
        // test PHPUnit tidak lewat web server sungguhan, jadi ->get('/robots.txt')
        // langsung masuk ke router Laravel, tidak ada route terdaftar untuk
        // itu, hasilnya 404 - BUKAN karena filenya tidak ada atau rusak.
        //
        // Makanya pengujian yang benar untuk file statis ini adalah membaca
        // isinya langsung dari disk, bukan lewat HTTP - ini menguji isi file
        // yang sama persis dengan yang disajikan web server ke pengunjung.
        $path = public_path('robots.txt');

        $this->assertFileExists($path);
        $this->assertStringContainsString('Disallow: /admin/', file_get_contents($path));
    }

    public function test_halaman_tidak_ditemukan_menampilkan_404_sesuai_desain(): void
    {
        $response = $this->get('/halaman-yang-tidak-pernah-ada');

        $response->assertNotFound();
        $response->assertSee('Halaman Tidak Ditemukan');
    }
}
