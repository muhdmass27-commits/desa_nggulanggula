<div class="field">
  <label for="nama">Nama Kategori</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $kategoriBerita->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>
