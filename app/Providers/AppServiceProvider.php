<?php
// GANTI SELURUH ISI FILE app/Providers/AppServiceProvider.php
// Tambahan dari versi bawaan Laravel:
//  1. Bahasa tanggal Indonesia (Carbon)
//  2. Tampilan pagination sendiri (mengikuti desain website, tidak butuh Tailwind)
//  3. Data situs (pengaturan website, kontak, profil desa) otomatis tersedia
//     di layout publik, sehingga navbar/footer selalu mengikuti isi database.

namespace App\Providers;

use App\Models\Kontak;
use App\Models\PengaturanWebsite;
use App\Models\ProfilDesa;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id');

        Paginator::defaultView('vendor.pagination.simple');

        View::composer('layouts.public', function ($view) {
            $view->with([
                'situs' => PengaturanWebsite::first(),
                'kontakSitus' => Kontak::first(),
                'profilSitus' => ProfilDesa::first(),
            ]);
        });
    }
}
