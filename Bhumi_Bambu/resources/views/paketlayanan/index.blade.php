<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Paket</title>

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
            margin-bottom: 30px; }
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
        .paket-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 24px; 
        }
        .btn-tambah { 
            background-color: #2C5F2D; 
            color: #fff; 
            padding: 8px 20px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-size: 14px; 
            border: none; 
        }
        .paket-card { 
            background: #fff; 
            border-radius: 16px; 
            padding: 20px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.06); 
        }
        table th { 
            background: #f3f6f8; 
            font-weight: 600; 
        }
        .nama-paket { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
        }
        .nama-paket img { 
            width: 48px; 
            height: 48px; 
            border-radius: 50%; 
            object-fit: cover; 
        }
        .aksi a, .aksi button { 
            border: none; 
            background: none; 
            font-size: 18px; 
            margin: 0 5px; 
            cursor: pointer; 
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
                    <a href="#"><i class="fa-solid fa-search bar"></i></a>
                    <input type="text" placeholder="Cari">
                </div>
            </div>

            <div class="topbar-right">
                <img src="{{ asset('aset/ghefiraa.jpg') }}" alt="Foto Admin">
                <div class="user-info">
                    <strong>{{ auth()->user()->name ?? 'Ghefira' }}</strong>
                    <span>Admin</span>
                </div>
            </div>
        </div>

        <!-- ALERT -->
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

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- CONTENT -->
            <div class="paket-header">
                <h4>Detail Paket</h4>
                <button type="button" class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalTambahPaket">
                    + Tambah
                </button>
            </div>

            <div class="paket-card">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th>Venue</th>
                            <th>Harga</th>
                            <th>Fasilitas</th>
                            <th>Kapasitas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td>
                                <div class="nama-paket">
                                    @if($item->gambar_venue)
                                        <img src="{{ asset($item->gambar_venue) }}" width="80">

                                    @else
                                        <img src="{{ asset($item->gambar_venue) }}" width="80">
                                    @endif
                                    <strong>{{ $item->nama_paket }}</strong>
                                </div>
                            </td>

                            <td>{{ $item->venue }}</td>
                            <td>{{ $item->harga }}</td>
                            <td style="white-space: pre-line;">{{ $item->fasilitas }}</td>
                            <td>{{ $item->kapasitas }} Orang</td>

                            <td class="aksi text-center">
                                <a href="{{ route('paket-layanan.edit', $item->id) }}" title="Edit">✏️</a>

                                <form action="{{ route('paket-layanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data ini?')" title="Hapus">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data paket.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahPaket" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius:16px;">

      <div class="modal-header" style="border-bottom:0;">
        <h5 class="modal-title">Tambah Paket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('paket-layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Nama Paket</label>
              <input type="text" name="nama_paket" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Venue</label>
              <input type="text" name="venue" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Harga</label>
              <input type="text" name="harga" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Kapasitas</label>
              <input type="number" name="kapasitas" class="form-control" placeholder="contoh: 30" required>
            </div>

            <div class="col-12">
              <label class="form-label">Fasilitas</label>
              <input type="text" name="fasilitas" class="form-control" required>
              <small class="text-muted">Tip: pisahkan dengan koma, atau isi pakai enter (nanti tampil multiline).</small>
            </div>

            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"
                placeholder="Deskripsi paket (opsional)"></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Gambar Venue</label>
              <input type="file" name="gambar_venue" class="form-control" accept="image/*">
            </div>

          </div>
        </div>

        <div class="modal-footer" style="border-top:0;">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success px-4">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>