<div class="field">
  <label for="tahun">Tahun</label>
  <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $pekerjaan->tahun ?? date('Y')) }}" required>
  @error('tahun') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
  <input type="text" id="jenis_pekerjaan" name="jenis_pekerjaan" value="{{ old('jenis_pekerjaan', $pekerjaan->jenis_pekerjaan ?? '') }}" required>
  @error('jenis_pekerjaan') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="jumlah">Jumlah</label>
  <input type="number" min="0" id="jumlah" name="jumlah" value="{{ old('jumlah', $pekerjaan->jumlah ?? 0) }}" required>
  @error('jumlah') <div class="err">{{ $message }}</div> @enderror
</div>
