<div class="field">
  <label for="name">Nama</label>
  <input type="text" id="name" name="name" value="{{ old('name', $pengguna->name ?? '') }}" required>
  @error('name') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="email">Email (dipakai untuk login)</label>
  <input type="email" id="email" name="email" value="{{ old('email', $pengguna->email ?? '') }}" required>
  @error('email') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="password">Password{{ isset($pengguna) ? ' (kosongkan jika tidak ingin mengubah)' : '' }}</label>
  <input type="password" id="password" name="password" autocomplete="new-password" {{ isset($pengguna) ? '' : 'required' }}>
  @error('password') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="field">
  <label for="password_confirmation">Ulangi Password</label>
  <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
</div>
<div class="field">
  <label for="status">Status</label>
  @if (isset($pengguna) && $pengguna->id === auth()->id())
    <select id="status" name="status" disabled>
      <option value="aktif" selected>Aktif</option>
    </select>
    <input type="hidden" name="status" value="aktif">
    <div style="font-size:12px;color:var(--ink-soft);margin-top:4px">Anda tidak dapat mengubah status akun Anda sendiri.</div>
  @else
    <select id="status" name="status" required>
      <option value="aktif" @selected(old('status', $pengguna->status ?? 'aktif') == 'aktif')>Aktif</option>
      <option value="nonaktif" @selected(old('status', $pengguna->status ?? '') == 'nonaktif')>Nonaktif</option>
    </select>
  @endif
  @error('status') <div class="err">{{ $message }}</div> @enderror
</div>
