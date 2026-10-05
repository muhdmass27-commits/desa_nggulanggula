{{-- FILE BARU: resources/views/errors/_layout.blade.php
     Layout dasar untuk semua halaman error (404/403/419/500/503).
     Tidak memakai layouts.public karena pada error 500, sebagian data
     (misalnya pengaturan website dari database) bisa jadi penyebab error itu
     sendiri - jadi halaman error dibuat berdiri sendiri, lebih aman. --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('judul', 'Terjadi Kesalahan')</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
.err-wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;text-align:center}
.err-box{max-width:460px}
.err-code{font-family:'Fraunces',serif;font-size:72px;font-weight:700;color:var(--primary);line-height:1}
.err-box h1{font-size:22px;margin:10px 0 8px}
.err-box p{color:var(--ink-soft);font-size:14.5px;margin:0 0 22px}
</style>
</head>
<body>
<div class="err-wrap"><div class="err-box">
  <div class="err-code">@yield('kode', '!')</div>
  <h1>@yield('judul')</h1>
  <p>@yield('pesan')</p>
  <a class="btn" href="{{ url('/') }}">Kembali ke Beranda</a>
</div></div>
</body>
</html>
