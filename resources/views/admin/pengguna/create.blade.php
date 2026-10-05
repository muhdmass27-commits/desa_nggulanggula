@extends('layouts.admin')
@section('title', 'Tambah Admin')
@section('content')
<h2 style="margin-bottom:16px">Tambah Akun Admin</h2>
<form class="panel" method="POST" action="{{ route('admin.pengguna.store') }}" style="max-width:480px">
  @csrf
  @include('admin.pengguna._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.pengguna.index') }}">Batal</a>
  </div>
</form>
@endsection
