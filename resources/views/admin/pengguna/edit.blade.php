@extends('layouts.admin')
@section('title', 'Edit Admin')
@section('content')
<h2 style="margin-bottom:16px">Edit Akun Admin</h2>
<form class="panel" method="POST" action="{{ route('admin.pengguna.update', $pengguna) }}" style="max-width:480px">
  @csrf
  @method('PUT')
  @include('admin.pengguna._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.pengguna.index') }}">Batal</a>
  </div>
</form>
@endsection
