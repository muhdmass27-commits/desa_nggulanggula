@extends('layouts.admin')
@section('title', 'Detail Pengaduan')
@section('content')
<div class="toolbar">
  <h2>Detail Pengaduan</h2>
  <a class="btn ghost" href="{{ route('admin.pengaduan.index') }}">&larr; Kembali</a>
</div>

<div class="admin-card" style="max-width:720px">
  <div class="ox"><table style="min-width:0">
    <tr><th style="width:150px">No. Pengaduan</th><td>{{ $pengaduan->nomor_pengaduan }}</td></tr>
    <tr><th>Tanggal Masuk</th><td>{{ $pengaduan->created_at->format('d-m-Y H:i') }}</td></tr>
    <tr><th>Nama</th><td>{{ $pengaduan->nama }}</td></tr>
    <tr><th>Telepon</th><td>{{ $pengaduan->telepon }}</td></tr>
    <tr><th>Email</th><td>{{ $pengaduan->email ?: '-' }}</td></tr>
    <tr><th>Kategori</th><td>{{ $pengaduan->kategori }}</td></tr>
    <tr><th>Judul</th><td>{{ $pengaduan->judul ?: '-' }}</td></tr>
    <tr><th>Lokasi</th><td>{{ $pengaduan->lokasi ?: '-' }}</td></tr>
    <tr><th>Lampiran</th><td>@if($pengaduan->lampiran)<a href="{{ asset('storage/'.$pengaduan->lampiran) }}" target="_blank" style="color:var(--primary-dk);font-weight:600">Lihat lampiran</a>@else - @endif</td></tr>
  </table></div>
  <h3 style="font-size:14px;margin:16px 0 6px">Isi Pengaduan</h3>
  <div style="white-space:pre-line;font-size:14px">{{ $pengaduan->isi }}</div>
</div>

<form class="panel" method="POST" action="{{ route('admin.pengaduan.update', $pengaduan) }}" style="max-width:720px">
  @csrf
  @method('PUT')
  <h3 style="font-size:15px;margin-bottom:12px">Status & Tanggapan</h3>
  <div class="field">
    <label for="status">Status</label>
    <select id="status" name="status" required>
      @foreach (['menunggu' => 'Menunggu', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'] as $val => $lbl)
        <option value="{{ $val }}" @selected(old('status', $pengaduan->status) == $val)>{{ $lbl }}</option>
      @endforeach
    </select>
    @error('status') <div class="err">{{ $message }}</div> @enderror
  </div>
  <div class="field">
    <label for="tanggapan">Tanggapan Admin</label>
    <textarea id="tanggapan" name="tanggapan">{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
    @error('tanggapan') <div class="err">{{ $message }}</div> @enderror
    @if ($pengaduan->tanggal_tanggapan)
      <div style="font-size:12px;color:var(--ink-soft);margin-top:4px">Terakhir ditanggapi: {{ $pengaduan->tanggal_tanggapan->format('d-m-Y H:i') }}</div>
    @endif
  </div>
  <button type="submit" class="btn">Simpan Status & Tanggapan</button>
</form>
@endsection
