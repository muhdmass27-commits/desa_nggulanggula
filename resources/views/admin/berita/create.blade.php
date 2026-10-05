@extends('layouts.admin')
@section('title', 'Tambah Berita')

@section('content')
<h2 style="margin-bottom:16px">Tambah Berita</h2>

<form class="panel" method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" style="max-width:640px">
  @csrf
  @include('admin.berita._form')

  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan & Publikasikan</button>
    <a class="btn ghost" href="{{ route('admin.berita.index') }}">Batal</a>
  </div>
</form>
@endsection
