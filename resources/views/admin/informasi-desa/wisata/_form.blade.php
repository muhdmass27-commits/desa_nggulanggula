<div class="field">
  <label for="nama">Nama Wisata</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $wisata->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label>Foto (JPG/JPEG/PNG/WEBP, maks 2MB)</label>
  @isset($wisata)
    @if ($wisata->foto)
      <img src="{{ asset('storage/'.$wisata->foto) }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
  @endisset
  <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/webp">
  @error('foto') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $wisata->deskripsi ?? '') }}</textarea></div>
<div class="field"><label for="lokasi">Lokasi</label><input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $wisata->lokasi ?? '') }}"></div>
<div class="field"><label for="latitude">Latitude (opsional)</label><input type="text" id="latitude" name="latitude" value="{{ old('latitude', $wisata->latitude ?? '') }}"></div>
<div class="field"><label for="longitude">Longitude (opsional)</label><input type="text" id="longitude" name="longitude" value="{{ old('longitude', $wisata->longitude ?? '') }}"></div>
<div class="field"><label for="fasilitas">Fasilitas</label><input type="text" id="fasilitas" name="fasilitas" value="{{ old('fasilitas', $wisata->fasilitas ?? '') }}"></div>
<div class="field"><label for="jam_buka">Jam Buka (format 08:00)</label><input type="text" id="jam_buka" name="jam_buka" value="{{ old('jam_buka', $wisata->jam_buka ?? '') }}" placeholder="08:00"></div>
<div class="field"><label for="jam_tutup">Jam Tutup (format 17:00)</label><input type="text" id="jam_tutup" name="jam_tutup" value="{{ old('jam_tutup', $wisata->jam_tutup ?? '') }}" placeholder="17:00"></div>
<div class="field"><label for="kontak_pengelola">Kontak Pengelola</label><input type="text" id="kontak_pengelola" name="kontak_pengelola" value="{{ old('kontak_pengelola', $wisata->kontak_pengelola ?? '') }}"></div>
<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="draft" @selected(old('status', $wisata->status ?? 'draft') == 'draft')>Draft (hanya Admin yang bisa lihat)</option>
    <option value="published" @selected(old('status', $wisata->status ?? '') == 'published')>Published (tampil di halaman publik)</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
