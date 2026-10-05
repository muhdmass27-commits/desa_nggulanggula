@extends('layouts.public')
@section('title', 'Berita Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Informasi Desa', 'judul' => 'Berita Desa', 'deskripsi' => 'Kabar dan kegiatan terbaru dari Pemerintah Desa.'])

<section class="block"><div class="wrap">
  <form method="GET" action="{{ route('berita.index') }}" class="searchbar">
    <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul berita...">
    @if ($slug)<input type="hidden" name="kategori" value="{{ $slug }}">@endif
    <button type="submit" class="btn ghost sm">Cari</button>
    @if ($q !== '' || $slug)<a class="btn ghost sm" href="{{ route('berita.index') }}">Reset</a>@endif
  </form>

  @if ($kategori->where('berita_count', '>', 0)->isNotEmpty())
    <div class="chips">
      <a class="chip {{ !$slug ? 'on' : '' }}" href="{{ route('berita.index', ['q' => $q ?: null]) }}">Semua</a>
      @foreach ($kategori as $k)
        @if ($k->berita_count > 0)
          <a class="chip {{ $slug === $k->slug ? 'on' : '' }}" href="{{ route('berita.index', ['kategori' => $k->slug, 'q' => $q ?: null]) }}">{{ $k->nama }} ({{ $k->berita_count }})</a>
        @endif
      @endforeach
    </div>
  @endif

  @if ($berita->isEmpty())
    @include('public._kosong', ['pesan' => 'Belum ada berita yang cocok / dipublikasikan.'])
  @else
    <div class="grid g3">@foreach ($berita as $item) @include('public.berita._kartu') @endforeach</div>
    {{ $berita->links() }}
  @endif
</div></section>
@endsection
