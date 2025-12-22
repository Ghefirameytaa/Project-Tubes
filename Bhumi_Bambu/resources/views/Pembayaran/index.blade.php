<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
            color: #111827;
        }

        :root{
            --green:#2f6f3e;
            --green-dark:#265c33;
            --border:#eef0f2;
            --line:#e5e7eb;
            --muted:#6b7280;
            --shadow: 0 18px 40px rgba(17,24,39,.06);
            --shadow-soft: 0 10px 25px rgba(17,24,39,.05);
            --radius: 18px;
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
            border-right: 1px solid var(--border);
            box-shadow: 2px 0 10px rgba(0,0,0,0.04);
        }

        .logo{
            display:flex;
            justify-content:center;
            align-items:center;
            padding: 6px 0 18px;
            margin-bottom: 18px;
        }
        .sidebar-logo{
            width: 140px;
            height: auto;
            object-fit: contain;
            display:block;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            text-decoration: none;
            color: #374151;
            border-radius: 12px;
            font-size: 14px;
            transition: background .15s ease, color .15s ease;
        }

        .menu a i {
            margin-right: 12px;
            width: 20px;
        }

        .menu a.active,
        .menu a:hover {
            background: var(--green);
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
            background: var(--green);
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
            border-radius: 999px;
            padding: 10px 14px;
            width: 380px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(17,24,39,.08);
        }

        .search-box i {
            color: #9ca3af;
            margin: 0;
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
            gap: 14px;
        }

        .topbar-right .bell{
            width: 40px;
            height: 40px;
            border-radius: 999px;
            display:grid;
            place-items:center;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.14);
            cursor:pointer;
        }

        .profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            gap: 10px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.14);
        }

        .profile img {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            object-fit: cover;
        }

        .profile-text { line-height: 1.2; }
        .profile-text .name { font-size: 14px; font-weight: 600; }
        .profile-text .role { font-size: 12px; opacity: 0.85; }
        .profile .chev{ opacity:.9; }

        /* ================= CONTENT ================= */
        .content { padding: 26px 28px; }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .content-header h2 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }

        .btn-add {
            background: var(--green);
            color: #fff;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 25px rgba(47,111,62,.18);
            transition: transform .15s ease, background .15s ease;
        }
        .btn-add i{ font-size: 13px; }
        .btn-add:hover { background: var(--green-dark); transform: translateY(-1px); }

        /* ================= ALERT ================= */
        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
            border: 1px solid;
        }

        .alert-success {
            background: #ecfdf5;
            border-color: #bbf7d0;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border-color: #fecaca;
            color: #7f1d1d;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ================= FILTERS ================= */
        .filters{
            background:#fff;
            border-radius:16px;
            padding:16px 18px;
            margin-bottom:18px;
            display:flex;
            align-items:center;
            gap:12px;
            border:1px solid var(--border);
            box-shadow: var(--shadow-soft);
        }

        .filter-select{
            height:42px;
            min-width: 220px;
            padding: 0 14px;
            border:1px solid var(--line);
            border-radius:12px;
            font-size:14px;
            outline:none;
            background:#fff;
        }
        .filter-select:focus{
            border-color: rgba(47,111,62,.55);
            box-shadow: 0 0 0 4px rgba(47,111,62,.12);
        }

        .reset-link{
            color: #6b7280;
            text-decoration: none;
            font-size: 13px;
            display:inline-flex;
            align-items:center;
            gap:6px;
        }
        .reset-link:hover{ color:#111827; }

        /* ================= CARD + TABLE ================= */
        .card{
            background:#fff;
            border-radius: var(--radius);
            padding:0;
            border:1px solid var(--border);
            box-shadow: var(--shadow);
            overflow:hidden;
        }

        table{
            width:100%;
            border-collapse:separate;
            border-spacing:0;
        }

        thead th{
            background:#f4f6f8;
            font-size:13px;
            font-weight:600;
            color:#111827;
            padding:16px 18px;
            border-bottom:1px solid var(--line);
        }

        tbody td{
            font-size:14px;
            padding:16px 18px;
            border-bottom:1px solid #f0f2f4;
            color:#111827;
            vertical-align: middle;
        }
        tbody tr:last-child td{ border-bottom:none; }
        tbody tr:hover{ background:#fafafa; }

        /* ================= STATUS ================= */
        .status{
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            color:#fff;
            display:inline-block;
            white-space: nowrap;
        }
        .success{ background:#10b981; }
        .pending{ background:#f59e0b; }
        .cancel{ background:#ef4444; }

        /* ================= ACTION ================= */
        .action{
            display:flex;
            gap:10px;
            align-items:center;
        }

        .btn-detail{
            color: #2563eb;
            padding: 8px 12px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            border: 1px solid #2563eb;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .15s ease;
            white-space: nowrap;
        }
        .btn-detail:hover{
            background:#2563eb;
            color:#fff;
        }

        .btn-edit{
            color:#f59e0b;
            cursor:pointer;
            font-size:16px;
            text-decoration:none;
            transition: transform .15s ease, color .15s ease;
        }
        .btn-edit:hover{
            color:#d97706;
            transform: scale(1.08);
        }

        .btn-delete{
            color:#ef4444;
            background:none;
            border:none;
            cursor:pointer;
            font-size:16px;
            transition: transform .15s ease, color .15s ease;
        }
        .btn-delete:hover{
            color:#dc2626;
            transform: scale(1.08);
        }

        /* ================= EMPTY STATE MODERN ================= */
        .empty-state.modern{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding: 56px 24px;
            text-align:center;
            color: var(--muted);
        }

        .empty-illustration{
            width:72px;
            height:72px;
            border-radius:18px;
            background:#f3f4f6;
            display:grid;
            place-items:center;
            border:1px solid var(--line);
        }
        .empty-illustration i{
            font-size:28px;
            color:#9ca3af;
        }

        .empty-state.modern h3{
            margin:14px 0 6px;
            font-size:18px;
            font-weight:600;
            color:#111827;
        }
        .empty-state.modern p{
            margin:0 0 18px;
            font-size:14px;
            color:var(--muted);
            max-width:520px;
        }

        .btn-primary{
            display:inline-flex;
            align-items:center;
            gap:10px;
            padding: 12px 18px;
            border-radius:14px;
            background: var(--green);
            color:#fff;
            text-decoration:none;
            font-size:14px;
            font-weight:600;
            box-shadow: 0 10px 25px rgba(47,111,62,.18);
            transition: transform .15s ease, background .15s ease;
        }
        .btn-primary:hover{
            background: var(--green-dark);
            transform: translateY(-1px);
        }
        .btn-primary .btn-icon{
            width:36px;
            height:36px;
            border-radius:12px;
            background: rgba(255,255,255,.16);
            display:grid;
            place-items:center;
            border:1px solid rgba(255,255,255,.18);
        }
        .btn-primary .btn-icon i{ font-size: 14px; }

        /* Responsive small */
        @media (max-width: 900px){
            .search-box{ width: 260px; }
        }
        @media (max-width: 720px){
            .sidebar{ position: static; width:auto; height:auto; }
            .main{ margin-left:0; }
            .topbar{ padding:0 16px; }
            .content{ padding:16px; }
        }
    </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('aset/logo.png') }}" alt="Logo Bhumi Bambu" class="sidebar-logo">
    </div>

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
            <div class="bell" title="Notifikasi">
                <i class="fa-regular fa-bell"></i>
            </div>

            <div class="profile">
                <img src="https://i.pravatar.cc/40" alt="Admin">
                <div class="profile-text">
                    <div class="name">Admin</div>
                    <div class="role">Administrator</div>
                </div>
                <i class="fa-solid fa-chevron-down chev"></i>
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
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Filters --}}
        <div class="filters">
            <form action="/pembayaran" method="GET" style="display:flex; gap:12px; align-items:center; width:100%;">
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="Berhasil" {{ request('status') == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                    <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                @if(request('status') || request('search'))
                    <a href="/pembayaran" class="reset-link">
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
                            <td>{{ $item->pemesanan_id }}</td>
                            <td>{{ $item->nama_pengirim ?? '-' }}</td>
                            <td>{{ $item->nama_bank ?? $item->metode_pembayaran }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y') }}</td>
                            <td><strong style="color:#10b981;">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</strong></td>
                            <td>
                                @if($item->status_pembayaran == 'Pending')
                                    <span class="status pending">Menunggu Verifikasi</span>
                                @elseif($item->status_pembayaran == 'Berhasil')
                                    <span class="status success">Berhasil</span>
                                @else
                                    <span class="status cancel">Dibatalkan</span>
                                @endif
                            </td>
                            <td>
                                <div class="action">
                                    <a href="{{ url('/pembayaran/' . $item->id) }}"
                                       class="btn-detail"
                                       title="Lihat Detail Pembayaran">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </a>

                                    <a href="{{ url('/pembayaran/' . $item->id . '/edit') }}"
                                       class="btn-edit"
                                       title="Edit Pembayaran">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ url('/pembayaran/' . $item->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus Pembayaran">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding:0;">
                                <div class="empty-state modern">
                                    <div class="empty-illustration">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </div>
                                    <h3>Belum Ada Data Pembayaran</h3>
                                    <p>Klik tombol di bawah untuk menambahkan data pembayaran pertama.</p>
                                    <a href="/pembayaran/create" class="btn-primary">
                                        <span class="btn-icon"><i class="fa-solid fa-plus"></i></span>
                                        <span>Tambah Pembayaran Pertama</span>
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

<script>
    // Auto hide alert after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(function() { alert.remove(); }, 500);
        });
    }, 5000);
</script>

</body>
</html>
