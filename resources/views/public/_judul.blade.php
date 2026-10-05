{{-- Kepala halaman (hero). Variabel: $eyebrow, $judul, $deskripsi (opsional) --}}
<section class="hero">
  <div class="wrap">
    <div class="eyebrow">{{ $eyebrow ?? '' }}</div>
    <h1>{{ $judul }}</h1>
    @if (!empty($deskripsi))<p>{{ $deskripsi }}</p>@endif
  </div>
</section>
