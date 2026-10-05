@extends('layouts.admin')
@section('title', 'Tambah Potensi Desa')
@section('content')
<h2 style="margin-bottom:16px">Tambah Potensi Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.informasi-desa.potensi-desa.store') }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @include('admin.informasi-desa.potensi-desa._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan & Publikasikan</button>
    <a class="btn ghost" href="{{ route('admin.informasi-desa.potensi-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
