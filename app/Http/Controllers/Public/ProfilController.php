<?php
// FILE BARU: app/Http/Controllers/Public/ProfilController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        return view('public.profil', ['profil' => ProfilDesa::first()]);
    }
}
