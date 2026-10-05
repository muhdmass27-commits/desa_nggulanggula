@extends('layouts.admin')
@section('title', 'Tambah Pekerjaan')
@section('content')
<h2 style="margin-bottom:16px">Tambah Data Pekerjaan</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.pekerjaan.store') }}" style="max-width:480px">
  @csrf
  @include('admin.penduduk.pekerjaan._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.pekerjaan.index') }}">Batal</a>
  </div>
</form>
@endsection
