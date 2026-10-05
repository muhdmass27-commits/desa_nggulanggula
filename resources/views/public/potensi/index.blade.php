@extends('layouts.public')
@section('title', 'Potensi Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Ekonomi Desa', 'judul' => 'Potensi Desa', 'deskripsi' => 'Sektor unggulan penggerak ekonomi warga.'])

<section class="block"><div class="wrap">
  @if ($kategori->where('potensi_count', '>', 0)->isNotEmpty())
    <div class="chips">
      <a class="chip {{ !$slug ? 'on' : '' }}" href="{{ route('potensi.index') }}">Semua</a>
      @foreach ($kategori as $k)
        @if ($k->potensi_count > 0)
          <a class="chip {{ $slug === $k->slug ? 'on' : '' }}" href="{{ route('potensi.index', ['kategori' => $k->slug]) }}">{{ $k->nama }} ({{ $k->potensi_count }})</a>
        @endif
      @endforeach
    </div>
  @endif

  @if ($potensi->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g3">@foreach ($potensi as $item) @include('public.potensi._kartu') @endforeach</div>
    {{ $potensi->links() }}
  @endif
</div></section>
@endsection
