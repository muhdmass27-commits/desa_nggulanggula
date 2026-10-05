@extends('layouts.admin')
@section('title', 'Tambah Perangkat Desa')
@section('content')
<h2 style="margin-bottom:16px">Tambah Perangkat Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.pemerintahan.perangkat-desa.store') }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @include('admin.pemerintahan.perangkat-desa._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.pemerintahan.perangkat-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
