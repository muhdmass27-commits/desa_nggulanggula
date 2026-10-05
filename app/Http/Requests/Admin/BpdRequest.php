<?php
// FILE BARU: app/Http/Requests/Admin/BpdRequest.php
// Catatan: kolom 'deskripsi' di database ditampilkan sebagai label
// "Keterangan" pada form, sesuai istilah yang diminta untuk modul BPD.

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BpdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
