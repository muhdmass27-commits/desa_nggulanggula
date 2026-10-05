<?php
// FILE BARU: app/Http/Requests/Admin/PembangunanRequest.php (dipakai store & update)

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PembangunanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2100'],
            'nama_program' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'anggaran' => ['required', 'integer', 'min:0'],
            'sumber_dana' => ['nullable', 'string', 'max:255'],
            'progress' => ['required', 'integer', 'between:0,100'],
            'status' => ['required', 'in:direncanakan,berjalan,selesai'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'nama_program.required' => 'Nama program wajib diisi.',
            'anggaran.required' => 'Anggaran wajib diisi.',
            'anggaran.integer' => 'Anggaran harus berupa angka bulat (tanpa titik/koma).',
            'progress.required' => 'Progress wajib diisi (0-100).',
            'progress.between' => 'Progress harus antara 0 sampai 100.',
            'status.required' => 'Status wajib dipilih.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
