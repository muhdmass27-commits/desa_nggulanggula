@extends('layouts.admin')
@section('title', 'Edit Berita')

@section('content')
<h2 style="margin-bottom:16px">Edit Berita</h2>

<form class="panel" method="POST" action="{{ route('admin.berita.update', $berita) }}" enctype="multipart/form-data" style="max-width:640px">
  @csrf
  @method('PUT')
  @include('admin.berita._form')

  <div style="display:flex;gap:10px">
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a class="btn ghost" href="{{ route('admin.berita.index') }}">Batal</a>
  </div>
</form>
@endsection
