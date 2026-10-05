<?php
// FILE BARU: app/Http/Controllers/Admin/PengaturanWebsiteController.php
// Pengaturan Website adalah data TUNGGAL (1 baris, id=1).

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PengaturanWebsiteRequest;
use App\Models\PengaturanWebsite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengaturanWebsiteController extends Controller
{
    public function edit(): View
    {
        $pengaturan = PengaturanWebsite::firstOrNew(['id' => 1]);

        return view('admin.pengaturan-website.edit', compact('pengaturan'));
    }

    public function update(PengaturanWebsiteRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $existing = PengaturanWebsite::find(1);

        if ($request->hasFile('logo')) {
            if ($existing?->logo) {
                Storage::disk('public')->delete($existing->logo);
            }
            $data['logo'] = $request->file('logo')->store('pengaturan', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($existing?->favicon) {
                Storage::disk('public')->delete($existing->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('pengaturan', 'public');
        }

        PengaturanWebsite::updateOrCreate(['id' => 1], $data);

        return redirect()->route('admin.pengaturan-website.edit')
            ->with('status', 'Pengaturan website berhasil disimpan.');
    }
}
