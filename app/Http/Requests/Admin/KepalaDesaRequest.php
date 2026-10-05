<?php
// FILE BARU: app/Http/Requests/Admin/KepalaDesaRequest.php
// Dipakai bersama untuk store & update (aturan validasi sama persis,
// tidak ada kolom unik yang perlu penanganan khusus per record).

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KepalaDesaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'periode' => ['nullable', 'string', 'max:100'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'nip' => ['nullable', 'string', 'max:50'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'sambutan' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'email.email' => 'Format email tidak valid.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
