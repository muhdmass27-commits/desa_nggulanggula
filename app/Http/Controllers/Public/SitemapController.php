<?php
// FILE BARU: app/Http/Controllers/Public/SitemapController.php
// Menghasilkan sitemap.xml secara dinamis dari database (bukan file statis),
// supaya berita/potensi/wisata baru otomatis ikut terdaftar tanpa perlu
// generate ulang manual.

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PotensiDesa;
use App\Models\Wisata;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $halamanStatis = [
            'home', 'profil', 'pemerintahan', 'penduduk', 'berita.index',
            'potensi.index', 'wisata.index', 'transparansi', 'galeri.index',
            'ppid', 'pelayanan.index', 'pengaduan.index', 'kontak',
        ];

        $urls = collect($halamanStatis)->map(fn ($nama) => [
            'loc' => route($nama),
            'lastmod' => null,
        ]);

        $urls = $urls
            ->merge(Berita::published()->get(['slug', 'updated_at'])->map(fn ($b) => [
                'loc' => route('berita.show', $b->slug), 'lastmod' => $b->updated_at,
            ]))
            ->merge(PotensiDesa::published()->get(['slug', 'updated_at'])->map(fn ($p) => [
                'loc' => route('potensi.show', $p->slug), 'lastmod' => $p->updated_at,
            ]))
            ->merge(Wisata::published()->get(['slug', 'updated_at'])->map(fn ($w) => [
                'loc' => route('wisata.show', $w->slug), 'lastmod' => $w->updated_at,
            ]));

        $xml = view('public.sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
