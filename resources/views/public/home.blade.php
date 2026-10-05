@extends('layouts.public')
@section('title', 'Beranda')

@section('content')
@php
  $nama = $profilSitus->nama_desa ?? $situs->nama_desa ?? 'Desa Nggulanggula';
@endphp

<section class="hero hero-home">
  <div class="wrap hero-grid">
    <div>
      <div class="eyebrow">Website Resmi Pemerintah Desa</div>
      <h1>{{ $nama }}</h1>
      <p>{{ $situs->tagline ?? $situs->deskripsi ?? 'Melayani warga dengan transparan dan membangun desa bersama.' }}</p>
      @if ($penduduk)
        <div class="stat-row">
          <div><b>{{ number_format($penduduk->jumlah_penduduk, 0, ',', '.') }}</b><span>Jiwa ({{ $penduduk->tahun }})</span></div>
          <div><b>{{ number_format($penduduk->jumlah_kk, 0, ',', '.') }}</b><span>Kepala Keluarga</span></div>
          <div><b>{{ $penduduk->jumlah_dusun }}</b><span>Dusun</span></div>
        </div>
      @endif
    </div>
    <div class="hero-card">
      <h3>Sambutan Kepala Desa</h3>
      @if ($kepalaDesa && $kepalaDesa->sambutan)
        <p style="font-size:14px;margin:0 0 10px;white-space:pre-line">{{ \Illuminate\Support\Str::limit($kepalaDesa->sambutan, 360) }}</p>
        <div style="font-size:13px;color:var(--ink-soft)">— <b>{{ $kepalaDesa->nama }}</b>, {{ $kepalaDesa->jabatan ?: 'Kepala Desa' }}</div>
      @elseif ($kepalaDesa)
        <p style="font-size:14px;margin:0"><b>{{ $kepalaDesa->nama }}</b><br>{{ $kepalaDesa->jabatan ?: 'Kepala Desa' }}</p>
      @else
        <p style="font-size:14px;margin:0;color:var(--ink-soft)">Data belum tersedia.</p>
      @endif
    </div>
  </div>
</section>

<section class="block"><div class="wrap">
  <div class="sec-head"><div><h2>Layanan Desa</h2><p class="lede">Informasi persyaratan dan prosedur pelayanan administrasi.</p></div><a class="more" href="{{ route('pelayanan.index') }}">Semua layanan &rarr;</a></div>
  @if ($pelayanan->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g4">
      @foreach ($pelayanan as $item)
        <a href="{{ route('pelayanan.show', $item) }}" class="card"><div class="body"><span class="tag">{{ $item->kategori ?: 'Layanan' }}</span><h3>{{ $item->nama }}</h3><span class="meta">{{ $item->waktu_pelayanan ? '⏱ '.$item->waktu_pelayanan : '' }}</span></div></a>
      @endforeach
    </div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="sec-head"><div><h2>Berita Terbaru</h2></div><a class="more" href="{{ route('berita.index') }}">Semua berita &rarr;</a></div>
  @if ($berita->isEmpty())
    @include('public._kosong', ['pesan' => 'Belum ada berita yang dipublikasikan.'])
  @else
    <div class="grid g3">@foreach ($berita as $item) @include('public.berita._kartu') @endforeach</div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="sec-head"><div><h2>Potensi Desa</h2></div><a class="more" href="{{ route('potensi.index') }}">Semua potensi &rarr;</a></div>
  @if ($potensi->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g3">@foreach ($potensi as $item) @include('public.potensi._kartu') @endforeach</div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="sec-head"><div><h2>Wisata Desa</h2></div><a class="more" href="{{ route('wisata.index') }}">Semua wisata &rarr;</a></div>
  @if ($wisata->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g3">@foreach ($wisata as $item) @include('public.wisata._kartu') @endforeach</div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="sec-head"><div><h2>Galeri Kegiatan</h2></div><a class="more" href="{{ route('galeri.index') }}">Buka galeri &rarr;</a></div>
  @if ($galeri->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g6">
      @foreach ($galeri as $foto)
        <a href="{{ asset('storage/'.$foto->file) }}" target="_blank" class="card gal"><img src="{{ asset('storage/'.$foto->file) }}" alt="{{ $foto->judul }}" loading="lazy" style="height:110px"></a>
      @endforeach
    </div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="box" style="display:flex;justify-content:space-between;align-items:center;gap:14px;flex-wrap:wrap">
    <div><h3 style="margin-bottom:4px">Punya keluhan, saran, atau permintaan?</h3><p class="lede" style="margin:0">Sampaikan langsung kepada pemerintah desa. Tidak perlu membuat akun.</p></div>
    <a class="btn" href="{{ route('pengaduan.index') }}">Kirim Pengaduan</a>
  </div>
</div></section>
@endsection
