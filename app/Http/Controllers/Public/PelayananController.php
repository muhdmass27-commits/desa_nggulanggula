<?php
// FILE BARU: app/Http/Controllers/Public/PelayananController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\View\View;

class PelayananController extends Controller
{
    public function index(): View
    {
        $pelayanan = Pelayanan::aktif()->orderBy('urutan')->orderBy('nama')->get();

        return view('public.pelayanan.index', compact('pelayanan'));
    }

    public function show(Pelayanan $pelayanan): View
    {
        abort_unless($pelayanan->status === 'aktif', 404);

        return view('public.pelayanan.show', compact('pelayanan'));
    }
}
