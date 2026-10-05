<div class="field">
  <label for="tahun">Tahun</label>
  <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $apbDesa->tahun ?? date('Y')) }}" required>
  @error('tahun') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="kategori">Kategori</label>
  <select id="kategori" name="kategori" required>
    @foreach (['Pendapatan', 'Belanja', 'Pembiayaan'] as $k)
      <option value="{{ $k }}" @selected(old('kategori', $apbDesa->kategori ?? 'Pendapatan') == $k)>{{ $k }}</option>
    @endforeach
  </select>
  @error('kategori') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="subkategori">Subkategori / Bidang (opsional)</label><input type="text" id="subkategori" name="subkategori" value="{{ old('subkategori', $apbDesa->subkategori ?? '') }}" placeholder="contoh: Dana Desa, Bidang Pembangunan"></div>
<div class="field"><label for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi" style="min-height:80px">{{ old('deskripsi', $apbDesa->deskripsi ?? '') }}</textarea></div>
<div class="field">
  <label for="anggaran">Anggaran (Rp, angka bulat tanpa titik)</label>
  <input type="number" min="0" id="anggaran" name="anggaran" value="{{ old('anggaran', $apbDesa->anggaran ?? 0) }}" required>
  @error('anggaran') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="realisasi">Realisasi (Rp, isi 0 jika belum ada)</label>
  <input type="number" min="0" id="realisasi" name="realisasi" value="{{ old('realisasi', $apbDesa->realisasi ?? 0) }}" required>
  @error('realisasi') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="keterangan">Keterangan (opsional)</label><textarea id="keterangan" name="keterangan" style="min-height:70px">{{ old('keterangan', $apbDesa->keterangan ?? '') }}</textarea></div>
