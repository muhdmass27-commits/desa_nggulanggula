@extends('layouts.admin')
@section('title', 'Kategori Berita')
@section('content')
<div class="toolbar">
  <h2>Kategori Berita</h2>
  <a class="btn" href="{{ route('admin.informasi-desa.kategori-berita.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  <div class="ox"><table>
    <tr><th>Nama</th><th>Jumlah Berita</th><th>Aksi</th></tr>
    @foreach ($kategoriBerita as $item)
      <tr>
        <td>{{ $item->nama }}</td><td>{{ $item->berita_count }}</td>
        <td class="actions-cell">
          <a class="btn sm ghost" href="{{ route('admin.informasi-desa.kategori-berita.edit', $item) }}">Edit</a>
          <form method="POST" action="{{ route('admin.informasi-desa.kategori-berita.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
            @csrf @method('DELETE')
            <button type="submit" class="btn sm danger">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table></div>
</div>
<div class="pagination-wrap">{{ $kategoriBerita->links() }}</div>
@endsection
