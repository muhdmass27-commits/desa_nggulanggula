<?php
// FILE BARU: tests/Feature/Admin/AuthTest.php
// Menguji alur login/logout admin dan middleware perlindungan - TAHAP 28
// (Regression Test) & TAHAP 27 (Keamanan) dari spesifikasi Anda.

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_tidak_bisa_membuka_dashboard_dan_diarahkan_ke_login(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_aktif_bisa_login_dengan_kredensial_benar(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'aktif',
            'password' => Hash::make('password-benar'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password-benar',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_login_gagal_dengan_password_salah(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'aktif',
            'password' => Hash::make('password-benar'),
        ]);

        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password-salah',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_akun_nonaktif_ditolak_walau_password_benar(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'nonaktif',
            'password' => Hash::make('password-benar'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'password-benar',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_yang_sudah_login_bisa_membuka_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertOk();
        $response->assertSee('Ringkasan');
    }

    public function test_logout_menghapus_session_sehingga_dashboard_tidak_bisa_dibuka_lagi(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        $this->actingAs($admin)->post('/admin/logout')
            ->assertRedirect(route('admin.login'));

        $this->assertGuest();
        $this->get('/admin/dashboard')->assertRedirect(route('admin.login'));
    }

    public function test_rate_limit_memblokir_setelah_enam_kali_percobaan_login_salah(): void
    {
        $admin = User::factory()->create(['role' => 'admin', 'status' => 'aktif']);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', ['email' => $admin->email, 'password' => 'salah']);
        }

        $response = $this->post('/admin/login', ['email' => $admin->email, 'password' => 'salah']);

        $response->assertStatus(429);
    }
}
