{{-- Kartu orang. Variabel: $orang (KepalaDesa/PerangkatDesa/Bpd) --}}
@php $ini = collect(preg_split('/\s+/', trim($orang->nama)))->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode(''); @endphp
<div class="person">
  <div class="av">@if ($orang->foto)<img src="{{ asset('storage/'.$orang->foto) }}" alt="{{ $orang->nama }}" loading="lazy">@else{{ $ini }}@endif</div>
  <h3>{{ $orang->nama }}</h3>
  <div class="role">{{ $orang->jabatan }}</div>
  @if (!empty($orang->periode))<p>Periode {{ $orang->periode }}</p>@endif
  @if (!empty($orang->bidang))<p>{{ $orang->bidang }}</p>@endif
  @if (!empty($orang->deskripsi))<p style="margin-top:6px">{{ \Illuminate\Support\Str::limit($orang->deskripsi, 110) }}</p>@endif
</div>
