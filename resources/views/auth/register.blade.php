<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NonaPinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fce4ec; } /* Pink Pastel Background */
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #f06292; border: none; }
        .btn-primary:hover { background-color: #ec407a; }
        .alert-danger { border-radius: 10px; font-size: 0.85rem; }
    </style>
</head>
<body class="d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-4">
                    <h3 class="text-center mb-4" style="color: #ad1457;">Daftar Akun ✨</h3>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf 
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required placeholder="Min. 8 karakter">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger py-2 mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary w-100 mb-3">Daftar Sekarang</button>
                    </form>
                    
                    <div class="text-center">
                        <small>Sudah punya akun? <a href="{{ route('login') }}" style="color: #f06292; font-weight: bold;">Login di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>