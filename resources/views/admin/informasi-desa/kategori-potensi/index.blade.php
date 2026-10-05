@extends('layouts.admin')
@section('title', 'Kategori Potensi')
@section('content')
<div class="toolbar">
  <h2>Kategori Potensi Desa</h2>
  <a class="btn" href="{{ route('admin.informasi-desa.kategori-potensi.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  <div class="ox"><table>
    <tr><th>Nama</th><th>Jumlah Potensi</th><th>Aksi</th></tr>
    @foreach ($kategoriPotensi as $item)
      <tr>
        <td>{{ $item->nama }}</td><td>{{ $item->potensi_count }}</td>
        <td class="actions-cell">
          <a class="btn sm ghost" href="{{ route('admin.informasi-desa.kategori-potensi.edit', $item) }}">Edit</a>
          <form method="POST" action="{{ route('admin.informasi-desa.kategori-potensi.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
            @csrf @method('DELETE')
            <button type="submit" class="btn sm danger">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table></div>
</div>
<div class="pagination-wrap">{{ $kategoriPotensi->links() }}</div>
@endsection
