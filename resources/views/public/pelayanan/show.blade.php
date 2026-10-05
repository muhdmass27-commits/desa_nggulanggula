@extends('layouts.public')
@section('title', $pelayanan->nama)

@section('content')
@include('public._judul', ['eyebrow' => $pelayanan->kategori ?: 'Layanan Publik', 'judul' => $pelayanan->nama])

<section class="block"><div class="wrap" style="max-width:700px">
  <div class="box">
    <h3>Deskripsi</h3>
    <div class="prose">{{ $pelayanan->deskripsi ?: 'Data belum tersedia.' }}</div>
  </div>
  <div class="grid g2" style="margin-top:16px">
    <div class="box"><h3>Persyaratan</h3><div class="prose">{{ $pelayanan->persyaratan ?: 'Data belum tersedia.' }}</div></div>
    <div class="box"><h3>Prosedur</h3><div class="prose">{{ $pelayanan->prosedur ?: 'Data belum tersedia.' }}</div></div>
  </div>
  <table class="info-table" style="margin-top:16px">
    <tr><th>Waktu Pelayanan</th><td>{{ $pelayanan->waktu_pelayanan ?: 'Data belum tersedia' }}</td></tr>
    <tr><th>Biaya</th><td>{{ $pelayanan->biaya ?: 'Gratis' }}</td></tr>
    <tr><th>Kontak</th><td>{{ $pelayanan->kontak ?: 'Data belum tersedia' }}</td></tr>
  </table>
  <a href="{{ route('pelayanan.index') }}" style="display:inline-block;margin-top:20px;font-size:13.5px;font-weight:600;color:var(--primary-dk)">&larr; Kembali ke daftar pelayanan</a>
</div></section>
@endsection
