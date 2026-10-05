{{-- FILE BARU: resources/views/admin/berita/_form.blade.php
     Partial ini dipakai bersama oleh create.blade.php dan edit.blade.php --}}

<div class="field">
  <label for="judul">Judul Berita</label>
  <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" required>
  @error('judul') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="kategori_id">Kategori</label>
  <select id="kategori_id" name="kategori_id">
    <option value="">-- Pilih kategori (opsional) --</option>
    @foreach ($kategori as $k)
      <option value="{{ $k->id }}" @selected(old('kategori_id', $berita->kategori_id ?? '') == $k->id)>{{ $k->nama }}</option>
    @endforeach
  </select>
  @error('kategori_id') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="ringkasan">Ringkasan (opsional, tampil di daftar berita)</label>
  <textarea id="ringkasan" name="ringkasan" style="min-height:70px">{{ old('ringkasan', $berita->ringkasan ?? '') }}</textarea>
  @error('ringkasan') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="isi">Isi Berita</label>
  <textarea id="isi" name="isi" required>{{ old('isi', $berita->isi ?? '') }}</textarea>
  @error('isi') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="gambar">Foto Berita (JPG/JPEG/PNG/WEBP, maks 2MB)</label>
  @isset($berita)
    @if ($berita->gambar)
      <div style="margin-bottom:8px">
        <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Foto saat ini" style="width:90px;height:90px;object-fit:cover;border-radius:8px;border:1px solid var(--line)">
        <div style="font-size:11.5px;color:var(--ink-soft)">Foto saat ini. Unggah file baru untuk menggantinya.</div>
      </div>
    @endif
  @endisset
  <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/jpg,image/png,image/webp">
  @error('gambar') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="tanggal_publish">Tanggal Publikasi</label>
  <input type="date" id="tanggal_publish" name="tanggal_publish" value="{{ old('tanggal_publish', isset($berita->tanggal_publish) ? $berita->tanggal_publish->format('Y-m-d') : now()->format('Y-m-d')) }}">
  @error('tanggal_publish') <div class="err">{{ $message }}</div> @enderror
</div>

<div class="field">
  <label for="status">Status</label>
  <select id="status" name="status" required>
    <option value="draft" @selected(old('status', $berita->status ?? 'draft') == 'draft')>Draft (hanya Admin yang bisa lihat)</option>
    <option value="published" @selected(old('status', $berita->status ?? '') == 'published')>Published (tampil di halaman publik)</option>
  </select>
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
