{{-- FILE BARU: resources/views/public/_peta.blade.php
     Peta Google Maps tertanam tanpa perlu API key (trik resmi Google:
     parameter output=embed). Variabel: $lat, $lng, $tinggi (opsional, px). --}}
<div class="box" style="padding:0;overflow:hidden">
  <iframe
    src="https://www.google.com/maps?q={{ $lat }},{{ $lng }}&output=embed"
    width="100%" height="{{ $tinggi ?? 260 }}" style="border:0;display:block"
    loading="lazy" referrerpolicy="no-referrer-when-downgrade"
    title="Lokasi di peta"></iframe>
</div>
<a href="https://www.google.com/maps?q={{ $lat }},{{ $lng }}" target="_blank" rel="noopener" style="display:inline-block;margin-top:8px;font-size:13px;font-weight:600;color:var(--primary-dk)">Buka di Google Maps &rarr;</a>
