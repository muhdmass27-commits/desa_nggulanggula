@extends('layouts.admin')
@section('title', 'Edit Potensi Desa')
@section('content')
<h2 style="margin-bottom:16px">Edit Potensi Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.informasi-desa.potensi-desa.update', $potensiDesa) }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @method('PUT')
  @include('admin.informasi-desa.potensi-desa._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.informasi-desa.potensi-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
