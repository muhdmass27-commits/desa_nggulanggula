@extends('layouts.admin')
@section('title', 'Tambah Kepala Desa')
@section('content')
<h2 style="margin-bottom:16px">Tambah Data Kepala Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.pemerintahan.kepala-desa.store') }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @include('admin.pemerintahan.kepala-desa._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.pemerintahan.kepala-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
