@extends('layouts.admin')
@section('title', 'Tambah Foto Galeri')
@section('content')
<h2 style="margin-bottom:16px">Tambah Foto Galeri</h2>
<form class="panel" method="POST" action="{{ route('admin.media.galeri.store') }}" enctype="multipart/form-data" style="max-width:560px">
  @csrf
  @include('admin.media.galeri._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.media.galeri.index') }}">Batal</a>
  </div>
</form>
@endsection
