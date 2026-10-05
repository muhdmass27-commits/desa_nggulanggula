<?php
// FILE BARU: app/Http/Requests/Admin/AlbumGaleriRequest.php (dipakai store & update)

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AlbumGaleriRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama album wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
        ];
    }
}
