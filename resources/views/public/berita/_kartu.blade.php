<a href="{{ route('berita.show', $item) }}" class="card">
  <div class="ph">@if ($item->gambar)<img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">@else 📰 @endif</div>
  <div class="body">
    <span class="tag">{{ $item->kategori->nama ?? 'Umum' }}@if ($item->tanggal_publish) · {{ $item->tanggal_publish->translatedFormat('d F Y') }}@endif</span>
    <h3>{{ $item->judul }}</h3>
    <p>{{ \Illuminate\Support\Str::limit($item->ringkasan ?: strip_tags($item->isi), 95) }}</p>
  </div>
</a>
