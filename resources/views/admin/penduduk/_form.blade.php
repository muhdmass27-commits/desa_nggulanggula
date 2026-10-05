<div class="field">
  <label for="tahun">Tahun</label>
  <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $dataPenduduk->tahun ?? date('Y')) }}" required>
  @error('tahun') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="jumlah_penduduk">Jumlah Penduduk</label><input type="number" min="0" id="jumlah_penduduk" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $dataPenduduk->jumlah_penduduk ?? 0) }}" required>
  @error('jumlah_penduduk') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="jumlah_kk">Jumlah KK</label><input type="number" min="0" id="jumlah_kk" name="jumlah_kk" value="{{ old('jumlah_kk', $dataPenduduk->jumlah_kk ?? 0) }}" required></div>
<div class="field"><label for="laki_laki">Laki-laki</label><input type="number" min="0" id="laki_laki" name="laki_laki" value="{{ old('laki_laki', $dataPenduduk->laki_laki ?? 0) }}" required></div>
<div class="field"><label for="perempuan">Perempuan</label><input type="number" min="0" id="perempuan" name="perempuan" value="{{ old('perempuan', $dataPenduduk->perempuan ?? 0) }}" required></div>
<div class="field"><label for="jumlah_dusun">Jumlah Dusun</label><input type="number" min="0" id="jumlah_dusun" name="jumlah_dusun" value="{{ old('jumlah_dusun', $dataPenduduk->jumlah_dusun ?? 0) }}" required></div>
<div class="field"><label for="jumlah_rt">Jumlah RT</label><input type="number" min="0" id="jumlah_rt" name="jumlah_rt" value="{{ old('jumlah_rt', $dataPenduduk->jumlah_rt ?? 0) }}" required></div>
<div class="field"><label for="jumlah_rw">Jumlah RW</label><input type="number" min="0" id="jumlah_rw" name="jumlah_rw" value="{{ old('jumlah_rw', $dataPenduduk->jumlah_rw ?? 0) }}" required></div>
<div class="field"><label for="keterangan">Keterangan (opsional)</label><textarea id="keterangan" name="keterangan">{{ old('keterangan', $dataPenduduk->keterangan ?? '') }}</textarea></div>
<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="aktif" @selected(old('status', $dataPenduduk->status ?? 'aktif') == 'aktif')>Aktif (tahun yang sedang ditampilkan)</option>
    <option value="nonaktif" @selected(old('status', $dataPenduduk->status ?? '') == 'nonaktif')>Nonaktif (data historis)</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
