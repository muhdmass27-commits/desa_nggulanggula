@extends('layouts.public')
@section('title', 'Beranda')

@section('content')
<section class="hero">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--accent);font-weight:600;font-size:13px">Website Resmi Pemerintah Desa</div>
    <h1>Desa Nggulanggula</h1>
    <p>Kecamatan Siompu, Kabupaten Buton Selatan, Sulawesi Tenggara.</p>
  </div>
</section>
<section class="block">
  <div class="wrap">
    <div class="admin-card" style="max-width:640px">
      <h3 style="font-size:15px;margin-bottom:8px">Halaman beranda lengkap belum dibangun</h3>
      <p style="font-size:13.5px;color:var(--ink-soft);margin:0 0 12px">
        Ini halaman sementara Tahap 3. Seluruh halaman publik (Profil Desa, Pemerintahan,
        Infografis, Pelayanan, Potensi, Wisata, Transparansi, Galeri, PPID, Pengaduan,
        Kontak) akan dibangun lengkap dan tersambung ke database di <b>Tahap 5</b>.
      </p>
      <a class="btn" href="{{ route('berita.index') }}">Lihat Halaman Berita →</a>
    </div>
  </div>
</section>
@endsection
