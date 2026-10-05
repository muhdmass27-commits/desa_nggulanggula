<div class="field">
  <label for="album_id">Album</label>
  <select id="album_id" name="album_id">
    <option value="">-- Tanpa album --</option>
    @foreach ($albums as $a)
      <option value="{{ $a->id }}" @selected(old('album_id', $galeri->album_id ?? request('album')) == $a->id)>{{ $a->nama }}</option>
    @endforeach
  </select>
  @error('album_id') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="judul">Judul Foto (opsional)</label><input type="text" id="judul" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}"></div>
<div class="field">
  <label>Foto (JPG/JPEG/PNG/WEBP, maks 2MB){{ isset($galeri) ? '' : ' - wajib' }}</label>
  @isset($galeri)
    <img src="{{ asset('storage/'.$galeri->file) }}" alt="" style="width:100px;height:100px;object-fit:cover;border-radius:8px;border:1px solid var(--line);margin-bottom:6px;display:block">
  @endisset
  <input type="file" name="file" accept="image/jpeg,image/jpg,image/png,image/webp" {{ isset($galeri) ? '' : 'required' }}>
  @error('file') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field"><label for="deskripsi">Deskripsi (opsional)</label><textarea id="deskripsi" name="deskripsi" style="min-height:70px">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea></div>
