@extends('layouts.public')
@section('title', $wisata->nama)

@section('content')
@include('public._judul', ['eyebrow' => 'Wisata Desa', 'judul' => $wisata->nama, 'deskripsi' => $wisata->lokasi])

<section class="block"><div class="wrap" style="max-width:760px">
  @if ($wisata->foto)
    <img src="{{ asset('storage/'.$wisata->foto) }}" alt="{{ $wisata->nama }}" style="width:100%;max-height:380px;object-fit:cover;border-radius:14px;margin-bottom:22px">
  @endif
  <div class="prose">{{ $wisata->deskripsi ?: 'Data belum tersedia.' }}</div>
  <table class="info-table" style="margin-top:18px;max-width:480px">
    <tr><th>Lokasi</th><td>{{ $wisata->lokasi ?: 'Data belum tersedia' }}</td></tr>
    <tr><th>Fasilitas</th><td>{{ $wisata->fasilitas ?: 'Data belum tersedia' }}</td></tr>
    <tr><th>Jam Buka</th><td>@if($wisata->jam_buka && $wisata->jam_tutup){{ $wisata->jam_buka }} - {{ $wisata->jam_tutup }}@else Data belum tersedia @endif</td></tr>
    <tr><th>Kontak Pengelola</th><td>{{ $wisata->kontak_pengelola ?: 'Data belum tersedia' }}</td></tr>
  </table>
  @if ($wisata->latitude && $wisata->longitude)
    <div style="margin-top:18px;max-width:480px">
      <h3 style="font-size:15px;margin-bottom:8px">Lokasi di Peta</h3>
      @include('public._peta', ['lat' => $wisata->latitude, 'lng' => $wisata->longitude])
    </div>
  @endif
  <a href="{{ route('wisata.index') }}" style="display:inline-block;margin-top:20px;font-size:13.5px;font-weight:600;color:var(--primary-dk)">&larr; Kembali ke daftar wisata</a>
</div></section>
@endsection
