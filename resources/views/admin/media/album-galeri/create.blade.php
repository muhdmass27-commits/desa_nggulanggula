@extends('layouts.admin')
@section('title', 'Tambah Album Galeri')
@section('content')
<h2 style="margin-bottom:16px">Tambah Album Galeri</h2>
<form class="panel" method="POST" action="{{ route('admin.media.album-galeri.store') }}" style="max-width:520px">
  @csrf
  @include('admin.media.album-galeri._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.media.album-galeri.index') }}">Batal</a>
  </div>
</form>
@endsection
