@extends('layouts.admin')
@section('title', 'Kepala Desa')
@section('content')
<div class="toolbar">
  <h2>Kepala Desa</h2>
  <a class="btn" href="{{ route('admin.pemerintahan.kepala-desa.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($kepalaDesa->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Nama</th><th>Jabatan</th><th>Periode</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($kepalaDesa as $item)
        <tr>
          <td>{{ $item->nama }}</td><td>{{ $item->jabatan }}</td><td>{{ $item->periode ?: '-' }}</td>
          <td>@if($item->status==='aktif')<span class="badge pub">Aktif</span>@else<span class="badge draft">Nonaktif</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.pemerintahan.kepala-desa.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.pemerintahan.kepala-desa.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $kepalaDesa->links() }}</div>
@endsection
