<?php
// FILE BARU: app/Http/Requests/Admin/StorePelayananRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePelayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'persyaratan' => ['nullable', 'string'],
            'prosedur' => ['nullable', 'string'],
            'waktu_pelayanan' => ['nullable', 'string', 'max:100'],
            'biaya' => ['nullable', 'string', 'max:100'],
            'kontak' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pelayanan wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
