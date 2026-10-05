<?php
// FILE BARU: app/Http/Controllers/Public/PemerintahanController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Bpd;
use App\Models\KepalaDesa;
use App\Models\PerangkatDesa;
use Illuminate\View\View;

class PemerintahanController extends Controller
{
    public function index(): View
    {
        return view('public.pemerintahan.index', [
            'kepalaDesa' => KepalaDesa::aktif()->orderBy('urutan')->orderByDesc('id')->get(),
            'perangkat' => PerangkatDesa::aktif()->orderBy('urutan')->orderBy('nama')->get(),
            'bpd' => Bpd::aktif()->orderBy('urutan')->orderBy('nama')->get(),
        ]);
    }
}
