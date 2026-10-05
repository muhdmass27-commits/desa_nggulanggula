<?php
// FILE BARU: app/Http/Requests/Public/StorePengaduanRequest.php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    public const KATEGORI = ['Umum', 'Sosial', 'Keamanan', 'Kesehatan', 'Kebersihan', 'Permintaan', 'Lainnya'];

    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'telepon' => ['required', 'regex:/^[0-9+\-\s()]{6,20}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'kategori' => ['required', 'in:' . implode(',', self::KATEGORI)],
            'judul' => ['nullable', 'string', 'max:255'],
            'isi' => ['required', 'string', 'min:10', 'max:5000'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'lampiran' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'telepon.required' => 'Nomor telepon/WhatsApp wajib diisi.',
            'telepon.regex' => 'Nomor telepon tidak valid. Gunakan angka, contoh: 081234567890.',
            'email.email' => 'Format email tidak valid.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'isi.required' => 'Isi pengaduan wajib diisi.',
            'isi.min' => 'Isi pengaduan terlalu singkat (minimal 10 karakter).',
            'isi.max' => 'Isi pengaduan maksimal 5000 karakter.',
            'lampiran.mimes' => 'Lampiran harus berupa JPG, JPEG, PNG, WEBP, atau PDF.',
            'lampiran.max' => 'Ukuran lampiran maksimal 2MB.',
        ];
    }
}
