{{-- FILE BARU: resources/views/admin/pelayanan/_form.blade.php --}}

<div class="field">
  <label for="nama">Nama Pelayanan</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $pelayanan->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="kategori">Kategori (opsional)</label>
  <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $pelayanan->kategori ?? '') }}" placeholder="contoh: Kependudukan, Sosial">
</div>

<div class="field">
  <label for="deskripsi">Deskripsi</label>
  <textarea id="deskripsi" name="deskripsi" style="min-height:70px">{{ old('deskripsi', $pelayanan->deskripsi ?? '') }}</textarea>
</div>

<div class="field">
  <label for="persyaratan">Persyaratan</label>
  <textarea id="persyaratan" name="persyaratan">{{ old('persyaratan', $pelayanan->persyaratan ?? '') }}</textarea>
</div>

<div class="field">
  <label for="prosedur">Prosedur</label>
  <textarea id="prosedur" name="prosedur">{{ old('prosedur', $pelayanan->prosedur ?? '') }}</textarea>
</div>

<div class="field">
  <label for="waktu_pelayanan">Waktu Pelayanan</label>
  <input type="text" id="waktu_pelayanan" name="waktu_pelayanan" value="{{ old('waktu_pelayanan', $pelayanan->waktu_pelayanan ?? '') }}" placeholder="contoh: 1 hari kerja">
</div>

<div class="field">
  <label for="biaya">Biaya</label>
  <input type="text" id="biaya" name="biaya" value="{{ old('biaya', $pelayanan->biaya ?? 'Gratis') }}">
</div>

<div class="field">
  <label for="kontak">Kontak Penanggung Jawab (opsional)</label>
  <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $pelayanan->kontak ?? '') }}">
</div>

<div class="field">
  <label for="urutan">Urutan Tampil</label>
  <input type="number" id="urutan" name="urutan" min="0" value="{{ old('urutan', $pelayanan->urutan ?? 0) }}">
</div>

<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="aktif" @selected(old('status', $pelayanan->status ?? 'aktif') == 'aktif')>Aktif (tampil di halaman publik)</option>
    <option value="nonaktif" @selected(old('status', $pelayanan->status ?? '') == 'nonaktif')>Nonaktif</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
