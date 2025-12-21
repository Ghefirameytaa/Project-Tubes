<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 240px;
            background: #ffffff;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }

        .logo {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 30px;
            color: #2f6f3e;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            text-decoration: none;
            color: #333;
            border-radius: 10px;
            font-size: 14px;
        }

        .menu a i {
            margin-right: 12px;
            width: 20px;
        }

        .menu a.active,
        .menu a:hover {
            background: #2f6f3e;
            color: #fff;
        }

        /* ================= MAIN ================= */
        .main {
            margin-left: 240px;
            min-height: 100vh;
        }

        /* ================= NAVBAR ================= */
        .topbar {
            height: 70px;
            background: #2f6f3e;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-box {
            background: #fff;
            border-radius: 25px;
            padding: 8px 15px;
            width: 350px;
            display: flex;
            align-items: center;
        }

        .search-box i {
            color: #aaa;
            margin-right: 10px;
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
            color: #fff;
        }

        .topbar-right i {
            margin-right: 25px;
            font-size: 18px;
            cursor: pointer;
        }

        .profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile-text {
            margin-right: 8px;
            line-height: 1.2;
        }

        .profile-text .name {
            font-size: 14px;
            font-weight: 500;
        }

        .profile-text .role {
            font-size: 12px;
            opacity: 0.8;
        }

        /* ================= CONTENT ================= */
        .content {
            padding: 30px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .content-header h2 {
            font-size: 22px;
            font-weight: 600;
        }

        /* ================= ALERT ================= */
        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ================= FILTERS ================= */
        .filters {
            background: #fff;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-select {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .btn-add {
            background: #4f7f5f;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-add:hover {
            background: #3d6348;
        }

        /* ================= TABLE ================= */
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f1f4f8;
        }

        th, td {
            padding: 14px;
            text-align: left;
            font-size: 14px;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        /* ================= STATUS ================= */
        .status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            display: inline-block;
        }

        .success {
            background: #17b890;
        }

        .pending {
            background: #f4b400;
        }

        .cancel {
            background: #ff5c5c;
        }

        /* ================= ACTION ================= */
        .action {
            display: flex;
            gap: 10px;
        }

        .btn-detail {
            color: #2563eb;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            border: 1px solid #2563eb;
        }

        .btn-detail:hover {
            background: #2563eb;
            color: white;
        }

        .btn-edit {
            color: #f4b400;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-delete {
            color: #ff5c5c;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 40px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            color: #ddd;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
    <div class="logo">Bhumi Bambu</div>

    <div class="menu">
        <a href="#"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="#"><i class="fa-solid fa-list"></i> List Pesanan</a>
        <a href="/pembayaran" class="active"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
        <a href="#"><i class="fa-solid fa-box"></i> Paket</a>
        <a href="#"><i class="fa-solid fa-tag"></i> Promo</a>
        <a href="#"><i class="fa-solid fa-gear"></i> Peraturan</a>
        <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
    </div>
</div>

<!-- ================= MAIN ================= -->
<div class="main">

    <!-- NAVBAR -->
    <div class="topbar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form action="/pembayaran" method="GET" style="width: 100%;">
                <input type="text" name="search" placeholder="Cari pembayaran..." value="{{ request('search') }}">
            </form>
        </div>

        <div class="topbar-right">
            <i class="fa-regular fa-bell"></i>

            <div class="profile">
                <img src="https://i.pravatar.cc/40" alt="Admin">
                <div class="profile-text">
                    <div class="name">Admin</div>
                    <div class="role">Administrator</div>
                </div>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="content-header">
            <h2>Detail Pembayaran</h2>
            <a href="/pembayaran/create" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Pembayaran
            </a>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-exclamation-triangle"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Filters --}}
        <div class="filters">
            <form action="/pembayaran" method="GET" style="display: flex; gap: 15px; align-items: center; width: 100%;">
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Berhasil</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                
                @if(request('status') || request('search'))
                    <a href="/pembayaran" style="color: #666; text-decoration: none; font-size: 13px;">
                        <i class="fa-solid fa-rotate-right"></i> Reset Filter
                    </a>
                @endif
            </form>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Pemesanan</th>
                        <th>Nama Pengirim</th>
                        <th>Bank</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $item)
                        <tr>
                            <td><strong>#{{ $item->id }}</strong></td>
                            <td>{{ $item->id_pemesanan }}</td>
                            <td>{{ $item->nama_pengirim ?? '-' }}</td>
                            <td>{{ $item->nama_bank ?? $item->metode_pembayaran }}</td>
                            <td>{{ $item->tanggal_pembayaran->format('d/m/Y') }}</td>
                            <td><strong style="color: #17b890;">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></td>
                            <td>
                                <span class="status {{ $item->getStatusBadgeClass() }}">
                                    {{ $item->getStatusLabel() }}
                                </span>
                            </td>
                            <td>
                                <div class="action">
                                    <a href="/pembayaran/{{ $item->id }}" class="btn-detail" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>
                                    <a href="/pembayaran/{{ $item->id }}/edit" title="Edit">
                                        <i class="fa-solid fa-pen btn-edit"></i>
                                    </a>
                                    <form action="/pembayaran/{{ $item->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fa-solid fa-inbox"></i>
                                    <p><strong>Belum Ada Data Pembayaran</strong></p>
                                    <p style="font-size: 14px; color: #666;">Klik tombol "Tambah Pembayaran" untuk menambahkan data baru</p>
                                    <a href="/pembayaran/create" class="btn-add" style="margin-top: 10px;">
                                        <i class="fa-solid fa-plus"></i> Tambah Pembayaran Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Info total data --}}
        @if($pembayaran->count() > 0)
            <p style="margin-top: 15px; color: #666; font-size: 14px;">
                <i class="fa-solid fa-info-circle"></i> 
                Total: <strong>{{ $pembayaran->count() }}</strong> pembayaran
            </p>
        @endif

    </div>
</div>

</body>
</html>