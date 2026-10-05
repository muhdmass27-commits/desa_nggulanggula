@extends('layouts.admin')
@section('title', 'Berita')

@section('content')
<div class="toolbar">
  <h2>Berita</h2>
  <a class="btn" href="{{ route('admin.berita.create') }}">+ Tambah Berita</a>
</div>

<div class="admin-card">
  @if ($berita->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada berita. Klik &laquo;+ Tambah Berita&raquo; untuk membuat data baru.</p>
  @else
    <div class="ox">
      <table>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Kategori</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
        @foreach ($berita as $item)
          <tr>
            <td>{{ $loop->iteration + ($berita->currentPage() - 1) * $berita->perPage() }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->kategori->nama ?? '-' }}</td>
            <td>
              @if ($item->status === 'published')
                <span class="badge pub">Published</span>
              @else
                <span class="badge draft">Draft</span>
              @endif
            </td>
            <td class="actions-cell">
              <a class="btn sm ghost" href="{{ route('admin.berita.edit', $item) }}">Edit</a>
              <form method="POST" action="{{ route('admin.berita.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn sm danger">Hapus</button>
              </form>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif
</div>

<div class="pagination-wrap">{{ $berita->links() }}</div>
@endsection
