@extends('layouts.admin')
@section('title', 'Tambah Pelayanan')

@section('content')
<h2 style="margin-bottom:16px">Tambah Pelayanan</h2>
<form class="panel" method="POST" action="{{ route('admin.pelayanan.store') }}" style="max-width:600px">
  @csrf
  @include('admin.pelayanan._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.pelayanan.index') }}">Batal</a>
  </div>
</form>
@endsection
