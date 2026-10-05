<?php
// FILE BARU: app/Http/Requests/Admin/KategoriBeritaRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KategoriBeritaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return ['nama.required' => 'Nama kategori wajib diisi.'];
    }
}
