<div class="field">
  <label for="tahun">Tahun</label>
  <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $kelompokUmur->tahun ?? date('Y')) }}" required>
  @error('tahun') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="rentang_usia">Rentang Usia</label>
  <input type="text" id="rentang_usia" name="rentang_usia" value="{{ old('rentang_usia', $kelompokUmur->rentang_usia ?? '') }}" required>
  @error('rentang_usia') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="jumlah">Jumlah</label>
  <input type="number" min="0" id="jumlah" name="jumlah" value="{{ old('jumlah', $kelompokUmur->jumlah ?? 0) }}" required>
  @error('jumlah') <div class="err">{{ $message }}</div> @enderror
</div>
