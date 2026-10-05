@extends('layouts.admin')
@section('title', 'PPID')
@section('content')
<div class="toolbar">
  <h2>Informasi PPID</h2>
  <a class="btn" href="{{ route('admin.ppid.create') }}">+ Tambah Informasi</a>
</div>
<div class="admin-card">
  @if ($ppid->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Dokumen</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($ppid as $item)
        <tr>
          <td>{{ $item->judul }}</td><td>{{ $item->kategori }}</td><td>{{ $item->tanggal ?: '-' }}</td>
          <td>@if($item->file)<a href="{{ asset('storage/'.$item->file) }}" target="_blank" style="color:var(--primary-dk);font-weight:600">Lihat</a>@else - @endif</td>
          <td>@if($item->status==='published')<span class="badge pub">Published</span>@else<span class="badge draft">Draft</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.ppid.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.ppid.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $ppid->links() }}</div>
@endsection
