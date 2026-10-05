@extends('layouts.admin')
@section('title', 'Tambah Kategori Potensi')
@section('content')
<h2 style="margin-bottom:16px">Tambah Kategori Potensi</h2>
<form class="panel" method="POST" action="{{ route('admin.informasi-desa.kategori-potensi.store') }}" style="max-width:440px">
  @csrf
  @include('admin.informasi-desa.kategori-potensi._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.informasi-desa.kategori-potensi.index') }}">Batal</a>
  </div>
</form>
@endsection
