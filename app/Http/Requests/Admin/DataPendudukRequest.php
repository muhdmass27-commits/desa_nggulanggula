<?php
// FILE BARU: app/Http/Requests/Admin/DataPendudukRequest.php
// Dipakai bersama untuk store & update. 'tahun' harus unik (satu baris
// data per tahun) - saat update, baris yang sedang diedit dikecualikan
// dari pengecekan unik lewat Rule::unique()->ignore().

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataPendudukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun' => [
                'required', 'integer', 'digits:4', 'min:2000', 'max:2100',
                Rule::unique('data_penduduk', 'tahun')->ignore($this->route('data_penduduk')),
            ],
            'jumlah_penduduk' => ['required', 'integer', 'min:0'],
            'jumlah_kk' => ['required', 'integer', 'min:0'],
            'laki_laki' => ['required', 'integer', 'min:0'],
            'perempuan' => ['required', 'integer', 'min:0'],
            'jumlah_dusun' => ['required', 'integer', 'min:0'],
            'jumlah_rt' => ['required', 'integer', 'min:0'],
            'jumlah_rw' => ['required', 'integer', 'min:0'],
            'keterangan' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.digits' => 'Tahun harus 4 digit angka, contoh: 2026.',
            'tahun.unique' => 'Data untuk tahun ini sudah ada. Silakan edit data yang sudah ada.',
            'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi.',
            'jumlah_penduduk.integer' => 'Jumlah penduduk harus berupa angka.',
            'jumlah_penduduk.min' => 'Jumlah penduduk tidak boleh negatif.',
            'jumlah_kk.integer' => 'Jumlah KK harus berupa angka.',
            'laki_laki.integer' => 'Jumlah laki-laki harus berupa angka.',
            'perempuan.integer' => 'Jumlah perempuan harus berupa angka.',
            'status.required' => 'Status wajib dipilih.',
        ];
    }
}
