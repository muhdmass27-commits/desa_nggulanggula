@extends('layouts.admin')
@section('title', 'Edit Foto Galeri')
@section('content')
<h2 style="margin-bottom:16px">Edit Foto Galeri</h2>
<form class="panel" method="POST" action="{{ route('admin.media.galeri.update', $galeri) }}" enctype="multipart/form-data" style="max-width:560px">
  @csrf
  @method('PUT')
  @include('admin.media.galeri._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.media.galeri.index') }}">Batal</a>
  </div>
</form>
@endsection
