@extends('layouts.public')
@section('title', $album->nama)

@section('content')
@include('public._judul', ['eyebrow' => 'Album Galeri', 'judul' => $album->nama, 'deskripsi' => $album->deskripsi])

<section class="block"><div class="wrap">
  <a href="{{ route('galeri.index') }}" style="display:inline-block;margin-bottom:16px;font-size:13.5px;font-weight:600;color:var(--primary-dk)">&larr; Kembali ke galeri</a>
  @if ($foto->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g6">
      @foreach ($foto as $f)
        <a href="{{ asset('storage/'.$f->file) }}" target="_blank" class="card gal">
          <img src="{{ asset('storage/'.$f->file) }}" alt="{{ $f->judul }}" loading="lazy">
          @if ($f->judul)<div class="cap">{{ $f->judul }}</div>@endif
        </a>
      @endforeach
    </div>
    {{ $foto->links() }}
  @endif
</div></section>
@endsection
