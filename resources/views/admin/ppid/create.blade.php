@extends('layouts.admin')
@section('title', 'Tambah Informasi PPID')
@section('content')
<h2 style="margin-bottom:16px">Tambah Informasi PPID</h2>
<form class="panel" method="POST" action="{{ route('admin.ppid.store') }}" enctype="multipart/form-data" style="max-width:620px">
  @csrf
  @include('admin.ppid._form')
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.ppid.index') }}">Batal</a>
  </div>
</form>
@endsection
