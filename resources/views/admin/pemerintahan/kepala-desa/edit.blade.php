@extends('layouts.admin')
@section('title', 'Edit Kepala Desa')
@section('content')
<h2 style="margin-bottom:16px">Edit Data Kepala Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.pemerintahan.kepala-desa.update', $kepalaDesa) }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @method('PUT')
  @include('admin.pemerintahan.kepala-desa._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.pemerintahan.kepala-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
