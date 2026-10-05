<a href="{{ route('potensi.show', $item) }}" class="card">
  <div class="ph">@if ($item->foto)<img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" loading="lazy">@else 🌱 @endif</div>
  <div class="body">
    <span class="tag">{{ $item->kategori->nama ?? 'Potensi' }}</span>
    <h3>{{ $item->nama }}</h3>
    <p>{{ \Illuminate\Support\Str::limit(strip_tags((string) $item->deskripsi), 95) }}</p>
    @if ($item->lokasi)<span class="meta">📍 {{ $item->lokasi }}</span>@endif
  </div>
</a>
