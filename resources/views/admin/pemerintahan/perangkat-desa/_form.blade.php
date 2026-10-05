<div class="field">
  <label for="nama">Nama</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $perangkatDesa->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="jabatan">Jabatan</label>
  <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $perangkatDesa->jabatan ?? '') }}" required>
  @error('jabatan') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="bidang">Bidang Tugas (opsional)</label>
  <input type="text" id="bidang" name="bidang" value="{{ old('bidang', $perangkatDesa->bidang ?? '') }}" placeholder="contoh: Keuangan, Pemerintahan, Kesejahteraan">
</div>
<div class="field">
  <label>Foto (JPG/JPEG/PNG/WEBP, maks 2MB)</label>
  @isset($perangkatDesa)
    @if ($perangkatDesa->foto)
      <img src="{{ asset('storage/'.$perangkatDesa->foto) }}" style="width:70px;height:70px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
  @endisset
  <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/webp">
  @error('foto') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="nip">NIP (opsional)</label><input type="text" id="nip" name="nip" value="{{ old('nip', $perangkatDesa->nip ?? '') }}"></div>
<div class="field"><label for="telepon">Telepon</label><input type="text" id="telepon" name="telepon" value="{{ old('telepon', $perangkatDesa->telepon ?? '') }}"></div>
<div class="field"><label for="email">Email</label><input type="email" id="email" name="email" value="{{ old('email', $perangkatDesa->email ?? '') }}"></div>
<div class="field"><label for="deskripsi">Deskripsi Tugas</label><textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $perangkatDesa->deskripsi ?? '') }}</textarea></div>
<div class="field"><label for="urutan">Urutan Tampil</label><input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', $perangkatDesa->urutan ?? 0) }}"></div>
<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="aktif" @selected(old('status', $perangkatDesa->status ?? 'aktif') == 'aktif')>Aktif</option>
    <option value="nonaktif" @selected(old('status', $perangkatDesa->status ?? '') == 'nonaktif')>Nonaktif</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
