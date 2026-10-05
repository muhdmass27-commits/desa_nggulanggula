{{-- GANTI SELURUH ISI FILE resources/views/layouts/public.blade.php
     Layout publik lengkap (Tahap 5): navbar responsif, footer, data dari database.
     Variabel $situs, $kontakSitus, $profilSitus disediakan AppServiceProvider. --}}
@php
  $namaDesa = $profilSitus->nama_desa ?? $situs->nama_desa ?? 'Desa Nggulanggula';
  $namaWebsite = $situs->nama_website ?? ('Website Resmi ' . $namaDesa);
  $logo = $situs->logo ?? $profilSitus->logo ?? null;
  $favicon = $situs->favicon ?? null;
  $wilayah = collect([
      $profilSitus->kecamatan ?? null ? 'Kec. ' . $profilSitus->kecamatan : null,
      $profilSitus->kabupaten ?? null ? 'Kab. ' . $profilSitus->kabupaten : null,
  ])->filter()->implode(', ');
  $inisial = collect(preg_split('/\s+/', trim($namaDesa)))->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('');
  $aman = fn ($u) => \Illuminate\Support\Str::startsWith((string) $u, ['http://', 'https://']) ? $u : null;
  $sosial = collect([
      'Facebook' => $aman($kontakSitus->facebook ?? $situs->facebook ?? null),
      'Instagram' => $aman($kontakSitus->instagram ?? $situs->instagram ?? null),
      'YouTube' => $aman($kontakSitus->youtube ?? $situs->youtube ?? null),
  ])->filter();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Beranda') | {{ $namaWebsite }}</title>
<meta name="description" content="{{ $situs->deskripsi ?? ('Website resmi pemerintah ' . $namaDesa) }}">
@if ($favicon)<link rel="icon" href="{{ asset('storage/' . $favicon) }}">@endif
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="pub-top" id="pubTop">
  <div class="wrap">
    <div class="pub-bar">
      <a href="{{ route('home') }}" class="brand">
        @if ($logo)
          <img src="{{ asset('storage/' . $logo) }}" alt="Logo {{ $namaDesa }}">
        @else
          <span class="crest">{{ $inisial }}</span>
        @endif
        <span class="bt"><b>{{ $namaDesa }}</b>@if ($wilayah)<small>{{ $wilayah }}</small>@endif</span>
      </a>

      <button type="button" class="nav-toggle" aria-label="Buka menu" onclick="document.getElementById('pubTop').classList.toggle('open')">&#9776;</button>

      <nav class="pub-nav" aria-label="Menu utama">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'on' : '' }}">Beranda</a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'on' : '' }}">Profil</a>
        <a href="{{ route('pemerintahan') }}" class="{{ request()->routeIs('pemerintahan') ? 'on' : '' }}">Pemerintahan</a>
        <a href="{{ route('penduduk') }}" class="{{ request()->routeIs('penduduk') ? 'on' : '' }}">Penduduk</a>
        <a href="{{ route('berita.index') }}" class="{{ request()->routeIs('berita.*') ? 'on' : '' }}">Berita</a>
        <a href="{{ route('potensi.index') }}" class="{{ request()->routeIs('potensi.*') ? 'on' : '' }}">Potensi</a>
        <a href="{{ route('wisata.index') }}" class="{{ request()->routeIs('wisata.*') ? 'on' : '' }}">Wisata</a>
        <a href="{{ route('transparansi') }}" class="{{ request()->routeIs('transparansi') ? 'on' : '' }}">Transparansi</a>
        <a href="{{ route('galeri.index') }}" class="{{ request()->routeIs('galeri.*') ? 'on' : '' }}">Galeri</a>
        <div class="has-sub">
          <span class="sub-t">Layanan</span>
          <div class="sub">
            <a href="{{ route('pelayanan.index') }}" class="{{ request()->routeIs('pelayanan.*') ? 'on' : '' }}">Pelayanan</a>
            <a href="{{ route('ppid') }}" class="{{ request()->routeIs('ppid') ? 'on' : '' }}">PPID</a>
            <a href="{{ route('pengaduan.index') }}" class="{{ request()->routeIs('pengaduan.*') ? 'on' : '' }}">Pengaduan</a>
          </div>
        </div>
        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'on' : '' }}">Kontak</a>
      </nav>
    </div>
  </div>
</header>

<main>
  @yield('content')
</main>

<footer class="pub">
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <h4>{{ $namaDesa }}</h4>
        <p>
          {{ collect([$profilSitus->kecamatan ?? null, $profilSitus->kabupaten ?? null, $profilSitus->provinsi ?? null])->filter()->implode(', ') }}
        </p>
        @if ($kontakSitus->alamat ?? $profilSitus->alamat ?? null)
          <p>{{ $kontakSitus->alamat ?? $profilSitus->alamat }}</p>
        @endif
        @if ($sosial->isNotEmpty())
          <p style="margin-top:8px">
            @foreach ($sosial as $nama => $url)
              <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" style="margin-right:10px;text-decoration:underline">{{ $nama }}</a>
            @endforeach
          </p>
        @endif
      </div>
      <div>
        <h4>Menu</h4>
        <ul>
          <li><a href="{{ route('profil') }}">Profil Desa</a></li>
          <li><a href="{{ route('berita.index') }}">Berita</a></li>
          <li><a href="{{ route('transparansi') }}">Transparansi</a></li>
          <li><a href="{{ route('pelayanan.index') }}">Pelayanan</a></li>
          <li><a href="{{ route('ppid') }}">PPID</a></li>
          <li><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
        </ul>
      </div>
      <div>
        <h4>Kontak</h4>
        @if ($kontakSitus->telepon ?? null)<p>Telp: {{ $kontakSitus->telepon }}</p>@endif
        @if ($kontakSitus->whatsapp ?? null)<p>WhatsApp: {{ $kontakSitus->whatsapp }}</p>@endif
        @if ($kontakSitus->email ?? null)<p>{{ $kontakSitus->email }}</p>@endif
        @if ($kontakSitus->jam_pelayanan ?? null)<p>{{ $kontakSitus->jam_pelayanan }}</p>@endif
        @unless (($kontakSitus->telepon ?? null) || ($kontakSitus->whatsapp ?? null) || ($kontakSitus->email ?? null) || ($kontakSitus->jam_pelayanan ?? null))
          <p>Data kontak belum tersedia.</p>
        @endunless
      </div>
    </div>
    <div class="foot-bottom">
      <span>{{ $situs->footer ?? ('© ' . date('Y') . ' Pemerintah ' . $namaDesa . '. Hak cipta dilindungi.') }}</span>
      <a href="{{ route('admin.login') }}">Login Admin</a>
    </div>
  </div>
</footer>
</body>
</html>
