@extends('layouts.public')
@section('title', $berita->judul)

@section('content')
@include('public._judul', ['eyebrow' => $berita->kategori->nama ?? 'Umum', 'judul' => $berita->judul, 'deskripsi' => ($berita->tanggal_publish ? $berita->tanggal_publish->translatedFormat('d F Y') : '') . ' · oleh ' . ($berita->penulis->name ?? 'Admin Desa') . ' · ' . $berita->views . 'x dilihat'])

<section class="block"><div class="wrap" style="max-width:760px">
  @if ($berita->gambar)
    <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}" style="width:100%;max-height:400px;object-fit:cover;border-radius:14px;margin-bottom:22px">
  @endif
  <div class="prose">{{ $berita->isi }}</div>
  <a href="{{ route('berita.index') }}" style="display:inline-block;margin-top:24px;font-size:13.5px;font-weight:600;color:var(--primary-dk)">&larr; Kembali ke daftar berita</a>
</div></section>
@endsection
