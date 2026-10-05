<?php
// FILE BARU: app/Http/Requests/Admin/KelompokUmurRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KelompokUmurRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2100'],
            'rentang_usia' => [
                'required', 'string', 'max:50',
                Rule::unique('kelompok_umur', 'rentang_usia')->where('tahun', $this->input('tahun'))->ignore($this->route('kelompok_umur')),
            ],
            'jumlah' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'rentang_usia.required' => 'Rentang usia wajib diisi.',
            'rentang_usia.unique' => 'Data rentang usia ini untuk tahun tersebut sudah ada.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh negatif.',
        ];
    }
}
