<?php
// GANTI SELURUH ISI FILE tests/Feature/ExampleTest.php
// Perbaikan: file bawaan Laravel ini TIDAK memakai RefreshDatabase, jadi
// database SQLite testing kosong sama sekali (tabel pun belum dibuat).
// Sejak HomeController (Tahap 5) membaca tabel kepala_desa dkk, test ini jadi
// gagal dengan "no such table: kepala_desa". Perbaikannya murni menambahkan
// trait RefreshDatabase supaya migration dijalankan dulu sebelum test - tidak
// ada satu baris pun logika aplikasi yang diubah.

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
