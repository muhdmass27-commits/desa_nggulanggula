@extends('layouts.admin')
@section('title', 'Potensi Desa')
@section('content')
<div class="toolbar">
  <h2>Potensi Desa</h2>
  <a class="btn" href="{{ route('admin.informasi-desa.potensi-desa.create') }}">+ Tambah Potensi</a>
</div>
<div class="admin-card">
  @if ($potensiDesa->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Nama</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($potensiDesa as $item)
        <tr>
          <td>{{ $item->nama }}</td><td>{{ $item->kategori->nama ?? '-' }}</td>
          <td>@if($item->status==='published')<span class="badge pub">Published</span>@else<span class="badge draft">Draft</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.informasi-desa.potensi-desa.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.informasi-desa.potensi-desa.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $potensiDesa->links() }}</div>
@endsection
