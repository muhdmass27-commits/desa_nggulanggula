@extends('layouts.admin')
@section('title', 'Edit Pekerjaan')
@section('content')
<h2 style="margin-bottom:16px">Edit Data Pekerjaan</h2>
<form class="panel" method="POST" action="{{ route('admin.penduduk.pekerjaan.update', $pekerjaan) }}" style="max-width:480px">
  @csrf
  @method('PUT')
  @include('admin.penduduk.pekerjaan._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.penduduk.pekerjaan.index') }}">Batal</a>
  </div>
</form>
@endsection
