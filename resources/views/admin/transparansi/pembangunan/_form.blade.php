<div class="field">
  <label for="tahun">Tahun</label>
  <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $pembangunan->tahun ?? date('Y')) }}" required>
  @error('tahun') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="nama_program">Nama Program / Kegiatan</label>
  <input type="text" id="nama_program" name="nama_program" value="{{ old('nama_program', $pembangunan->nama_program ?? '') }}" required>
  @error('nama_program') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="lokasi">Lokasi</label><input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $pembangunan->lokasi ?? '') }}"></div>
<div class="field">
  <label for="anggaran">Anggaran (Rp, angka bulat tanpa titik)</label>
  <input type="number" min="0" id="anggaran" name="anggaran" value="{{ old('anggaran', $pembangunan->anggaran ?? 0) }}" required>
  @error('anggaran') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="sumber_dana">Sumber Dana</label><input type="text" id="sumber_dana" name="sumber_dana" value="{{ old('sumber_dana', $pembangunan->sumber_dana ?? '') }}" placeholder="contoh: Dana Desa, ADD"></div>
<div class="field">
  <label for="progress">Progress (0-100 %)</label>
  <input type="number" min="0" max="100" id="progress" name="progress" value="{{ old('progress', $pembangunan->progress ?? 0) }}" required>
  @error('progress') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    @foreach (['direncanakan' => 'Direncanakan', 'berjalan' => 'Berjalan', 'selesai' => 'Selesai'] as $val => $lbl)
      <option value="{{ $val }}" @selected(old('status', $pembangunan->status ?? 'berjalan') == $val)>{{ $lbl }}</option>
    @endforeach
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label>Foto (JPG/JPEG/PNG/WEBP, maks 2MB)</label>
  @isset($pembangunan)
    @if ($pembangunan->foto)
      <img src="{{ asset('storage/'.$pembangunan->foto) }}" alt="" style="width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px">
    @endif
  @endisset
  <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/webp">
  @error('foto') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $pembangunan->deskripsi ?? '') }}</textarea></div>
