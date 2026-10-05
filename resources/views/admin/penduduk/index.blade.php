@extends('layouts.admin')
@section('title', 'Data Penduduk')
@section('content')
<div class="toolbar">
  <h2>Data Penduduk</h2>
  <a class="btn" href="{{ route('admin.penduduk.create') }}">+ Tambah Data Tahun Baru</a>
</div>
<div class="admin-card">
  @if ($dataPenduduk->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Tahun</th><th>Jumlah Penduduk</th><th>KK</th><th>Laki-laki</th><th>Perempuan</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($dataPenduduk as $item)
        <tr>
          <td>{{ $item->tahun }}</td><td>{{ $item->jumlah_penduduk }}</td><td>{{ $item->jumlah_kk }}</td>
          <td>{{ $item->laki_laki }}</td><td>{{ $item->perempuan }}</td>
          <td>@if($item->status==='aktif')<span class="badge pub">Aktif</span>@else<span class="badge draft">Nonaktif</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.penduduk.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.penduduk.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $dataPenduduk->links() }}</div>
@endsection
