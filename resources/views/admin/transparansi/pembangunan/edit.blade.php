@extends('layouts.admin')
@section('title', 'Edit Data Pembangunan')
@section('content')
<h2 style="margin-bottom:16px">Edit Data Pembangunan</h2>
<form class="panel" method="POST" action="{{ route('admin.transparansi.pembangunan.update', $pembangunan) }}" enctype="multipart/form-data" style="max-width:620px">
  @csrf
  @method('PUT')
  @include('admin.transparansi.pembangunan._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.transparansi.pembangunan.index') }}">Batal</a>
  </div>
</form>
@endsection
