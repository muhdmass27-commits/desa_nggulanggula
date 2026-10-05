@extends('layouts.admin')
@section('title', 'Tambah Data APB Desa')
@section('content')
<h2 style="margin-bottom:16px">Tambah Data APB Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.transparansi.apb-desa.store') }}" style="max-width:560px">
  @csrf
  @include('admin.transparansi.apb-desa._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.transparansi.apb-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
