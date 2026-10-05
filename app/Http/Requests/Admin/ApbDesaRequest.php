<?php
// FILE BARU: app/Http/Requests/Admin/ApbDesaRequest.php (dipakai store & update)

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ApbDesaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2100'],
            'kategori' => ['required', 'in:Pendapatan,Belanja,Pembiayaan'],
            'subkategori' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'anggaran' => ['required', 'integer', 'min:0'],
            'realisasi' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.digits' => 'Tahun harus 4 digit angka, contoh: 2026.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori harus Pendapatan, Belanja, atau Pembiayaan.',
            'anggaran.required' => 'Anggaran wajib diisi.',
            'anggaran.integer' => 'Anggaran harus berupa angka bulat (tanpa titik/koma).',
            'anggaran.min' => 'Anggaran tidak boleh negatif.',
            'realisasi.required' => 'Realisasi wajib diisi (isi 0 jika belum ada).',
            'realisasi.integer' => 'Realisasi harus berupa angka bulat (tanpa titik/koma).',
            'realisasi.min' => 'Realisasi tidak boleh negatif.',
        ];
    }
}
