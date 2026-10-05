<?php
// GANTI SELURUH ISI FILE app/Http/Controllers/Public/GaleriController.php
// Perbaikan Tahap 7: method index() sebelumnya melakukan 1 query tambahan per
// album untuk mengambil foto sampul (N+1 query - lambat kalau album banyak).
// Sekarang pakai eager load relasi fotoTerbaru() (hasOne latestOfMany di model
// AlbumGaleri), jadi cukup 1 query tambahan untuk SEMUA sampul sekaligus.
//
// Perbaikan lanjutan: ->having('galeri_count', '>', 0) sebelumnya dipakai untuk
// menyaring "hanya album yang punya minimal 1 foto". Itu berjalan di MySQL
// (MySQL mengizinkan HAVING merujuk alias kolom dari subquery withCount, walau
// tanpa GROUP BY), tapi SQLite (dipakai saat `php artisan test`) menolaknya
// dengan error "HAVING clause on a non-aggregate query". Diganti dengan
// ->has('galeri') yang menghasilkan WHERE EXISTS (...) - hasil akhirnya
// IDENTIK ("hanya album yang punya minimal 1 foto"), tapi portable di MySQL
// maupun SQLite. Method show() tidak berubah.

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AlbumGaleri;
use App\Models\Galeri;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function index(): View
    {
        $album = AlbumGaleri::has('galeri')
            ->withCount('galeri')
            ->with('fotoTerbaru')
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->paginate(12);

        $fotoLepas = Galeri::whereNull('album_id')->latest()->limit(12)->get();

        return view('public.galeri.index', compact('album', 'fotoLepas'));
    }

    public function show(AlbumGaleri $album): View
    {
        $foto = $album->galeri()->latest('id')->paginate(12);

        return view('public.galeri.show', compact('album', 'foto'));
    }
}
