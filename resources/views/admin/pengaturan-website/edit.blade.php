@extends('layouts.admin')
@section('title', 'Pengaturan Website')

@section('content')
<h2 style="margin-bottom:4px">Pengaturan Website</h2>
<p style="font-size:13px;color:var(--ink-soft);margin-bottom:16px">Kelola identitas, logo, favicon, footer, dan media sosial tanpa menyentuh kode.</p>

<form class="panel" method="POST" action="{{ route('admin.pengaturan-website.update') }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @method('PUT')

  <div class="field"><label>Nama Website</label><input name="nama_website" value="{{ old('nama_website', $pengaturan->nama_website) }}" required></div>
  <div class="field"><label>Nama Desa</label><input name="nama_desa" value="{{ old('nama_desa', $pengaturan->nama_desa) }}" required></div>
  <div class="field"><label>Tagline</label><input name="tagline" value="{{ old('tagline', $pengaturan->tagline) }}"></div>

  <div class="field">
    <label>Logo (JPG/PNG/WEBP, maks 1MB)</label>
    @if ($pengaturan->logo)
      <img src="{{ asset('storage/'.$pengaturan->logo) }}" style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
    <input type="file" name="logo" accept="image/jpeg,image/jpg,image/png,image/webp">
    @error('logo') <div class="err">{{ $message }}</div> @enderror
  </div>

  <div class="field">
    <label>Favicon (ICO/PNG, maks 512KB)</label>
    @if ($pengaturan->favicon)
      <img src="{{ asset('storage/'.$pengaturan->favicon) }}" style="width:32px;height:32px;object-fit:cover;border-radius:6px;border:1px solid var(--line);margin-bottom:6px">
    @endif
    <input type="file" name="favicon" accept=".ico,image/png,image/jpeg,image/webp">
    @error('favicon') <div class="err">{{ $message }}</div> @enderror
  </div>

  <div class="field"><label>Deskripsi Singkat Website</label><textarea name="deskripsi" style="min-height:70px">{{ old('deskripsi', $pengaturan->deskripsi) }}</textarea></div>
  <div class="field"><label>Teks Footer</label><textarea name="footer" style="min-height:70px">{{ old('footer', $pengaturan->footer) }}</textarea></div>
  <div class="field"><label>Facebook</label><input name="facebook" value="{{ old('facebook', $pengaturan->facebook) }}"></div>
  <div class="field"><label>Instagram</label><input name="instagram" value="{{ old('instagram', $pengaturan->instagram) }}"></div>
  <div class="field"><label>YouTube</label><input name="youtube" value="{{ old('youtube', $pengaturan->youtube) }}"></div>
  <div class="field"><label>WhatsApp</label><input name="whatsapp" value="{{ old('whatsapp', $pengaturan->whatsapp) }}"></div>

  <button type="submit" class="btn">Simpan Perubahan</button>
</form>
@endsection
