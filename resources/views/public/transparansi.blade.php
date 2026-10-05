@extends('layouts.public')
@section('title', 'Transparansi Desa')

@section('content')
@include('public._judul', ['eyebrow' => 'Keuangan Desa', 'judul' => 'Transparansi Desa', 'deskripsi' => 'Anggaran Pendapatan dan Belanja Desa (APB Desa) serta progres pembangunan.'])

<section class="block"><div class="wrap">
  @if ($daftarTahun->isEmpty())
    @include('public._kosong')
  @else
    <div class="chips">
      @foreach ($daftarTahun as $th)
        <a class="chip {{ $th == $tahun ? 'on' : '' }}" href="{{ route('transparansi', ['tahun' => $th]) }}">{{ $th }}</a>
      @endforeach
    </div>

    <div class="grid g4" style="margin-bottom:24px">
      <div class="stat-card"><b>Rp {{ number_format($ringkasan['Pendapatan']['anggaran'], 0, ',', '.') }}</b><span>Pendapatan (Anggaran)</span></div>
      <div class="stat-card"><b>Rp {{ number_format($ringkasan['Belanja']['anggaran'], 0, ',', '.') }}</b><span>Belanja (Anggaran)</span></div>
      <div class="stat-card"><b>Rp {{ number_format($ringkasan['Pembiayaan']['anggaran'], 0, ',', '.') }}</b><span>Pembiayaan (Anggaran)</span></div>
      <div class="stat-card"><b>{{ $selisih === null ? '-' : 'Rp '.number_format($selisih, 0, ',', '.') }}</b><span>Surplus / Defisit</span></div>
    </div>

    <div class="grid g2" style="margin-bottom:24px">
      @foreach (['Pendapatan', 'Belanja', 'Pembiayaan'] as $kat)
        <div class="box">
          <h3>{{ $kat }} {{ $tahun }}</h3>
          @if ($ringkasan[$kat]['baris']->isEmpty())
            <p class="lede">Data belum tersedia.</p>
          @else
            <div class="bar-row">
              <div class="lbl"><span>Realisasi</span><b>{{ $ringkasan[$kat]['persen'] }}%</b></div>
              <div class="bar {{ $kat === 'Belanja' ? 'gold' : '' }}"><i style="width:{{ $ringkasan[$kat]['persen'] }}%"></i></div>
            </div>
            <div class="ox" style="margin-top:10px"><table class="info-table">
              @foreach ($ringkasan[$kat]['baris'] as $b)
                <tr><th>{{ $b->subkategori ?: $kat }}</th><td>Rp {{ number_format($b->anggaran, 0, ',', '.') }} <span style="color:var(--ink-soft)">(realisasi Rp {{ number_format($b->realisasi, 0, ',', '.') }})</span></td></tr>
              @endforeach
            </table></div>
          @endif
        </div>
      @endforeach
    </div>

    <div class="box">
      <h3>Program Pembangunan {{ $tahun }}</h3>
      @if ($pembangunan->isEmpty())
        <p class="lede">Data belum tersedia.</p>
      @else
        <div class="ox"><table class="info-table" style="min-width:520px">
          <tr><th>Program</th><th>Lokasi</th><th>Anggaran</th><th>Progress</th><th>Status</th></tr>
          @foreach ($pembangunan as $p)
            <tr>
              <td>{{ $p->nama_program }}</td><td>{{ $p->lokasi ?: '-' }}</td>
              <td>Rp {{ number_format($p->anggaran, 0, ',', '.') }}</td>
              <td>{{ $p->progress }}%</td>
              <td>{{ ucfirst($p->status) }}</td>
            </tr>
          @endforeach
        </table></div>
      @endif
    </div>
  @endif
</div></section>
@endsection
