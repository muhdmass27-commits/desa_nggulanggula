@extends('layouts.public')
@section('title', $potensi->nama)

@section('content')
@include('public._judul', ['eyebrow' => $potensi->kategori->nama ?? 'Potensi Desa', 'judul' => $potensi->nama, 'deskripsi' => $potensi->lokasi])

<section class="block"><div class="wrap" style="max-width:760px">
  @if ($potensi->foto)
    <img src="{{ asset('storage/'.$potensi->foto) }}" alt="{{ $potensi->nama }}" style="width:100%;max-height:380px;object-fit:cover;border-radius:14px;margin-bottom:22px">
  @endif
  <div class="prose">{{ $potensi->deskripsi ?: 'Data belum tersedia.' }}</div>
  <table class="info-table" style="margin-top:18px;max-width:480px">
    <tr><th>Lokasi</th><td>{{ $potensi->lokasi ?: 'Data belum tersedia' }}</td></tr>
    <tr><th>Pengelola</th><td>{{ $potensi->pengelola ?: 'Data belum tersedia' }}</td></tr>
    <tr><th>Kontak</th><td>{{ $potensi->kontak ?: 'Data belum tersedia' }}</td></tr>
  </table>
  <a href="{{ route('potensi.index') }}" style="display:inline-block;margin-top:20px;font-size:13.5px;font-weight:600;color:var(--primary-dk)">&larr; Kembali ke daftar potensi</a>
</div></section>
@endsection
