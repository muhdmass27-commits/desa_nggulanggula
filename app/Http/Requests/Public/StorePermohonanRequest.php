<?php
// FILE BARU: app/Http/Requests/Public/StorePermohonanRequest.php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class StorePermohonanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'instansi' => ['nullable', 'string', 'max:150'],
            'telepon' => ['required', 'regex:/^[0-9+\-\s()]{6,20}$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'isi' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.regex' => 'Nomor telepon tidak valid. Gunakan angka, contoh: 081234567890.',
            'email.email' => 'Format email tidak valid.',
            'isi.required' => 'Isi permohonan informasi wajib diisi.',
            'isi.min' => 'Isi permohonan terlalu singkat (minimal 10 karakter).',
        ];
    }
}
