<?php
// FILE BARU: tests/Feature/Admin/BeritaCrudTest.php
// Menguji CRUD Berita dari sisi Admin, SEKALIGUS alur
// ADMIN -> DATABASE -> HALAMAN PUBLIK (TAHAP 18) untuk status draft/published.

namespace Tests\Feature\Admin;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeritaCrudTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
    }

    public function test_admin_dapat_menambah_berita_dan_langsung_tersimpan_ke_database(): void
    {
        $kategori = KategoriBerita::create(['nama' => 'Kegiatan Desa', 'slug' => 'kegiatan-desa']);

        $response = $this->actingAs($this->admin())->post(route('admin.berita.store'), [
            'kategori_id' => $kategori->id,
            'judul' => 'Gotong Royong Warga',
            'ringkasan' => 'Ringkasan singkat kegiatan.',
            'isi' => 'Isi lengkap berita gotong royong warga desa.',
            'tanggal_publish' => now()->format('Y-m-d'),
            'status' => 'draft',
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        $this->assertDatabaseHas('berita', [
            'judul' => 'Gotong Royong Warga',
            'status' => 'draft',
        ]);
    }

    public function test_validasi_menolak_berita_tanpa_judul(): void
    {
        $response = $this->actingAs($this->admin())->post(route('admin.berita.store'), [
            'isi' => 'Isi berita tanpa judul.',
            'status' => 'draft',
        ]);

        $response->assertSessionHasErrors('judul');
        $this->assertDatabaseCount('berita', 0);
    }

    public function test_berita_draft_tidak_tampil_di_halaman_publik_dan_detailnya_404(): void
    {
        $berita = Berita::create([
            'judul' => 'Berita Draft', 'slug' => 'berita-draft', 'isi' => 'Isi berita draft.',
            'status' => 'draft', 'tanggal_publish' => now(),
        ]);

        $this->get(route('berita.index'))->assertDontSee('Berita Draft');
        $this->get(route('berita.show', $berita))->assertNotFound();
    }

    public function test_berita_published_tampil_di_halaman_publik_dan_bisa_dibuka(): void
    {
        $berita = Berita::create([
            'judul' => 'Berita Terbit', 'slug' => 'berita-terbit', 'isi' => 'Isi berita yang sudah terbit.',
            'status' => 'published', 'tanggal_publish' => now(),
        ]);

        $this->get(route('berita.index'))->assertSee('Berita Terbit');
        $this->get(route('berita.show', $berita))->assertOk()->assertSee('Berita Terbit');
    }

    public function test_admin_edit_judul_berita_langsung_berubah_di_halaman_publik(): void
    {
        $berita = Berita::create([
            'judul' => 'Judul Lama', 'slug' => 'judul-lama', 'isi' => 'Isi berita.',
            'status' => 'published', 'tanggal_publish' => now(),
        ]);

        $this->actingAs($this->admin())->put(route('admin.berita.update', $berita), [
            'judul' => 'Judul Baru Setelah Diedit',
            'isi' => 'Isi berita.',
            'status' => 'published',
        ])->assertRedirect(route('admin.berita.index'));

        $this->get(route('berita.index'))->assertSee('Judul Baru Setelah Diedit');
    }

    public function test_admin_hapus_berita_hilang_dari_database_dan_halaman_publik(): void
    {
        $berita = Berita::create([
            'judul' => 'Berita Akan Dihapus', 'slug' => 'berita-akan-dihapus', 'isi' => 'Isi.',
            'status' => 'published', 'tanggal_publish' => now(),
        ]);

        $this->actingAs($this->admin())
            ->delete(route('admin.berita.destroy', $berita))
            ->assertRedirect(route('admin.berita.index'));

        $this->assertDatabaseMissing('berita', ['id' => $berita->id]);
        $this->get(route('berita.index'))->assertDontSee('Berita Akan Dihapus');
    }

    public function test_tamu_tidak_bisa_mengakses_crud_berita_admin(): void
    {
        $this->get(route('admin.berita.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.berita.create'))->assertRedirect(route('admin.login'));
    }
}
