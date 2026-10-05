<?php
// FILE BARU: app/Http/Controllers/Public/WisataController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\View\View;

class WisataController extends Controller
{
    public function index(): View
    {
        $wisata = Wisata::published()->latest()->paginate(9);

        return view('public.wisata.index', compact('wisata'));
    }

    public function show(Wisata $wisata): View
    {
        abort_unless($wisata->status === 'published', 404);

        return view('public.wisata.show', compact('wisata'));
    }
}
