{{-- GANTI SELURUH ISI FILE resources/views/admin/dashboard.blade.php --}}
{{-- Versi Kelompok B-2. --}}
@extends('layouts.admin')
@section('title', 'Ringkasan')

@section('content')
<h2 style="margin-bottom:4px">Ringkasan</h2>
<p style="color:var(--ink-soft);font-size:13.5px;margin-bottom:20px">Ikhtisar data yang tersimpan di database.</p>

<div class="grid g4">
  <a href="{{ route('admin.berita.index') }}" class="stat-card"><b>{{ $ringkasan['berita_total'] }}</b><span>Total Berita ({{ $ringkasan['berita_published'] }} publish / {{ $ringkasan['berita_draft'] }} draft)</span></a>
  <a href="{{ route('admin.pelayanan.index') }}" class="stat-card"><b>{{ $ringkasan['pelayanan_total'] }}</b><span>Pelayanan</span></a>
  <a href="{{ route('admin.pemerintahan.perangkat-desa.index') }}" class="stat-card"><b>{{ $ringkasan['perangkat_total'] }}</b><span>Perangkat Desa</span></a>
  <a href="{{ route('admin.pemerintahan.bpd.index') }}" class="stat-card"><b>{{ $ringkasan['bpd_total'] }}</b><span>Anggota BPD</span></a>
  <a href="{{ route('admin.penduduk.index') }}" class="stat-card"><b>{{ $ringkasan['penduduk_terbaru']->jumlah_penduduk ?? '-' }}</b><span>Jumlah Penduduk (data terbaru{{ $ringkasan['penduduk_terbaru'] ? ', tahun '.$ringkasan['penduduk_terbaru']->tahun : '' }})</span></a>
  <a href="{{ route('admin.informasi-desa.potensi-desa.index') }}" class="stat-card"><b>{{ $ringkasan['potensi_total'] }}</b><span>Potensi Desa ({{ $ringkasan['potensi_published'] }} published)</span></a>
  <a href="{{ route('admin.informasi-desa.wisata.index') }}" class="stat-card"><b>{{ $ringkasan['wisata_total'] }}</b><span>Wisata ({{ $ringkasan['wisata_published'] }} published)</span></a>
  <a href="{{ route('admin.media.galeri.index') }}" class="stat-card"><b>{{ $ringkasan['galeri_total'] }}</b><span>Foto Galeri</span></a>
  <a href="{{ route('admin.pengaduan.index', ['status' => 'menunggu']) }}" class="stat-card"><b>{{ $ringkasan['pengaduan_menunggu'] }}</b><span>Pengaduan Menunggu</span></a>
</div>

<div class="admin-card" style="margin-top:20px">
  <h3 style="font-size:15px;margin-bottom:10px">Pengaturan cepat</h3>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <a class="btn ghost sm" href="{{ route('admin.profil-desa.edit') }}">Identitas Desa</a>
    <a class="btn ghost sm" href="{{ route('admin.pemerintahan.kepala-desa.index') }}">Kepala Desa</a>
    <a class="btn ghost sm" href="{{ route('admin.kontak.edit') }}">Info Kontak</a>
    <a class="btn ghost sm" href="{{ route('admin.pengaturan-website.edit') }}">Pengaturan Website</a>
  </div>
</div>

<div class="admin-card" style="margin-top:20px">
  <h3 style="font-size:15px;margin-bottom:8px">Progres pembangunan sistem</h3>
  <p style="font-size:13.5px;color:var(--ink-soft);margin:0">
    Seluruh modul <b>Admin Panel</b> kini sudah aktif dan tersambung ke database:
    Berita, Kategori Berita, Pelayanan, Kepala Desa, Perangkat Desa, BPD, Data Penduduk,
    Pendidikan, Pekerjaan, Kelompok Umur, Kategori Potensi, Potensi Desa, Wisata,
    APB Desa, Pembangunan, Album Galeri, Galeri, PPID, Pengaduan, serta pengaturan
    Profil Desa, Kontak, dan Pengaturan Website. Tahap berikutnya: <b>halaman publik</b>
    untuk semua modul di atas (termasuk form pengiriman pengaduan oleh masyarakat).
  </p>
</div>
@endsection
