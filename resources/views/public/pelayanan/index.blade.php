@extends('layouts.public')
@section('title', 'Pelayanan Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Layanan Publik', 'judul' => 'Pelayanan Desa', 'deskripsi' => 'Jenis layanan, persyaratan, prosedur, waktu, dan biaya.'])

<section class="block"><div class="wrap">
  @if ($pelayanan->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g3">
      @foreach ($pelayanan as $item)
        <a href="{{ route('pelayanan.show', $item) }}" class="card">
          <div class="body">
            @if ($item->kategori)<span class="tag">{{ $item->kategori }}</span>@endif
            <h3>{{ $item->nama }}</h3>
            <span class="meta">{{ $item->waktu_pelayanan ? '⏱ '.$item->waktu_pelayanan.' · ' : '' }}💰 {{ $item->biaya ?: 'Gratis' }}</span>
          </div>
        </a>
      @endforeach
    </div>
  @endif
</div></section>
@endsection
