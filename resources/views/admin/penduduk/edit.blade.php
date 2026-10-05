@extends('layouts.admin')
@section('title', 'Edit Data Penduduk')
@section('content')
<h2 style="margin-bottom:16px">Edit Data Penduduk Tahun {{ $dataPenduduk->tahun }}</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.update', $dataPenduduk) }}" style="max-width:560px">
  @csrf
  @method('PUT')
  @include('admin.penduduk._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.index') }}">Batal</a>
  </div>
</form>
@endsection
