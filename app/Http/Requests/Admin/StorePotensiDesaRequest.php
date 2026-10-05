<?php
// FILE BARU: app/Http/Requests/Admin/StorePotensiDesaRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePotensiDesaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'kategori_id' => ['nullable', 'exists:kategori_potensi,id'],
            'nama' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'pengelola' => ['nullable', 'string', 'max:255'],
            'kontak' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama potensi wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
