@extends('layouts.admin')
@section('title', 'Edit Anggota BPD')
@section('content')
<h2 style="margin-bottom:16px">Edit Anggota BPD</h2>
<form class="panel" method="POST" action="{{ route('admin.pemerintahan.bpd.update', $bpd) }}" enctype="multipart/form-data" style="max-width:600px">
  @csrf
  @method('PUT')
  @include('admin.pemerintahan.bpd._form')
  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.pemerintahan.bpd.index') }}">Batal</a>
  </div>
</form>
@endsection
