<?php
// FILE BARU: app/Http/Requests/Admin/ProfilDesaRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfilDesaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_desa' => ['required', 'string', 'max:255'],
            'kecamatan' => ['required', 'string', 'max:255'],
            'kabupaten' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'website' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'foto_kantor' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sejarah' => ['nullable', 'string'],
            'visi' => ['nullable', 'string'],
            'misi' => ['nullable', 'string'],
            'kondisi_geografis' => ['nullable', 'string'],
            'luas_wilayah' => ['nullable', 'string', 'max:100'],
            'batas_utara' => ['nullable', 'string', 'max:255'],
            'batas_selatan' => ['nullable', 'string', 'max:255'],
            'batas_timur' => ['nullable', 'string', 'max:255'],
            'batas_barat' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
