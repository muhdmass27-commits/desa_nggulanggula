@extends('layouts.admin')
@section('title', 'Ganti Password')

@section('content')
<h2 style="margin-bottom:4px">Ganti Password</h2>
<p style="font-size:13px;color:var(--ink-soft);margin-bottom:16px">
  Masuk sebagai <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->email }})
</p>

<form class="panel" method="POST" action="{{ route('admin.akun.update') }}" style="max-width:440px">
  @csrf
  @method('PUT')

  <div class="field">
    <label for="current_password">Password Saat Ini</label>
    <input type="password" id="current_password" name="current_password" required autocomplete="current-password">
    @error('current_password') <div class="err">{{ $message }}</div> @enderror
  </div>

  <div class="field">
    <label for="password">Password Baru (minimal 8 karakter)</label>
    <input type="password" id="password" name="password" required autocomplete="new-password">
    @error('password') <div class="err">{{ $message }}</div> @enderror
  </div>

  <div class="field">
    <label for="password_confirmation">Ulangi Password Baru</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
  </div>

  <button type="submit" class="btn">Simpan Password Baru</button>
</form>
@endsection
