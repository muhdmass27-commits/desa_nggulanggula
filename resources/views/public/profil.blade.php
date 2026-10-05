@extends('layouts.public')
@section('title', 'Profil Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Profil Desa', 'judul' => $profil->nama_desa ?? 'Profil Desa', 'deskripsi' => $profil ? collect([$profil->kecamatan ? 'Kec. '.$profil->kecamatan : null, $profil->kabupaten ? 'Kab. '.$profil->kabupaten : null, $profil->provinsi])->filter()->implode(', ') : null])

<section class="block"><div class="wrap">
  @if (! $profil)
    @include('public._kosong')
  @else
    @php $kosong = fn ($v) => blank($v) || trim($v) === 'Data belum tersedia'; @endphp

    @if ($profil->foto_kantor)
      <img src="{{ asset('storage/'.$profil->foto_kantor) }}" alt="Kantor desa" style="width:100%;max-height:340px;object-fit:cover;border-radius:14px;margin-bottom:22px">
    @endif

    <div class="grid g2">
      <div class="box"><h3>Sejarah Desa</h3>
        @if ($kosong($profil->sejarah)) <p class="lede">Data belum tersedia.</p> @else <div class="prose">{{ $profil->sejarah }}</div> @endif
      </div>
      <div class="box"><h3>Kondisi Geografis</h3>
        @if ($kosong($profil->kondisi_geografis)) <p class="lede">Data belum tersedia.</p> @else <div class="prose">{{ $profil->kondisi_geografis }}</div> @endif
      </div>
      <div class="box"><h3>Visi</h3>
        @if ($kosong($profil->visi)) <p class="lede">Data belum tersedia.</p> @else <div class="prose">{{ $profil->visi }}</div> @endif
      </div>
      <div class="box"><h3>Misi</h3>
        @if ($kosong($profil->misi)) <p class="lede">Data belum tersedia.</p> @else <div class="prose">{{ $profil->misi }}</div> @endif
      </div>
    </div>

    <div class="grid g2" style="margin-top:16px">
      <div class="box"><h3>Data Wilayah</h3>
        <table class="info-table">
          <tr><th>Luas Wilayah</th><td>{{ $profil->luas_wilayah ?: 'Data belum tersedia' }}</td></tr>
          <tr><th>Batas Utara</th><td>{{ $profil->batas_utara ?: 'Data belum tersedia' }}</td></tr>
          <tr><th>Batas Selatan</th><td>{{ $profil->batas_selatan ?: 'Data belum tersedia' }}</td></tr>
          <tr><th>Batas Timur</th><td>{{ $profil->batas_timur ?: 'Data belum tersedia' }}</td></tr>
          <tr><th>Batas Barat</th><td>{{ $profil->batas_barat ?: 'Data belum tersedia' }}</td></tr>
        </table>
      </div>
      <div class="box"><h3>Identitas & Lokasi</h3>
        <table class="info-table">
          <tr><th>Desa</th><td>{{ $profil->nama_desa }}</td></tr>
          <tr><th>Kecamatan</th><td>{{ $profil->kecamatan }}</td></tr>
          <tr><th>Kabupaten</th><td>{{ $profil->kabupaten }}</td></tr>
          <tr><th>Provinsi</th><td>{{ $profil->provinsi }}</td></tr>
          <tr><th>Kode Pos</th><td>{{ $profil->kode_pos ?: 'Data belum tersedia' }}</td></tr>
          <tr><th>Alamat Kantor</th><td>{{ $profil->alamat ?: 'Data belum tersedia' }}</td></tr>
          @if ($profil->latitude && $profil->longitude)
            <tr><th>Koordinat</th><td>{{ $profil->latitude }}, {{ $profil->longitude }}</td></tr>
          @endif
        </table>
      </div>
    </div>

    @if ($profil->latitude && $profil->longitude)
      <div class="box" style="margin-top:16px">
        <h3>Peta Lokasi Desa</h3>
        @include('public._peta', ['lat' => $profil->latitude, 'lng' => $profil->longitude, 'tinggi' => 320])
      </div>
    @endif
  @endif
</div></section>
@endsection
