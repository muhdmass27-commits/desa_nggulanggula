<?php
// FILE BARU: tests/Feature/Admin/UserManagementTest.php
// Menguji proteksi anti-lockout pada fitur Pengguna Admin (Tahap 8):
// admin tidak boleh mengunci dirinya sendiri atau menghilangkan SEMUA
// akses admin dari sistem.

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dapat_membuat_akun_admin_baru(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $response = $this->actingAs($admin)->post(route('admin.pengguna.store'), [
            'name' => 'Admin Kedua',
            'email' => 'admin2@nggulangula.desa.id',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'status' => 'aktif',
        ]);

        $response->assertRedirect(route('admin.pengguna.index'));
        $this->assertDatabaseHas('users', ['email' => 'admin2@nggulangula.desa.id', 'role' => 'admin']);
    }

    public function test_admin_tidak_dapat_menonaktifkan_akun_miliknya_sendiri(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $response = $this->actingAs($admin)->put(route('admin.pengguna.update', $admin), [
            'name' => $admin->name,
            'email' => $admin->email,
            'status' => 'nonaktif',
        ]);

        $response->assertSessionHasErrors('status');
        $this->assertDatabaseHas('users', ['id' => $admin->id, 'status' => 'aktif']);
    }

    public function test_admin_tidak_dapat_menghapus_akun_miliknya_sendiri(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $response = $this->actingAs($admin)->delete(route('admin.pengguna.destroy', $admin));

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_tamu_atau_akun_nonaktif_tidak_bisa_mencapai_fitur_pengguna_sama_sekali(): void
    {
        // Catatan desain: karena aturan "tidak bisa menonaktifkan diri sendiri"
        // sudah wajib berlaku (test di atas), dan hanya admin BERSTATUS AKTIF
        // yang bisa melewati middleware untuk sampai ke controller ini, maka
        // secara matematis jumlah admin aktif tidak akan pernah mencapai nol
        // lewat jalur aplikasi biasa - pelaku selalu tersisa sebagai admin aktif.
        // Pengecekan "admin aktif terakhir" di controller tetap dipertahankan
        // sebagai lapis pengaman tambahan (defense-in-depth), tapi jalur
        // "dihalangi karena admin aktif terakhir" ini secara realistis hanya
        // bisa dipicu lewat akses langsung ke database/Tinker, bukan lewat
        // form web - jadi tidak diuji sebagai skenario HTTP di sini.
        //
        // Yang justru WAJIB diuji dan memang reachable: akun nonaktif atau
        // tamu sama sekali tidak bisa membuka fitur Pengguna.
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        $nonaktif = User::factory()->create(['role' => 'admin', 'status' => 'nonaktif']);

        $this->get(route('admin.pengguna.index'))->assertRedirect(route('admin.login'));

        $this->actingAs($nonaktif)
            ->get(route('admin.pengguna.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_boleh_menonaktifkan_admin_lain_selama_masih_ada_admin_aktif_lainnya(): void
    {
        $pelaku = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        $targetAdmin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $response = $this->actingAs($pelaku)->put(route('admin.pengguna.update', $targetAdmin), [
            'name' => $targetAdmin->name,
            'email' => $targetAdmin->email,
            'status' => 'nonaktif',
        ]);

        $response->assertRedirect(route('admin.pengguna.index'));
        $this->assertDatabaseHas('users', ['id' => $targetAdmin->id, 'status' => 'nonaktif']);
    }

    public function test_email_duplikat_ditolak_saat_membuat_admin_baru(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);
        $lainnya = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.pengguna.store'), [
            'name' => 'Percobaan Duplikat',
            'email' => $lainnya->email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'status' => 'aktif',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
