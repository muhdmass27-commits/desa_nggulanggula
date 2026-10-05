@extends('layouts.public')
@section('title', 'Pengaduan Masyarakat')

@section('content')
@include('public._judul', ['eyebrow' => 'Layanan Warga', 'judul' => 'Pengaduan Masyarakat', 'deskripsi' => 'Sampaikan keluhan, saran, atau permintaan Anda. Tidak perlu membuat akun.'])

<section class="block"><div class="wrap" style="max-width:620px">
  @if (session('sukses'))<div class="flash ok">{{ session('sukses') }}</div>@endif
  @if ($errors->any() && !session('sukses'))
    <div class="flash err"><ul style="margin:0;padding-left:18px">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif

  <form class="panel" method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="hp"><label>Website</label><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

    <div class="field"><label for="nama">Nama</label><input type="text" id="nama" name="nama" value="{{ old('nama') }}" required></div>
    <div class="field"><label for="telepon">Nomor HP / WhatsApp</label><input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" required></div>
    <div class="field"><label for="email">Email (opsional)</label><input type="email" id="email" name="email" value="{{ old('email') }}"></div>
    <div class="field">
      <label for="kategori">Kategori</label>
      <select id="kategori" name="kategori" required>
        @foreach ($kategori as $k)<option value="{{ $k }}" @selected(old('kategori') == $k)>{{ $k }}</option>@endforeach
      </select>
    </div>
    <div class="field"><label for="judul">Judul (opsional)</label><input type="text" id="judul" name="judul" value="{{ old('judul') }}"></div>
    <div class="field"><label for="lokasi">Lokasi Kejadian (opsional)</label><input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"></div>
    <div class="field"><label for="isi">Isi Pengaduan</label><textarea id="isi" name="isi" required>{{ old('isi') }}</textarea></div>
    <div class="field"><label for="lampiran">Lampiran Foto/PDF (opsional, maks 2MB)</label><input type="file" id="lampiran" name="lampiran" accept="image/jpeg,image/jpg,image/png,image/webp,application/pdf"></div>

    <button type="submit" class="btn">Kirim Pengaduan</button>
  </form>
</div></section>
@endsection
