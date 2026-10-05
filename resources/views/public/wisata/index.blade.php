@extends('layouts.public')
@section('title', 'Wisata Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Pariwisata', 'judul' => 'Wisata Desa', 'deskripsi' => 'Destinasi yang dapat dikunjungi wisatawan.'])

<section class="block"><div class="wrap">
  @if ($wisata->isEmpty())
    @include('public._kosong')
  @else
    <div class="grid g3">@foreach ($wisata as $item) @include('public.wisata._kartu') @endforeach</div>
    {{ $wisata->links() }}
  @endif
</div></section>
@endsection
