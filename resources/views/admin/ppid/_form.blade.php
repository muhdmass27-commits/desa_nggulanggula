<div class="field">
  <label for="judul">Judul</label>
  <input type="text" id="judul" name="judul" value="{{ old('judul', $ppid->judul ?? '') }}" required>
  @error('judul') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="kategori">Kategori</label>
  <select id="kategori" name="kategori" required>
    @foreach (['Informasi Berkala', 'Informasi Setiap Saat', 'Informasi Serta Merta', 'Dasar Hukum'] as $k)
      <option value="{{ $k }}" @selected(old('kategori', $ppid->kategori ?? 'Informasi Berkala') == $k)>{{ $k }}</option>
    @endforeach
  </select>
  @error('kategori') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="deskripsi">Deskripsi</label><textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $ppid->deskripsi ?? '') }}</textarea></div>
<div class="field">
  <label>Dokumen (PDF/DOC/DOCX/XLS/XLSX, maks 5MB, opsional)</label>
  @isset($ppid)
    @if ($ppid->file)
      <div style="margin-bottom:6px;font-size:13px"><a href="{{ asset('storage/'.$ppid->file) }}" target="_blank" style="color:var(--primary-dk);font-weight:600">Lihat dokumen saat ini</a> (unggah file baru untuk mengganti)</div>
    @endif
  @endisset
  <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx">
  @error('file') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="tanggal">Tanggal</label>
  <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $ppid->tanggal ?? date('Y-m-d')) }}">
  @error('tanggal') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="draft" @selected(old('status', $ppid->status ?? 'published') == 'draft')>Draft (hanya Admin yang bisa lihat)</option>
    <option value="published" @selected(old('status', $ppid->status ?? 'published') == 'published')>Published (tampil di halaman publik)</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
