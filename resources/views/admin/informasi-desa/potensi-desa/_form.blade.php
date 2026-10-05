<div class="field">
  <label for="nama">Nama Potensi</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $potensiDesa->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="kategori_id">Kategori</label>
  <select id="kategori_id" name="kategori_id">
    <option value="">-- Pilih kategori (opsional) --</option>
    @foreach ($kategori as $k)
      <option value="{{ $k->id }}" @selected(old('kategori_id', $potensiDesa->kategori_id ?? '') == $k->id)>{{ $k->nama }}</option>
    @endforeach
  </select>
</div>
<div class="field">
  <label>Foto (JPG/JPEG/PNG/WEBP, maks 2MB)</label>
  @isset($potensiDesa)
    @if ($potensiDesa->foto)
      <img src="{{ asset('storage/'.$potensiDesa->foto) }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
  @endisset
  <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/webp">
  @error('foto') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $potensiDesa->deskripsi ?? '') }}</textarea></div>
<div class="field"><label for="lokasi">Lokasi</label><input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $potensiDesa->lokasi ?? '') }}"></div>
<div class="field"><label for="pengelola">Pengelola (opsional)</label><input type="text" id="pengelola" name="pengelola" value="{{ old('pengelola', $potensiDesa->pengelola ?? '') }}"></div>
<div class="field"><label for="kontak">Kontak (opsional)</label><input type="text" id="kontak" name="kontak" value="{{ old('kontak', $potensiDesa->kontak ?? '') }}"></div>
<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="draft" @selected(old('status', $potensiDesa->status ?? 'draft') == 'draft')>Draft (hanya Admin yang bisa lihat)</option>
    <option value="published" @selected(old('status', $potensiDesa->status ?? '') == 'published')>Published (tampil di halaman publik)</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
