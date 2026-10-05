@extends('layouts.admin')
@section('title', 'Edit Data APB Desa')
@section('content')
<h2 style="margin-bottom:16px">Edit Data APB Desa</h2>
<form class="panel" method="POST" action="{{ route('admin.transparansi.apb-desa.update', $apbDesa) }}" style="max-width:560px">
  @csrf
  @method('PUT')
  @include('admin.transparansi.apb-desa._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.transparansi.apb-desa.index') }}">Batal</a>
  </div>
</form>
@endsection
