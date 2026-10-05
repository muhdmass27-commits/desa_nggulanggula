@extends('layouts.admin')
@section('title', 'Tambah Data Penduduk')
@section('content')
<h2 style="margin-bottom:16px">Tambah Data Penduduk</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.store') }}" style="max-width:560px">
  @csrf
  @include('admin.penduduk._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.index') }}">Batal</a>
  </div>
</form>
@endsection
