<?php
// GANTI SELURUH ISI FILE routes/web.php dengan ini.
// Versi Kelompok B-2 (menambah Transparansi, Media/Galeri, PPID, Pengaduan).
// Versi gabungan sebelumnya: perbaikan Kelompok A (Pemerintahan & Penduduk, yang
// sebelumnya controller/request/view/migration-nya belum lengkap tersalin)
// + Kelompok B-1 (Pendidikan, Pekerjaan, Kelompok Umur, Kategori Berita,
// Kategori Potensi, Potensi Desa, Wisata).
// Semua resource baru diberi ->parameters() eksplisit untuk mencegah bug
// penyingularan otomatis Laravel.

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\AlbumGaleriController;
use App\Http\Controllers\Admin\ApbDesaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PembangunanController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PpidController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\BpdController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataPendudukController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\KategoriPotensiController;
use App\Http\Controllers\Admin\KelompokUmurController;
use App\Http\Controllers\Admin\KepalaDesaController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\PekerjaanController;
use App\Http\Controllers\Admin\PelayananController;
use App\Http\Controllers\Admin\PendidikanController;
use App\Http\Controllers\Admin\PengaturanWebsiteController;
use App\Http\Controllers\Admin\PerangkatDesaController;
use App\Http\Controllers\Admin\PotensiDesaController;
use App\Http\Controllers\Admin\ProfilDesaController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\BeritaController as PublicBeritaController;
use App\Http\Controllers\Public\GaleriController as PublicGaleriController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\KontakController as PublicKontakController;
use App\Http\Controllers\Public\PelayananController as PublicPelayananController;
use App\Http\Controllers\Public\PemerintahanController;
use App\Http\Controllers\Public\PendudukController;
use App\Http\Controllers\Public\PengaduanController as PublicPengaduanController;
use App\Http\Controllers\Public\PotensiController;
use App\Http\Controllers\Public\PpidController as PublicPpidController;
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\SitemapController;
use App\Http\Controllers\Public\TransparansiController;
use App\Http\Controllers\Public\WisataController as PublicWisataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEBSITE PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/pemerintahan', [PemerintahanController::class, 'index'])->name('pemerintahan');
Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk');

Route::get('/berita', [PublicBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita:slug}', [PublicBeritaController::class, 'show'])->name('berita.show');

Route::get('/potensi', [PotensiController::class, 'index'])->name('potensi.index');
Route::get('/potensi/{potensi:slug}', [PotensiController::class, 'show'])->name('potensi.show');

Route::get('/wisata', [PublicWisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{wisata:slug}', [PublicWisataController::class, 'show'])->name('wisata.show');

Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi');

Route::get('/galeri', [PublicGaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{album}', [PublicGaleriController::class, 'show'])->name('galeri.show');

Route::get('/ppid', [PublicPpidController::class, 'index'])->name('ppid');
Route::post('/ppid/permohonan', [PublicPpidController::class, 'permohonan'])->middleware('throttle:5,1')->name('ppid.permohonan');

Route::get('/pelayanan', [PublicPelayananController::class, 'index'])->name('pelayanan.index');
Route::get('/pelayanan/{pelayanan:slug}', [PublicPelayananController::class, 'show'])->name('pelayanan.show');

Route::get('/pengaduan', [PublicPengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/pengaduan', [PublicPengaduanController::class, 'store'])->middleware('throttle:5,1')->name('pengaduan.store');

Route::get('/kontak', [PublicKontakController::class, 'index'])->name('kontak');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Belum login
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'store'])
            ->middleware('throttle:5,1')->name('login.attempt');
    });

    // Sudah login sebagai admin (role=admin, status=aktif)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'destroy'])->name('logout');

        Route::get('/akun', [PasswordController::class, 'edit'])->name('akun.edit');
        Route::put('/akun', [PasswordController::class, 'update'])->name('akun.update');

        Route::resource('pengguna', UserController::class)
            ->except(['show'])
            ->parameters(['pengguna' => 'pengguna']);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- Tahap 3 ---
        Route::resource('berita', AdminBeritaController::class)
            ->except(['show'])
            ->parameters(['berita' => 'berita']);

        // --- Tahap 4 Bagian 1 ---
        Route::resource('pelayanan', PelayananController::class)
            ->except(['show'])
            ->parameters(['pelayanan' => 'pelayanan']);

        Route::get('/profil-desa', [ProfilDesaController::class, 'edit'])->name('profil-desa.edit');
        Route::put('/profil-desa', [ProfilDesaController::class, 'update'])->name('profil-desa.update');

        Route::get('/kontak', [KontakController::class, 'edit'])->name('kontak.edit');
        Route::put('/kontak', [KontakController::class, 'update'])->name('kontak.update');

        Route::get('/pengaturan-website', [PengaturanWebsiteController::class, 'edit'])->name('pengaturan-website.edit');
        Route::put('/pengaturan-website', [PengaturanWebsiteController::class, 'update'])->name('pengaturan-website.update');

        // --- Tahap 4 Bagian 2 - Kelompok A: Pemerintahan & Penduduk ---
        Route::prefix('pemerintahan')->name('pemerintahan.')->group(function () {
            Route::resource('kepala-desa', KepalaDesaController::class)
                ->except(['show'])->parameters(['kepala-desa' => 'kepala_desa']);
            Route::resource('perangkat-desa', PerangkatDesaController::class)
                ->except(['show'])->parameters(['perangkat-desa' => 'perangkat_desa']);
            Route::resource('bpd', BpdController::class)
                ->except(['show'])->parameters(['bpd' => 'bpd']);
        });

        Route::resource('penduduk', DataPendudukController::class)
            ->except(['show'])->parameters(['penduduk' => 'data_penduduk']);

        // --- Tahap 4 Bagian 2 - Kelompok B-1: statistik penduduk lanjutan ---
        Route::prefix('penduduk')->name('penduduk.')->group(function () {
            Route::resource('pendidikan', PendidikanController::class)
                ->except(['show'])->parameters(['pendidikan' => 'pendidikan']);
            Route::resource('pekerjaan', PekerjaanController::class)
                ->except(['show'])->parameters(['pekerjaan' => 'pekerjaan']);
            Route::resource('kelompok-umur', KelompokUmurController::class)
                ->except(['show'])->parameters(['kelompok-umur' => 'kelompok_umur']);
        });

        // --- Tahap 4 Bagian 2 - Kelompok B-1: Informasi Desa ---
        Route::prefix('informasi-desa')->name('informasi-desa.')->group(function () {
            Route::resource('kategori-berita', KategoriBeritaController::class)
                ->except(['show'])->parameters(['kategori-berita' => 'kategori_berita']);
            Route::resource('kategori-potensi', KategoriPotensiController::class)
                ->except(['show'])->parameters(['kategori-potensi' => 'kategori_potensi']);
            Route::resource('potensi-desa', PotensiDesaController::class)
                ->except(['show'])->parameters(['potensi-desa' => 'potensi_desa']);
            Route::resource('wisata', WisataController::class)
                ->except(['show'])->parameters(['wisata' => 'wisata']);
        });

        // --- Tahap 4 Bagian 2 - Kelompok B-2: Transparansi ---
        Route::prefix('transparansi')->name('transparansi.')->group(function () {
            Route::resource('apb-desa', ApbDesaController::class)
                ->except(['show'])->parameters(['apb-desa' => 'apb_desa']);
            Route::resource('pembangunan', PembangunanController::class)
                ->except(['show'])->parameters(['pembangunan' => 'pembangunan']);
        });

        // --- Tahap 4 Bagian 2 - Kelompok B-2: Media (Galeri) ---
        Route::prefix('media')->name('media.')->group(function () {
            Route::resource('album-galeri', AlbumGaleriController::class)
                ->except(['show'])->parameters(['album-galeri' => 'album_galeri']);
            Route::resource('galeri', GaleriController::class)
                ->except(['show'])->parameters(['galeri' => 'galeri']);
        });

        // --- Tahap 4 Bagian 2 - Kelompok B-2: PPID & Pengaduan ---
        Route::resource('ppid', PpidController::class)
            ->except(['show'])->parameters(['ppid' => 'ppid']);

        Route::resource('pengaduan', PengaduanController::class)
            ->only(['index', 'show', 'update', 'destroy'])->parameters(['pengaduan' => 'pengaduan']);
    });
});
