<?php
// FILE BARU: app/Http/Controllers/Public/KontakController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\ProfilDesa;
use Illuminate\View\View;

class KontakController extends Controller
{
    public function index(): View
    {
        return view('public.kontak', [
            'kontak' => Kontak::first(),
            'profil' => ProfilDesa::first(),
        ]);
    }
}
