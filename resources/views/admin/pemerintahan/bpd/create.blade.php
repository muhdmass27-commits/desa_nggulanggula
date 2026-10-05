@extends('layouts.admin')
@section('title', 'Tambah Anggota BPD')
@section('content')
<h2 style="margin-bottom:16px">Tambah Anggota BPD</h2>
<form class="panel" method="POST" action="{{ route('admin.pemerintahan.bpd.store') }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @include('admin.pemerintahan.bpd._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan</button>
    <a class="btn ghost" href="{{ route('admin.pemerintahan.bpd.index') }}">Batal</a>
  </div>
</form>
@endsection
