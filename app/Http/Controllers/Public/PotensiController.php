<?php
// FILE BARU: app/Http/Controllers/Public/PotensiController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KategoriPotensi;
use App\Models\PotensiDesa;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PotensiController extends Controller
{
    public function index(Request $request): View
    {
        $slug = $request->query('kategori');

        $potensi = PotensiDesa::published()
            ->with('kategori')
            ->when($slug, fn ($q) => $q->whereHas('kategori', fn ($k) => $k->where('slug', $slug)))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $kategori = KategoriPotensi::withCount(['potensi' => fn ($p) => $p->where('status', 'published')])
            ->orderBy('nama')->get();

        return view('public.potensi.index', compact('potensi', 'kategori', 'slug'));
    }

    public function show(PotensiDesa $potensi): View
    {
        abort_unless($potensi->status === 'published', 404);
        $potensi->load('kategori');

        return view('public.potensi.show', compact('potensi'));
    }
}
