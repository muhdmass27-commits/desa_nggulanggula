<?php
// FILE BARU: app/Http/Requests/Admin/UpdateWisataRequest.php
// Aturan sama persis dengan StoreWisataRequest.

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWisataRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'fasilitas' => ['nullable', 'string', 'max:255'],
            'jam_buka' => ['nullable', 'date_format:H:i'],
            'jam_tutup' => ['nullable', 'date_format:H:i'],
            'kontak_pengelola' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wisata wajib diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'jam_buka.date_format' => 'Format jam buka harus JJ:MM, contoh 08:00.',
            'jam_tutup.date_format' => 'Format jam tutup harus JJ:MM, contoh 17:00.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
