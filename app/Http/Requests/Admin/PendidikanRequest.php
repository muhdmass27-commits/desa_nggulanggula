<?php
// FILE BARU: app/Http/Requests/Admin/PendidikanRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PendidikanRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2100'],
            'jenjang' => [
                'required', 'string', 'max:100',
                Rule::unique('pendidikan', 'jenjang')->where('tahun', $this->input('tahun'))->ignore($this->route('pendidikan')),
            ],
            'jumlah' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun wajib diisi.',
            'jenjang.required' => 'Jenjang pendidikan wajib diisi.',
            'jenjang.unique' => 'Data jenjang ini untuk tahun tersebut sudah ada.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah tidak boleh negatif.',
        ];
    }
}
