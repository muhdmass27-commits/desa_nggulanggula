<div class="field">
  <label for="nama">Nama</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $kepalaDesa->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="jabatan">Jabatan</label>
  <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $kepalaDesa->jabatan ?? 'Kepala Desa') }}">
</div>

<div class="field">
  <label for="periode">Periode Jabatan</label>
  <input type="text" id="periode" name="periode" value="{{ old('periode', $kepalaDesa->periode ?? '') }}" placeholder="contoh: 2024-2030">
</div>

<div class="field">
  <label>Foto (JPG/JPEG/PNG/WEBP, maks 2MB)</label>
  @isset($kepalaDesa)
    @if ($kepalaDesa->foto)
      <img src="{{ asset('storage/'.$kepalaDesa->foto) }}" style="width:70px;height:70px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
  @endisset
  <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/webp">
  @error('foto') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field"><label for="nip">NIP (opsional)</label><input type="text" id="nip" name="nip" value="{{ old('nip', $kepalaDesa->nip ?? '') }}"></div>
<div class="field"><label for="telepon">Telepon</label><input type="text" id="telepon" name="telepon" value="{{ old('telepon', $kepalaDesa->telepon ?? '') }}"></div>
<div class="field"><label for="email">Email</label><input type="email" id="email" name="email" value="{{ old('email', $kepalaDesa->email ?? '') }}"></div>
<div class="field"><label for="deskripsi">Deskripsi Tugas</label><textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $kepalaDesa->deskripsi ?? '') }}</textarea></div>
<div class="field"><label for="sambutan">Teks Sambutan (untuk beranda)</label><textarea id="sambutan" name="sambutan" style="min-height:110px">{{ old('sambutan', $kepalaDesa->sambutan ?? '') }}</textarea></div>

<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="aktif" @selected(old('status', $kepalaDesa->status ?? 'aktif') == 'aktif')>Aktif (Kepala Desa saat ini)</option>
    <option value="nonaktif" @selected(old('status', $kepalaDesa->status ?? '') == 'nonaktif')>Nonaktif (riwayat/sudah berakhir)</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
