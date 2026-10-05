@extends('layouts.public')
@section('title', 'Kontak')

@section('content')
@include('public._judul', ['eyebrow' => 'Hubungi Kami', 'judul' => 'Kontak Desa', 'deskripsi' => 'Kami siap membantu pada jam pelayanan kantor desa.'])

<section class="block"><div class="wrap">
  <div class="grid g2">
    <div class="box">
      <h3>Informasi Kontak</h3>
      <table class="info-table">
        <tr><th>Alamat</th><td>{{ $kontak->alamat ?? $profil->alamat ?? 'Data belum tersedia' }}</td></tr>
        <tr><th>Telepon</th><td>{{ $kontak->telepon ?? 'Data belum tersedia' }}</td></tr>
        <tr><th>WhatsApp</th><td>{{ $kontak->whatsapp ?? 'Data belum tersedia' }}</td></tr>
        <tr><th>Email</th><td>{{ $kontak->email ?? $profil->email ?? 'Data belum tersedia' }}</td></tr>
        <tr><th>Jam Pelayanan</th><td>{{ $kontak->jam_pelayanan ?? 'Data belum tersedia' }}</td></tr>
      </table>
    </div>
    @if (($kontak->latitude ?? null) && ($kontak->longitude ?? null))
      <div class="box">
        <h3>Peta Lokasi</h3>
        @include('public._peta', ['lat' => $kontak->latitude, 'lng' => $kontak->longitude])
      </div>
    @endif
    <div class="box">
      <h3>Media Sosial</h3>
      @php
        $aman = fn ($u) => \Illuminate\Support\Str::startsWith((string) $u, ['http://', 'https://']) ? $u : null;
        $sosial = collect(['Facebook' => $aman($kontak->facebook ?? null), 'Instagram' => $aman($kontak->instagram ?? null), 'YouTube' => $aman($kontak->youtube ?? null)])->filter();
      @endphp
      @if ($sosial->isEmpty())
        <p class="lede">Data belum tersedia.</p>
      @else
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px">
          @foreach ($sosial as $nama => $url)
            <li><a href="{{ $url }}" target="_blank" rel="noopener noreferrer" style="color:var(--primary-dk);font-weight:600">{{ $nama }} &rarr;</a></li>
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</div></section>
@endsection
