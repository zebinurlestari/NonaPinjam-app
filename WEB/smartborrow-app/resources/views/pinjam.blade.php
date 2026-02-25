<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NonaPinjam - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { 
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); 
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .navbar-custom { background: white; padding: 15px; border-bottom: 2px solid #ffafcc; }
        .card-menu { 
            border: none; 
            border-radius: 20px; 
            transition: transform 0.3s; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-menu:hover { transform: translateY(-5px); }
        .btn-action { border-radius: 10px; font-weight: bold; background: #ff9a9e; color: white; border: none; }
        .btn-action:hover { background: #f87d81; color: white; }
        .header-text { color: white; font-weight: bold; text-shadow: 1px 1px 5px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<nav class="navbar navbar-custom mb-5">
    <div class="container">
        <span class="navbar-brand fw-bold" style="color: #ff758c;">✨ NonaPinjam App</span>
        <a href="/logout" class="btn btn-sm btn-danger px-3 rounded-pill" onclick="return confirm('Yakin mau keluar?')">Logout</a>
    </div>
</nav>

<div class="container">
    <h2 class="header-text mb-2">Selamat Datang 👋</h2>
    <p>Halo, {{ Auth::user()->name }}! Silakan kelola peminjaman barang Asrama Putri hari ini.</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-menu p-4">
                <h5 class="fw-bold mb-3">📝 Ajukan Pinjaman</h5>
                <form action="{{ route('pinjam.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small text-muted">Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Barang</label>
                        <input type="text" name="nama_barang" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted">Tanggal</label>
                        <input type="date" name="tanggal_pinjam" class="form-control rounded-3" required>
                    </div>
                    <button type="submit" class="btn btn-action w-100 p-2">Simpan Data</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-menu p-4">
                <h5 class="fw-bold mb-3">📋 Data Peminjaman</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr class="text-muted">
                                <th>Peminjam</th>
                                <th>Barang</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $p)
                            <tr>
                                <td class="fw-bold">{{ $p->nama_peminjam }}</td>
                                <td>{{ $p->nama_barang }}</td>
                                <td><span class="badge rounded-pill bg-success px-3">Dipinjam</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-light text-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $p->id }}">✏️</button>
                                        
                                        <form action="{{ route('pinjam.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="border-radius: 20px;">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title fw-bold">Edit Data Peminjaman</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('pinjam.update', $p->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="small text-muted">Nama Peminjam</label>
                                                    <input type="text" name="nama_peminjam" class="form-control" value="{{ $p->nama_peminjam }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small text-muted">Barang</label>
                                                    <input type="text" name="nama_barang" class="form-control" value="{{ $p->nama_barang }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="submit" class="btn btn-action px-4">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>