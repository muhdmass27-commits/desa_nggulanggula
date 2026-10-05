<?php
// FILE BARU: app/Http/Controllers/Admin/AlbumGaleriController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumGaleriRequest;
use App\Models\AlbumGaleri;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AlbumGaleriController extends Controller
{
    public function index(): View
    {
        $albumGaleri = AlbumGaleri::withCount('galeri')->orderByDesc('tanggal')->orderBy('nama')->paginate(10);
        return view('admin.media.album-galeri.index', compact('albumGaleri'));
    }

    public function create(): View
    {
        return view('admin.media.album-galeri.create');
    }

    public function store(AlbumGaleriRequest $request): RedirectResponse
    {
        AlbumGaleri::create($request->validated());
        return redirect()->route('admin.media.album-galeri.index')->with('status', 'Album berhasil disimpan.');
    }

    public function edit(AlbumGaleri $album_galeri): View
    {
        return view('admin.media.album-galeri.edit', ['albumGaleri' => $album_galeri]);
    }

    public function update(AlbumGaleriRequest $request, AlbumGaleri $album_galeri): RedirectResponse
    {
        $album_galeri->update($request->validated());
        return redirect()->route('admin.media.album-galeri.index')->with('status', 'Perubahan album berhasil disimpan.');
    }

    public function destroy(AlbumGaleri $album_galeri): RedirectResponse
    {
        // Aman: album yang masih berisi foto tidak dihapus agar foto tidak "yatim".
        if ($album_galeri->galeri()->exists()) {
            return redirect()->route('admin.media.album-galeri.index')
                ->withErrors(['nama' => 'Album tidak dapat dihapus karena masih berisi foto. Hapus atau pindahkan foto di album ini terlebih dahulu.']);
        }

        $album_galeri->delete();
        return redirect()->route('admin.media.album-galeri.index')->with('status', 'Album berhasil dihapus.');
    }
}
