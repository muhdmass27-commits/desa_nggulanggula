@extends('layouts.admin')
@section('title', 'APB Desa')
@section('content')
<div class="toolbar">
  <h2>APB Desa</h2>
  <a class="btn" href="{{ route('admin.transparansi.apb-desa.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($apbDesa->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Tahun</th><th>Kategori</th><th>Subkategori</th><th>Anggaran</th><th>Realisasi</th><th>Aksi</th></tr>
      @foreach ($apbDesa as $item)
        <tr>
          <td>{{ $item->tahun }}</td><td>{{ $item->kategori }}</td><td>{{ $item->subkategori ?: '-' }}</td>
          <td>Rp {{ number_format($item->anggaran, 0, ',', '.') }}</td>
          <td>Rp {{ number_format($item->realisasi, 0, ',', '.') }}</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.transparansi.apb-desa.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.transparansi.apb-desa.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $apbDesa->links() }}</div>
@endsection
