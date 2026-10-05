@extends('layouts.admin')
@section('title', 'Pembangunan')
@section('content')
<div class="toolbar">
  <h2>Pembangunan Desa</h2>
  <a class="btn" href="{{ route('admin.transparansi.pembangunan.create') }}">+ Tambah</a>
</div>
<div class="admin-card">
  @if ($pembangunan->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada data.</p>
  @else
    <div class="ox"><table>
      <tr><th>Tahun</th><th>Program</th><th>Anggaran</th><th>Progress</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($pembangunan as $item)
        <tr>
          <td>{{ $item->tahun }}</td><td>{{ $item->nama_program }}</td>
          <td>Rp {{ number_format($item->anggaran, 0, ',', '.') }}</td>
          <td>{{ $item->progress }}%</td>
          <td>@if($item->status==='selesai')<span class="badge pub">Selesai</span>@else<span class="badge draft">{{ ucfirst($item->status) }}</span>@endif</td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.transparansi.pembangunan.edit', $item) }}">Edit</a>
            <form method="POST" action="{{ route('admin.transparansi.pembangunan.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $pembangunan->links() }}</div>
@endsection
