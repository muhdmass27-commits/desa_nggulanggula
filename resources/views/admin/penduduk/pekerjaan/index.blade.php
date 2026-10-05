@extends('layouts.admin')
@section('title', 'Pekerjaan')
@section('content')
<div class="toolbar">
  <h2>Data Pekerjaan</h2>
  <a class="btn" href="{{ route('admin.penduduk.pekerjaan.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($pekerjaan->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Tahun</th><th>Jenis Pekerjaan</th><th>Jumlah</th><th>Aksi</th></tr>
      @foreach ($pekerjaan as $item)
        <tr>
          <td>{{ $item->tahun }}</td><td>{{ $item->jenis_pekerjaan }}</td><td>{{ $item->jumlah }}</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.penduduk.pekerjaan.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.penduduk.pekerjaan.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $pekerjaan->links() }}</div>
@endsection
