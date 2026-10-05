@extends('layouts.admin')
@section('title', 'Edit Perangkat Desa')
@section('content')
<h2 style="margin-bottom:16px">Edit Perangkat Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.pemerintahan.perangkat-desa.update', $perangkatDesa) }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @method('PUT')
  @include('admin.pemerintahan.perangkat-desa._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.pemerintahan.perangkat-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
