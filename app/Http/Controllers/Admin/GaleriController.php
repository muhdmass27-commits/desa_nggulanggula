<?php
// FILE BARU: app/Http/Controllers/Admin/GaleriController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGaleriRequest;
use App\Http\Requests\Admin\UpdateGaleriRequest;
use App\Models\AlbumGaleri;
use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function index(Request $request): View
    {
        $albumId = $request->query('album');

        $galeri = Galeri::with('album')
            ->when($albumId, fn ($q) => $q->where('album_id', $albumId))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $albums = AlbumGaleri::orderBy('nama')->get();

        return view('admin.media.galeri.index', compact('galeri', 'albums', 'albumId'));
    }

    public function create(): View
    {
        $albums = AlbumGaleri::orderBy('nama')->get();
        return view('admin.media.galeri.create', compact('albums'));
    }

    public function store(StoreGaleriRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['file'] = $request->file('file')->store('galeri', 'public');
        $data['tipe'] = 'image';

        Galeri::create($data);

        return redirect()->route('admin.media.galeri.index')->with('status', 'Foto berhasil diunggah dan disimpan.');
    }

    public function edit(Galeri $galeri): View
    {
        $albums = AlbumGaleri::orderBy('nama')->get();
        return view('admin.media.galeri.edit', compact('galeri', 'albums'));
    }

    public function update(UpdateGaleriRequest $request, Galeri $galeri): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($galeri->file);
            $data['file'] = $request->file('file')->store('galeri', 'public');
        } else {
            unset($data['file']);
        }

        $galeri->update($data);

        return redirect()->route('admin.media.galeri.index')->with('status', 'Perubahan foto berhasil disimpan.');
    }

    public function destroy(Galeri $galeri): RedirectResponse
    {
        Storage::disk('public')->delete($galeri->file);
        $galeri->delete();

        return redirect()->route('admin.media.galeri.index')->with('status', 'Foto berhasil dihapus.');
    }
}
