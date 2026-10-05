<?php
// FILE BARU: app/Http/Requests/Admin/PpidRequest.php (dipakai store & update)

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PpidRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'in:Informasi Berkala,Informasi Setiap Saat,Informasi Serta Merta,Dasar Hukum'],
            'deskripsi' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx', 'max:5120'],
            'tanggal' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'file.file' => 'Berkas yang diunggah tidak valid.',
            'file.mimes' => 'File harus berupa PDF, DOC, DOCX, XLS, atau XLSX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
