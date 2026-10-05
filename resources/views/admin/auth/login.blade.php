{{-- FILE BARU: resources/views/admin/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin - Desa Nggulanggula</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="login-wrap">
  <div class="login-card">
    <div class="crest">NN</div>
    <h2>Login Admin</h2>
    <div class="sub">Dashboard Admin Desa Nggulanggula</div>

    @if (session('status'))
      <div class="alert ok">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert err">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('admin.login.attempt') }}">
      @csrf
      <div class="field">
        <label for="email">Username / Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="field" style="display:flex;align-items:center;gap:8px">
        <input type="checkbox" id="remember" name="remember" style="width:auto" value="1">
        <label for="remember" style="margin:0;font-weight:400">Ingat saya</label>
      </div>
      <button type="submit" class="btn" style="width:100%;justify-content:center">Login</button>
    </form>
  </div>
</div>
</body>
</html>
