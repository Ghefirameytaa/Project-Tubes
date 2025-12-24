<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Paket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .app {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 200px;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #eee;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar .logo img {
            width: 140px;
            display: block;
            margin: 0 auto 30px;
        }
        .menu-title {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
        }
        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #333;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .menu a:hover {
            background: #f0f4f0;
        }
        .menu a.active {
            background: #2C5F2D;
            color: #fff;
        }
        .menu-bottom {
            margin-top: 10px;
            border-top: 1px solid #eee;
            padding-top: 15px;
            display: flex;
            flex-direction: column;
        }
        .menu-bottom a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            height: 64px;
            background: #2C5F2D;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            margin-bottom: 24px;
        }
        .search-box {
            background: #fff;
            padding: 8px 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 350px;
            font-size: 14px;
            margin-left: 20px;
        }
        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }
        .topbar-right img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border-radius: 50px;
        }
        .user-info {
            line-height: 1.2;
        }
        .user-info span {
            font-size: 12px;
            opacity: 0.9;
        }
        .content {
            flex: 1;
            padding: 30px;
        }

        .card-form {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            max-width: 900px;
        }

        .preview-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #eee;
            background: #fafafa;
        }

        .btn-green {
            background-color: #2C5F2D;
            color: #fff;
            border: none;
        }
        .btn-green:hover {
            background-color: #234b24;
            color: #fff;
        }
    </style>
</head>

<body>
<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('aset/logo.png') }}" alt="Logo Bhumi Bambu">
        </div>

        <div class="menu-title">Halaman Utama</div>
        <div class="menu">
            <a href="#"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="#"><i class="fa-solid fa-list"></i> List Pesanan</a>
            <a href="#"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
            <a href="{{ url('/paket-layanan') }}" class="active"><i class="fa-solid fa-box"></i> Paket</a>
            <a href="#"><i class="bi bi-tag"></i> Promo</a>
        </div>

        <div class="menu-bottom">
            <a href="#"><i class="fa-solid fa-gear"></i> Pengaturan</a>
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div class="topbar-left">
                <div class="search-box">
                    🔍
                    <input type="text" placeholder="Cari">
                </div>
            </div>

            <div class="topbar-right">
                <img src="{{ asset('aset/ghefiraa.jpg') }}" alt="Foto Admin">
                <div class="user-info">
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                    <span>Admin</span>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content pt-0">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Edit Paket</h4>
                <a href="{{ route('paket-layanan.index') }}" class="btn btn-light">← Kembali</a>
            </div>

            <div class="card-form">
                <form action="{{ route('paket-layanan.update', $paketLayanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Paket</label>
                            <input type="text"
                                   name="nama_paket"
                                   class="form-control"
                                   value="{{ old('nama_paket', $paketLayanan->nama_paket) }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Venue</label>
                            <input type="text"
                                   name="venue"
                                   class="form-control"
                                   value="{{ old('venue', $paketLayanan->venue) }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="text"
                                   name="harga"
                                   class="form-control"
                                   value="{{ old('harga', $paketLayanan->harga) }}"
                                   required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kapasitas</label>
                            <input type="number"
                                   name="kapasitas"
                                   class="form-control"
                                   value="{{ old('kapasitas', $paketLayanan->kapasitas) }}"
                                   required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Fasilitas</label>
                            <input type="text"
                                   name="fasilitas"
                                   class="form-control"
                                   value="{{ old('fasilitas', $paketLayanan->fasilitas) }}"
                                   required>
                            <small class="text-muted">Tip: pisahkan dengan koma, atau isi pakai enter (nanti tampil multiline).</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">
                                {{ old('deskripsi', $paketLayanan->deskripsi) }}
                            </textarea>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Gambar Venue (opsional)</label>
                            <input type="file" name="gambar_venue" class="form-control" accept="image/*">
                            <small class="text-muted">Kalau tidak upload, gambar lama tetap dipakai.</small>
                        </div>

                        <div class="col-12 d-flex align-items-center gap-3 mt-2">
                            <div>
                                <div class="mb-1 text-muted">Gambar Saat Ini:</div>
                                @if(!empty($paketLayanan->gambar_venue))
                                    <img class="preview-img" src="{{ asset($paketLayanan->gambar_venue) }}" alt="Preview">
                                @else
                                    <div class="text-muted">Belum ada gambar</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-green px-4">Update</button>
                        <a href="{{ route('paket-layanan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
