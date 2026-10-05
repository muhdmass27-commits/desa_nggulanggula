@extends('layouts.public')
@section('title', 'PPID')

@section('content')
@include('public._judul', ['eyebrow' => 'Keterbukaan Informasi', 'judul' => 'PPID Desa', 'deskripsi' => 'Pejabat Pengelola Informasi dan Dokumentasi Desa Nggulanggula.'])

<section class="block"><div class="wrap">
  <form method="GET" action="{{ route('ppid') }}" class="searchbar">
    <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul informasi...">
    <button type="submit" class="btn ghost sm">Cari</button>
    @if ($q !== '')<a class="btn ghost sm" href="{{ route('ppid') }}">Reset</a>@endif
  </form>

  @php $adaData = collect($kelompok)->flatten(1)->isNotEmpty(); @endphp
  @if (! $adaData)
    @include('public._kosong')
  @else
    @foreach ($kelompok as $nama => $daftar)
      @if ($daftar->isNotEmpty())
        <div class="box" style="margin-bottom:16px">
          <h3>{{ $nama }}</h3>
          <div class="ox"><table class="info-table" style="min-width:420px">
            @foreach ($daftar as $item)
              <tr>
                <th style="width:auto">{{ $item->judul }}@if($item->tanggal) <br><span style="font-weight:400;color:var(--ink-soft);font-size:12px">{{ \Illuminate\Support\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>@endif</th>
                <td>
                  @if ($item->deskripsi) <div style="margin-bottom:6px">{{ $item->deskripsi }}</div> @endif
                  @if ($item->file) <a href="{{ asset('storage/'.$item->file) }}" target="_blank" style="color:var(--primary-dk);font-weight:600">Unduh dokumen &rarr;</a> @endif
                </td>
              </tr>
            @endforeach
          </table></div>
        </div>
      @endif
    @endforeach
  @endif
</div></section>

<section class="block" id="permohonan"><div class="wrap" style="max-width:600px">
  <h2 style="margin-bottom:14px">Formulir Permohonan Informasi</h2>

  @if (session('sukses'))<div class="flash ok">{{ session('sukses') }}</div>@endif

  <form class="panel" method="POST" action="{{ route('ppid.permohonan') }}">
    @csrf
    <div class="hp"><label>Website</label><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
    <div class="field"><label for="p_nama">Nama</label><input type="text" id="p_nama" name="nama" value="{{ old('nama') }}" required>@error('nama')<div class="err">{{ $message }}</div>@enderror</div>
    <div class="field"><label for="p_instansi">Asal Instansi (opsional)</label><input type="text" id="p_instansi" name="instansi" value="{{ old('instansi') }}"></div>
    <div class="field"><label for="p_telepon">Nomor Telepon</label><input type="text" id="p_telepon" name="telepon" value="{{ old('telepon') }}" required>@error('telepon')<div class="err">{{ $message }}</div>@enderror</div>
    <div class="field"><label for="p_email">Email (opsional)</label><input type="email" id="p_email" name="email" value="{{ old('email') }}">@error('email')<div class="err">{{ $message }}</div>@enderror</div>
    <div class="field"><label for="p_isi">Informasi yang Dimohon</label><textarea id="p_isi" name="isi" required>{{ old('isi') }}</textarea>@error('isi')<div class="err">{{ $message }}</div>@enderror</div>
    <button type="submit" class="btn">Kirim Permohonan</button>
  </form>
</div></section>
@endsection
