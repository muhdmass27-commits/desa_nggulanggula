@extends('layouts.admin')
@section('title', 'Galeri')
@section('content')
<div class="toolbar">
  <h2>Galeri Foto</h2>
  <a class="btn" href="{{ route('admin.media.galeri.create', $albumId ? ['album' => $albumId] : []) }}">+ Upload Foto</a>
</div>

<form method="GET" action="{{ route('admin.media.galeri.index') }}" style="margin-bottom:14px;display:flex;gap:8px;flex-wrap:wrap">
  <select name="album" onchange="this.form.submit()" style="padding:8px 10px;border:1px solid var(--line);border-radius:8px;background:var(--paper);color:var(--ink)">
    <option value="">Semua album</option>
    @foreach ($albums as $a)
      <option value="{{ $a->id }}" @selected($albumId == $a->id)>{{ $a->nama }}</option>
    @endforeach
  </select>
</form>

@if ($galeri->isEmpty())
  <div class="admin-card"><p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada foto.</p></div>
@else
  <div class="grid g4">
    @foreach ($galeri as $item)
      <div class="card">
        <img src="{{ asset('storage/'.$item->file) }}" alt="{{ $item->judul }}" style="width:100%;height:130px;object-fit:cover">
        <div class="body">
          <b style="font-size:13.5px">{{ $item->judul ?: 'Tanpa judul' }}</b>
          <span class="meta" style="font-size:11.5px;color:var(--ink-soft)">{{ $item->album->nama ?? 'Tanpa album' }}</span>
          <div class="actions-cell" style="margin-top:6px">
            <a class="btn sm ghost" href="{{ route('admin.media.galeri.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.media.galeri.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif
<div class="pagination-wrap">{{ $galeri->links() }}</div>
@endsection
