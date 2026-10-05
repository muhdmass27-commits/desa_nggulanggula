<div class="field">
  <label for="tahun">Tahun</label>
  <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $pendidikan->tahun ?? date('Y')) }}" required>
  @error('tahun') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="jenjang">Jenjang Pendidikan</label>
  <input type="text" id="jenjang" name="jenjang" value="{{ old('jenjang', $pendidikan->jenjang ?? '') }}" required>
  @error('jenjang') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="jumlah">Jumlah</label>
  <input type="number" min="0" id="jumlah" name="jumlah" value="{{ old('jumlah', $pendidikan->jumlah ?? 0) }}" required>
  @error('jumlah') <div class="err">{{ $message }}</div> @enderror
</div>
