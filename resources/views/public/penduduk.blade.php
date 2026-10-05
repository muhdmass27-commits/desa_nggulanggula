@extends('layouts.public')
@section('title', 'Data Penduduk')

@section('content')
@include('public._judul', ['eyebrow' => 'Infografis', 'judul' => 'Data Penduduk', 'deskripsi' => 'Statistik kependudukan desa.'])

<section class="block"><div class="wrap">
  @if (! $penduduk)
    @include('public._kosong')
  @else
    <div class="chips">
      @foreach ($daftarTahun as $th)
        <a class="chip {{ $th == $tahun ? 'on' : '' }}" href="{{ route('penduduk', ['tahun' => $th]) }}">{{ $th }}</a>
      @endforeach
    </div>

    <div class="grid g4" style="margin-bottom:22px">
      <div class="stat-card"><b>{{ number_format($penduduk->jumlah_penduduk, 0, ',', '.') }}</b><span>Jumlah Penduduk</span></div>
      <div class="stat-card"><b>{{ number_format($penduduk->jumlah_kk, 0, ',', '.') }}</b><span>Kepala Keluarga</span></div>
      <div class="stat-card"><b>{{ number_format($penduduk->laki_laki, 0, ',', '.') }}</b><span>Laki-laki</span></div>
      <div class="stat-card"><b>{{ number_format($penduduk->perempuan, 0, ',', '.') }}</b><span>Perempuan</span></div>
      <div class="stat-card"><b>{{ $penduduk->jumlah_dusun }}</b><span>Dusun</span></div>
      <div class="stat-card"><b>{{ $penduduk->jumlah_rw }}</b><span>RW</span></div>
      <div class="stat-card"><b>{{ $penduduk->jumlah_rt }}</b><span>RT</span></div>
    </div>

    @if ($penduduk->keterangan)<p class="lede" style="margin-bottom:18px">{{ $penduduk->keterangan }}</p>@endif

    @php
      $blok = [
        ['Tingkat Pendidikan', $pendidikan, 'jenjang'],
        ['Jenis Pekerjaan', $pekerjaan, 'jenis_pekerjaan'],
        ['Kelompok Umur', $kelompokUmur, 'rentang_usia'],
      ];
    @endphp
    <div class="grid g2">
      @foreach ($blok as $b)
        @php [$judulBlok, $data, $kolom] = $b; @endphp
        <div class="box">
          <h3>{{ $judulBlok }} ({{ $tahun }})</h3>
          @if ($data->isEmpty())
            <p class="lede">Data belum tersedia.</p>
          @else
            @php $maks = max(1, $data->max('jumlah')); @endphp
            @foreach ($data as $row)
              <div class="bar-row">
                <div class="lbl"><span>{{ $row->$kolom }}</span><b>{{ number_format($row->jumlah, 0, ',', '.') }}</b></div>
                <div class="bar"><i style="width:{{ round($row->jumlah / $maks * 100) }}%"></i></div>
              </div>
            @endforeach
          @endif
        </div>
      @endforeach
    </div>
  @endif
</div></section>
@endsection
