@extends('layouts.admin')
@section('title', 'Perangkat Desa')
@section('content')
<div class="toolbar">
  <h2>Perangkat Desa</h2>
  <a class="btn" href="{{ route('admin.pemerintahan.perangkat-desa.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($perangkatDesa->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Nama</th><th>Jabatan</th><th>Bidang</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($perangkatDesa as $item)
        <tr>
          <td>{{ $item->nama }}</td><td>{{ $item->jabatan }}</td><td>{{ $item->bidang ?: '-' }}</td>
          <td>@if($item->status==='aktif')<span class="badge pub">Aktif</span>@else<span class="badge draft">Nonaktif</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.pemerintahan.perangkat-desa.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.pemerintahan.perangkat-desa.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $perangkatDesa->links() }}</div>
@endsection
