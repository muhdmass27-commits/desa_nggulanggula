@extends('layouts.admin')
@section('title', 'Tambah Pendidikan')
@section('content')
<h2 style="margin-bottom:16px">Tambah Data Pendidikan</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.pendidikan.store') }}" style="max-width:480px">
  @csrf
  @include('admin.penduduk.pendidikan._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.pendidikan.index') }}">Batal</a>
  </div>
</form>
@endsection
