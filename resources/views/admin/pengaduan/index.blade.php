@extends('layouts.admin')
@section('title', 'Pengaduan')
@section('content')
<div class="toolbar">
  <h2>Pengaduan Masyarakat</h2>
</div>

<div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px">
  <a class="btn sm {{ $filter ? 'ghost' : '' }}" href="{{ route('admin.pengaduan.index') }}">Semua ({{ $hitung->sum() }})</a>
  @foreach (['menunggu' => 'Menunggu', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'] as $val => $lbl)
    <a class="btn sm {{ $filter === $val ? '' : 'ghost' }}" href="{{ route('admin.pengaduan.index', ['status' => $val]) }}">{{ $lbl }} ({{ $hitung[$val] ?? 0 }})</a>
  @endforeach
</div>

<div class="admin-card">
  @if ($pengaduan->isEmpty())
    <p style="color:var(--ink-soft);font-size:13.5px;margin:0">Belum ada pengaduan{{ $filter ? ' dengan status ini' : '' }}.</p>
  @else
    <div class="ox"><table>
      <tr><th>No. Pengaduan</th><th>Tanggal</th><th>Pengirim</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
      @foreach ($pengaduan as $item)
        <tr>
          <td>{{ $item->nomor_pengaduan }}</td>
          <td>{{ $item->created_at->format('d-m-Y') }}</td>
          <td>{{ $item->nama }}</td>
          <td>{{ $item->kategori }}</td>
          <td>
            @if ($item->status === 'selesai')<span class="badge pub">Selesai</span>
            @elseif ($item->status === 'ditolak')<span class="badge" style="background:var(--danger-lt);color:var(--danger)">Ditolak</span>
            @else<span class="badge draft">{{ ucfirst($item->status) }}</span>@endif
          </td>
          <td class="actions-cell">
            <a class="btn sm ghost" href="{{ route('admin.pengaduan.show', $item) }}">Detail</a>
            <form method="POST" action="{{ route('admin.pengaduan.destroy', $item) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn sm danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table></div>
  @endif
</div>
<div class="pagination-wrap">{{ $pengaduan->links() }}</div>
@endsection
