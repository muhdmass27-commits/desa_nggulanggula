@extends('layouts.admin')
@section('title', 'Album Galeri')
@section('content')
<div class="toolbar">
  <h2>Album Galeri</h2>
  <a class="btn" href="{{ route('admin.media.album-galeri.create') }}">+ Tambah Album</a>
</div>
<div class="admin-card">
  @if ($albumGaleri->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada album.</p>
  @else
    <div class="ox"><table>
      <tr><th>Nama Album</th><th>Tanggal</th><th>Jumlah Foto</th><th>Aksi</th></tr>
      @foreach ($albumGaleri as $item)
        <tr>
          <td>{{ $item->nama }}</td><td>{{ $item->tanggal ?: '-' }}</td>
          <td><a href="{{ route('admin.media.galeri.index', ['album' => $item->id]) }}" style="color:var(--primary-dk);font-weight:600">{{ $item->galeri_count }} foto</a></td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.media.album-galeri.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.media.album-galeri.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $albumGaleri->links() }}</div>
@endsection
