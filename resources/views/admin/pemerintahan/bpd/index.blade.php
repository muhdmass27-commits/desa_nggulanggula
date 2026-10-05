@extends('layouts.admin')
@section('title', 'BPD')
@section('content')
<div class="toolbar">
  <h2>Badan Permusyawaratan Desa (BPD)</h2>
  <a class="btn" href="{{ route('admin.pemerintahan.bpd.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($bpd->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Nama</th><th>Jabatan</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($bpd as $item)
        <tr>
          <td>{{ $item->nama }}</td><td>{{ $item->jabatan }}</td>
          <td>@if($item->status==='aktif')<span class="badge pub">Aktif</span>@else<span class="badge draft">Nonaktif</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.pemerintahan.bpd.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.pemerintahan.bpd.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $bpd->links() }}</div>
@endsection
