<?php
// FILE BARU: app/Http/Requests/Admin/UpdatePengaduanRequest.php
// Admin hanya mengubah status & tanggapan (data pengirim tidak boleh diubah).

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengaduanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:menunggu,diproses,selesai,ditolak'],
            'tanggapan' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'tanggapan.max' => 'Tanggapan maksimal 5000 karakter.',
        ];
    }
}
