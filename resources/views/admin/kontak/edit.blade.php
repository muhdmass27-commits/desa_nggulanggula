@extends('layouts.admin')
@section('title', 'Info Kontak')

@section('content')
<h2 style="margin-bottom:16px">Informasi Kontak</h2>

<form class="panel" method="POST" action="{{ route('admin.kontak.update') }}" style="max-width:560px">
  @csrf
  @method('PUT')

  <div class="field"><label>Alamat Kantor Desa</label><input name="alamat" value="{{ old('alamat', $kontak->alamat) }}"></div>
  <div class="field"><label>Telepon</label><input name="telepon" value="{{ old('telepon', $kontak->telepon) }}"></div>
  <div class="field"><label>WhatsApp</label><input name="whatsapp" value="{{ old('whatsapp', $kontak->whatsapp) }}"></div>
  <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email', $kontak->email) }}"></div>
  <div class="field"><label>Jam Pelayanan</label><input name="jam_pelayanan" value="{{ old('jam_pelayanan', $kontak->jam_pelayanan) }}" placeholder="contoh: Senin–Jumat, 08.00–15.00 WITA"></div>
  <div class="field"><label>Latitude</label><input name="latitude" value="{{ old('latitude', $kontak->latitude) }}"></div>
  <div class="field"><label>Longitude</label><input name="longitude" value="{{ old('longitude', $kontak->longitude) }}"></div>
  <div class="field"><label>Facebook (link)</label><input name="facebook" value="{{ old('facebook', $kontak->facebook) }}"></div>
  <div class="field"><label>Instagram (link)</label><input name="instagram" value="{{ old('instagram', $kontak->instagram) }}"></div>
  <div class="field"><label>YouTube (link)</label><input name="youtube" value="{{ old('youtube', $kontak->youtube) }}"></div>

  <button type="submit" class="btn">Simpan Perubahan</button>
</form>
@endsection
