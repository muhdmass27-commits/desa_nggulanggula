@extends('layouts.admin')
@section('title', 'Edit Pendidikan')
@section('content')
<h2 style="margin-bottom:16px">Edit Data Pendidikan</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.pendidikan.update', $pendidikan) }}" style="max-width:480px">
  @csrf
  @method('PUT')
  @include('admin.penduduk.pendidikan._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.pendidikan.index') }}">Batal</a>
  </div>
</form>
@endsection
