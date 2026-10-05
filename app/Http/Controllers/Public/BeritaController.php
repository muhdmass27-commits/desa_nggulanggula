<?php
// GANTI SELURUH ISI FILE app/Http/Controllers/Public/BeritaController.php
// Versi Tahap 5: menambah pencarian & filter kategori. Method show() tidak berubah.

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q'));
        $slug = $request->query('kategori');

        $berita = Berita::published()
            ->with('kategori')
            ->when($q !== '', fn ($query) => $query->where(function ($w) use ($q) {
                $w->where('judul', 'like', "%{$q}%")->orWhere('ringkasan', 'like', "%{$q}%");
            }))
            ->when($slug, fn ($query) => $query->whereHas('kategori', fn ($k) => $k->where('slug', $slug)))
            ->orderByDesc('tanggal_publish')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        $kategori = KategoriBerita::withCount(['berita' => fn ($b) => $b->where('status', 'published')])
            ->orderBy('nama')->get();

        return view('public.berita.index', compact('berita', 'kategori', 'q', 'slug'));
    }

    public function show(Berita $berita): View
    {
        abort_unless($berita->status === 'published', 404);

        $berita->increment('views');
        $berita->load(['kategori', 'penulis']);

        return view('public.berita.show', compact('berita'));
    }
}
