<div class="field">
  <label for="nama">Nama Album</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $albumGaleri->nama ?? '') }}" required>
  @error('nama') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi" style="min-height:80px">{{ old('deskripsi', $albumGaleri->deskripsi ?? '') }}</textarea></div>
<div class="field">
  <label for="tanggal">Tanggal Kegiatan</label>
  <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $albumGaleri->tanggal ?? '') }}">
  @error('tanggal') <div class="err">{{ $message }}</div> @enderror
</div>
