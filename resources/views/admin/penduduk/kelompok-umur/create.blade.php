@extends('layouts.admin')
@section('title', 'Tambah Kelompok Umur')
@section('content')
<h2 style="margin-bottom:16px">Tambah Data Kelompok Umur</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.kelompok-umur.store') }}" style="max-width:480px">
  @csrf
  @include('admin.penduduk.kelompok-umur._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.kelompok-umur.index') }}">Batal</a>
  </div>
</form>
@endsection
