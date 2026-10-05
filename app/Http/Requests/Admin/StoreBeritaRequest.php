<?php
// FILE BARU: app/Http/Requests/Admin/StoreBeritaRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => ['nullable', 'exists:kategori_berita,id'],
            'judul' => ['required', 'string', 'max:255'],
            'ringkasan' => ['nullable', 'string', 'max:500'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tanggal_publish' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul berita wajib diisi.',
            'isi.required' => 'Isi berita wajib diisi.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            'status.required' => 'Status berita wajib dipilih.',
            'status.in' => 'Status berita tidak valid.',
        ];
    }
}
