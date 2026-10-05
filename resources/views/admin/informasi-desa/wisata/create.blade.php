@extends('layouts.admin')
@section('title', 'Tambah Wisata')
@section('content')
<h2 style="margin-bottom:16px">Tambah Wisata</h2>
<form class="panel" method="POST" action="{{ route('admin.informasi-desa.wisata.store') }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @include('admin.informasi-desa.wisata._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan & Publikasikan</button>
    <a class="btn ghost" href="{{ route('admin.informasi-desa.wisata.index') }}">Batal</a>
  </div>
</form>
@endsection
