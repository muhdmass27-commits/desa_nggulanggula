@extends('layouts.admin')
@section('title', 'Pelayanan')

@section('content')
<div class="toolbar">
  <h2>Daftar Pelayanan</h2>
  <a class="btn" href="{{ route('admin.pelayanan.create') }}">+ Tambah Pelayanan</a>
</div>

<div class="admin-card">
  @if ($pelayanan->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data pelayanan.</p>
  @else
    <div class="ox">
      <table>
        <tr><th>Urutan</th><th>Nama</th><th>Kategori</th><th>Waktu</th><th>Status</th><th>Aksi</th></tr>
        @foreach ($pelayanan as $item)
          <tr>
            <td>{{ $item->urutan }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->kategori ?: '-' }}</td>
            <td>{{ $item->waktu_pelayanan ?: '-' }}</td>
            <td>
              @if ($item->status === 'aktif')
                <span class="badge pub">Aktif</span>
              @else
                <span class="badge draft">Nonaktif</span>
              @endif
            </td>
            <td class="actions-cell">
              <a class="btn sm ghost" href="{{ route('admin.pelayanan.edit', $item) }}">Edit</a>
              <form method="POST" action="{{ route('admin.pelayanan.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
<div class="pagination-wrap">{{ $pelayanan->links() }}</div>
@endsection
