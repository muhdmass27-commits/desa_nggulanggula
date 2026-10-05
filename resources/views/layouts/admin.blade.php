{{-- GANTI SELURUH ISI FILE resources/views/layouts/admin.blade.php --}}
{{-- Versi Kelompok B-2 - semua menu sudah aktif, tidak ada lagi "Segera hadir". --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Dashboard Admin') - Desa Nggula Nggula</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="admin-body">
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="abrand">
      <b>Desa Nggula Nggula</b>
      <span>Dashboard Admin</span>
    </div>

    <div class="grp"></div>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Ringkasan</a>

    <div class="grp">Pemerintahan</div>
    <a href="{{ route('admin.pemerintahan.kepala-desa.index') }}" class="{{ request()->routeIs('admin.pemerintahan.kepala-desa.*') ? 'active' : '' }}">Kepala Desa</a>
    <a href="{{ route('admin.pemerintahan.perangkat-desa.index') }}" class="{{ request()->routeIs('admin.pemerintahan.perangkat-desa.*') ? 'active' : '' }}">Perangkat Desa</a>
    <a href="{{ route('admin.pemerintahan.bpd.index') }}" class="{{ request()->routeIs('admin.pemerintahan.bpd.*') ? 'active' : '' }}">BPD</a>

    <div class="grp">Penduduk</div>
    <a href="{{ route('admin.penduduk.index') }}" class="{{ request()->routeIs('admin.penduduk.index') || request()->routeIs('admin.penduduk.create') || request()->routeIs('admin.penduduk.edit') ? 'active' : '' }}">Data Penduduk</a>
    <a href="{{ route('admin.penduduk.pendidikan.index') }}" class="{{ request()->routeIs('admin.penduduk.pendidikan.*') ? 'active' : '' }}">Pendidikan</a>
    <a href="{{ route('admin.penduduk.pekerjaan.index') }}" class="{{ request()->routeIs('admin.penduduk.pekerjaan.*') ? 'active' : '' }}">Pekerjaan</a>
    <a href="{{ route('admin.penduduk.kelompok-umur.index') }}" class="{{ request()->routeIs('admin.penduduk.kelompok-umur.*') ? 'active' : '' }}">Kelompok Umur</a>

    <div class="grp">Informasi Desa</div>
    <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">Berita</a>
    <a href="{{ route('admin.informasi-desa.kategori-berita.index') }}" class="{{ request()->routeIs('admin.informasi-desa.kategori-berita.*') ? 'active' : '' }}">Kategori Berita</a>
    <a href="{{ route('admin.informasi-desa.potensi-desa.index') }}" class="{{ request()->routeIs('admin.informasi-desa.potensi-desa.*') ? 'active' : '' }}">Potensi Desa</a>
    <a href="{{ route('admin.informasi-desa.kategori-potensi.index') }}" class="{{ request()->routeIs('admin.informasi-desa.kategori-potensi.*') ? 'active' : '' }}">Kategori Potensi</a>
    <a href="{{ route('admin.informasi-desa.wisata.index') }}" class="{{ request()->routeIs('admin.informasi-desa.wisata.*') ? 'active' : '' }}">Wisata</a>

    <div class="grp">Transparansi</div>
    <a href="{{ route('admin.transparansi.apb-desa.index') }}" class="{{ request()->routeIs('admin.transparansi.apb-desa.*') ? 'active' : '' }}">APB Desa</a>
    <a href="{{ route('admin.transparansi.pembangunan.index') }}" class="{{ request()->routeIs('admin.transparansi.pembangunan.*') ? 'active' : '' }}">Pembangunan</a>

    <div class="grp">Media</div>
    <a href="{{ route('admin.media.album-galeri.index') }}" class="{{ request()->routeIs('admin.media.album-galeri.*') ? 'active' : '' }}">Album Galeri</a>
    <a href="{{ route('admin.media.galeri.index') }}" class="{{ request()->routeIs('admin.media.galeri.*') ? 'active' : '' }}">Galeri</a>

    <div class="grp">Pelayanan Informasi</div>
    <a href="{{ route('admin.pelayanan.index') }}" class="{{ request()->routeIs('admin.pelayanan.*') ? 'active' : '' }}">Pelayanan</a>
    <a href="{{ route('admin.ppid.index') }}" class="{{ request()->routeIs('admin.ppid.*') ? 'active' : '' }}">PPID</a>
    <a href="{{ route('admin.pengaduan.index') }}" class="{{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">Pengaduan</a>

    <div class="grp">Pengaturan</div>
    <a href="{{ route('admin.profil-desa.edit') }}" class="{{ request()->routeIs('admin.profil-desa.*') ? 'active' : '' }}">Profil Desa</a>
    <a href="{{ route('admin.kontak.edit') }}" class="{{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">Kontak</a>
    <a href="{{ route('admin.pengaturan-website.edit') }}" class="{{ request()->routeIs('admin.pengaturan-website.*') ? 'active' : '' }}">Pengaturan Website</a>
    <a href="{{ route('admin.akun.edit') }}" class="{{ request()->routeIs('admin.akun.*') ? 'active' : '' }}">Ganti Password</a>

    <div class="grp">Pengguna</div>
    <a href="{{ route('admin.pengguna.index') }}" class="{{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">Semua Admin</a>

    <div class="grp"></div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" style="all:unset;display:block;padding:8px 18px;font-size:13.5px;color:#DCE7DB;cursor:pointer;width:100%;text-align:left">Logout</button>
    </form>
  </aside>

  <div class="admin-main">
    <div class="admin-top">
      <button class="btn ghost sm" type="button" disabled>☰</button>
      <div style="font-size:13px;color:var(--ink-soft)">Masuk sebagai <b>{{ auth()->user()->name }}</b></div>
    </div>
    <div class="admin-content">
      @if (session('status'))
        <div class="alert ok">{{ session('status') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert err">
          <ul style="margin:0;padding-left:18px">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </div>
  </div>
</div>
</body>
</html>
