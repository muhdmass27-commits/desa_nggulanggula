@extends('layouts.admin')
@section('title', 'Identitas Desa')

@section('content')
<h2 style="margin-bottom:16px">Profil Desa — Identitas & Konten</h2>

<form class="panel" method="POST" action="{{ route('admin.profil-desa.update') }}" enctype="multipart/form-data" style="max-width:680px">
  @csrf
  @method('PUT')

  <div class="field"><label>Nama Desa</label><input name="nama_desa" value="{{ old('nama_desa', $profil->nama_desa) }}" required></div>
  <div class="field"><label>Kecamatan</label><input name="kecamatan" value="{{ old('kecamatan', $profil->kecamatan) }}" required></div>
  <div class="field"><label>Kabupaten</label><input name="kabupaten" value="{{ old('kabupaten', $profil->kabupaten) }}" required></div>
  <div class="field"><label>Provinsi</label><input name="provinsi" value="{{ old('provinsi', $profil->provinsi) }}" required></div>
  <div class="field"><label>Kode Pos</label><input name="kode_pos" value="{{ old('kode_pos', $profil->kode_pos) }}"></div>
  <div class="field"><label>Alamat Kantor Desa</label><input name="alamat" value="{{ old('alamat', $profil->alamat) }}"></div>
  <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email', $profil->email) }}"></div>
  <div class="field"><label>Telepon</label><input name="telepon" value="{{ old('telepon', $profil->telepon) }}"></div>
  <div class="field"><label>WhatsApp</label><input name="whatsapp" value="{{ old('whatsapp', $profil->whatsapp) }}"></div>
  <div class="field"><label>Website</label><input name="website" value="{{ old('website', $profil->website) }}"></div>

  <div class="field">
    <label>Logo Desa (JPG/PNG/WEBP, maks 1MB)</label>
    @if ($profil->logo)
      <img src="{{ asset('storage/'.$profil->logo) }}" style="width:56px;height:56px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
    <input type="file" name="logo" accept="image/jpeg,image/jpg,image/png,image/webp">
    @error('logo') <div class="err">{{ $message }}</div> @enderror
  </div>

  <div class="field">
    <label>Foto Kantor Desa (JPG/PNG/WEBP, maks 2MB)</label>
    @if ($profil->foto_kantor)
      <img src="{{ asset('storage/'.$profil->foto_kantor) }}" style="width:90px;height:60px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
    <input type="file" name="foto_kantor" accept="image/jpeg,image/jpg,image/png,image/webp">
    @error('foto_kantor') <div class="err">{{ $message }}</div> @enderror
  </div>

  <div class="field"><label>Sejarah Desa</label><textarea name="sejarah">{{ old('sejarah', $profil->sejarah) }}</textarea></div>
  <div class="field"><label>Visi</label><textarea name="visi" style="min-height:70px">{{ old('visi', $profil->visi) }}</textarea></div>
  <div class="field"><label>Misi</label><textarea name="misi" style="min-height:90px">{{ old('misi', $profil->misi) }}</textarea></div>
  <div class="field"><label>Kondisi Geografis</label><textarea name="kondisi_geografis" style="min-height:70px">{{ old('kondisi_geografis', $profil->kondisi_geografis) }}</textarea></div>
  <div class="field"><label>Luas Wilayah</label><input name="luas_wilayah" value="{{ old('luas_wilayah', $profil->luas_wilayah) }}" placeholder="contoh: 12,5 km²"></div>

  <div class="field"><label>Batas Utara</label><input name="batas_utara" value="{{ old('batas_utara', $profil->batas_utara) }}"></div>
  <div class="field"><label>Batas Selatan</label><input name="batas_selatan" value="{{ old('batas_selatan', $profil->batas_selatan) }}"></div>
  <div class="field"><label>Batas Timur</label><input name="batas_timur" value="{{ old('batas_timur', $profil->batas_timur) }}"></div>
  <div class="field"><label>Batas Barat</label><input name="batas_barat" value="{{ old('batas_barat', $profil->batas_barat) }}"></div>

  <div class="field"><label>Latitude</label><input name="latitude" value="{{ old('latitude', $profil->latitude) }}" placeholder="contoh: -5.4522"></div>
  <div class="field"><label>Longitude</label><input name="longitude" value="{{ old('longitude', $profil->longitude) }}" placeholder="contoh: 122.6483"></div>

  <button type="submit" class="btn">Simpan Perubahan</button>
</form>
@endsection
