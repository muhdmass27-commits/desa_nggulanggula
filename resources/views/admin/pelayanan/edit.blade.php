@extends('layouts.admin')
@section('title', 'Edit Pelayanan')

@section('content')
<h2 style="margin-bottom:16px">Edit Pelayanan</h2>
<form class="panel" method="POST" action="{{ route('admin.pelayanan.update', $pelayanan) }}" style="max-width:600px">
  @csrf
  @method('PUT')
  @include('admin.pelayanan._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.pelayanan.index') }}">Batal</a>
  </div>
</form>
@endsection
