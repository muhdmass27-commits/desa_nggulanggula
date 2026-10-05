<?php
// FILE BARU: app/Http/Requests/Admin/StoreGaleriRequest.php (foto WAJIB saat tambah)

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'album_id' => ['nullable', 'exists:album_galeri,id'],
            'judul' => ['nullable', 'string', 'max:255'],
            'file' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'album_id.exists' => 'Album yang dipilih tidak valid.',
            'file.required' => 'Foto wajib diunggah.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'file.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
