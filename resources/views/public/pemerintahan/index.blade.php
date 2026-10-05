@extends('layouts.public')
@section('title', 'Pemerintahan Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Pemerintahan', 'judul' => 'Pemerintahan Desa', 'deskripsi' => 'Kepala desa, perangkat desa, dan Badan Permusyawaratan Desa (BPD).'])

<section class="block"><div class="wrap">
  <div class="sec-head"><h2>Kepala Desa</h2></div>
  @if ($kepalaDesa->isEmpty()) @include('public._kosong') @else
    <div class="grid g4">@foreach ($kepalaDesa as $orang) @include('public.pemerintahan._orang') @endforeach</div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="sec-head"><h2>Perangkat Desa</h2></div>
  @if ($perangkat->isEmpty()) @include('public._kosong') @else
    <div class="grid g4">@foreach ($perangkat as $orang) @include('public.pemerintahan._orang') @endforeach</div>
  @endif
</div></section>

<section class="block"><div class="wrap">
  <div class="sec-head"><h2>Badan Permusyawaratan Desa (BPD)</h2></div>
  @if ($bpd->isEmpty()) @include('public._kosong') @else
    <div class="grid g4">@foreach ($bpd as $orang) @include('public.pemerintahan._orang') @endforeach</div>
  @endif
</div></section>
@endsection
