<?php
// FILE BARU: app/Http/Requests/Admin/PekerjaanRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PekerjaanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2100'],
            'jenis_pekerjaan' => [
                'required', 'string', 'max:100',
                Rule::unique('pekerjaan', 'jenis_pekerjaan')->where('tahun', $this->input('tahun'))->ignore($this->route('pekerjaan')),
            ],
            'jumlah' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'jenis_pekerjaan.required' => 'Jenis pekerjaan wajib diisi.',
            'jenis_pekerjaan.unique' => 'Data jenis pekerjaan ini untuk tahun tersebut sudah ada.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh negatif.',
        ];
    }
}
