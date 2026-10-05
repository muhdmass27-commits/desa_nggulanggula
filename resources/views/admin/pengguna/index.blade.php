@extends('layouts.admin')
@section('title', 'Pengguna Admin')
@section('content')
<div class="toolbar">
  <h2>Pengguna Admin</h2>
  <a class="btn" href="{{ route('admin.pengguna.create') }}">+ Tambah Admin</a>
</div>
<div class="admin-card">
  <div class="ox"><table>
    <tr><th>Nama</th><th>Email</th><th>Status</th><th>Aksi</th></tr>
    @foreach ($pengguna as $item)
      <tr>
        <td>{{ $item->name }} @if ($item->id === auth()->id())<span class="badge pub">Anda</span>@endif</td>
        <td>{{ $item->email }}</td>
        <td>@if($item->status==='aktif')<span class="badge pub">Aktif</span>@else<span class="badge draft">Nonaktif</span>@endif</td>
        <td class="actions-cell">
          <a class="btn sm ghost" href="{{ route('admin.pengguna.edit', $item) }}">Edit</a>
          @if ($item->id !== auth()->id())
            <form method="POST" action="{{ route('admin.pengguna.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          @endif
        </td>
      </tr>
    @endforeach
  </table></div>
</div>
<div class="pagination-wrap">{{ $pengguna->links() }}</div>
@endsection
