@extends('layouts.admin')
@section('title', 'Edit Wisata')
@section('content')
<h2 style="margin-bottom:16px">Edit Wisata</h2>
<form class="panel" method="POST" action="{{ route('admin.informasi-desa.wisata.update', $wisata) }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @method('PUT')
  @include('admin.informasi-desa.wisata._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.informasi-desa.wisata.index') }}">Batal</a>
  </div>
</form>
@endsection
