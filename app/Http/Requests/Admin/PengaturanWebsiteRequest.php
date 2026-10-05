<?php
// FILE BARU: app/Http/Requests/Admin/PengaturanWebsiteRequest.php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PengaturanWebsiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_website' => ['required', 'string', 'max:255'],
            'nama_desa' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,webp', 'max:512'],
            'deskripsi' => ['nullable', 'string'],
            'footer' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
        ];
    }
}
