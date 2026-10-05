<?php
// FILE BARU: app/Http/Requests/Admin/UpdateUserRequest.php
// Password di sini OPSIONAL (dikosongkan = password lama tidak berubah),
// beda dengan StoreUserRequest yang mewajibkan password saat akun baru dibuat.

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('pengguna'))],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah dipakai akun lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
