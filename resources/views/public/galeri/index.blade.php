@extends('layouts.public')
@section('title', 'Galeri')

@section('content')
@include('public._judul', ['eyebrow' => 'Dokumentasi', 'judul' => 'Galeri Kegiatan Desa'])

<section class="block"><div class="wrap">
  @if ($album->isEmpty() && $fotoLepas->isEmpty())
    @include('public._kosong')
  @else
    @if ($album->isNotEmpty())
      <div class="sec-head"><h2>Album</h2></div>
      <div class="grid g4" style="margin-bottom:26px">
        @foreach ($album as $a)
          <a href="{{ route('galeri.show', $a) }}" class="card">
            <div class="ph">@if ($a->fotoTerbaru)<img src="{{ asset('storage/'.$a->fotoTerbaru->file) }}" alt="{{ $a->nama }}" loading="lazy">@else 📷 @endif</div>
            <div class="body"><h3>{{ $a->nama }}</h3><span class="meta">{{ $a->galeri_count }} foto</span></div>
          </a>
        @endforeach
      </div>
      {{ $album->links() }}
    @endif

    @if ($fotoLepas->isNotEmpty())
      <div class="sec-head" style="margin-top:10px"><h2>Foto Lainnya</h2></div>
      <div class="grid g6">
        @foreach ($fotoLepas as $f)
          <a href="{{ asset('storage/'.$f->file) }}" target="_blank" class="card gal"><img src="{{ asset('storage/'.$f->file) }}" alt="{{ $f->judul }}" loading="lazy"></a>
        @endforeach
      </div>
    @endif
  @endif
</div></section>
@endsection
