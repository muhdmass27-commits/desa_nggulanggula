@extends('layouts.admin')
@section('title', 'Edit Kategori Berita')
@section('content')
<h2 style="margin-bottom:16px">Edit Kategori Berita</h2>
<form class="panel" method="POST" action="{{ route('admin.informasi-desa.kategori-berita.update', $kategoriBerita) }}" style="max-width:440px">
  @csrf
  @method('PUT')
  @include('admin.informasi-desa.kategori-berita._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.informasi-desa.kategori-berita.index') }}">Batal</a>
  </div>
</form>
@endsection
