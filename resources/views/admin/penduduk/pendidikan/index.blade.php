@extends('layouts.admin')
@section('title', 'Pendidikan')
@section('content')
<div class="toolbar">
  <h2>Data Pendidikan</h2>
  <a class="btn" href="{{ route('admin.penduduk.pendidikan.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($pendidikan->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Tahun</th><th>Jenjang</th><th>Jumlah</th><th>Aksi</th></tr>
      @foreach ($pendidikan as $item)
        <tr>
          <td>{{ $item->tahun }}</td><td>{{ $item->jenjang }}</td><td>{{ $item->jumlah }}</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.penduduk.pendidikan.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.penduduk.pendidikan.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $pendidikan->links() }}</div>
@endsection
