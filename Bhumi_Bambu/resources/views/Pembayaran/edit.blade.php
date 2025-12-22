<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran #{{ $pembayaran->id }}</title>

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
            --danger:#ef4444;
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

        /* ================= NAVBAR (SAMA PERSIS INDEX) ================= */
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
            width: 380px; /* ✅ sama kayak index */
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(17,24,39,.08);
        }

        .search-box i {
            color: #9ca3af;
            margin: 0;
        }

        .search-box form{
            width: 100%;
            display:flex;
            align-items:center;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            background: transparent;
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

        .page-head{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:16px;
            margin-bottom:14px;
        }
        .page-title{
            display:flex;
            flex-direction:column;
            gap:4px;
        }
        .page-title h2{
            margin:0;
            font-size:22px;
            font-weight:700;
        }
        .page-title p{
            margin:0;
            font-size:13px;
            color:var(--muted);
        }

        .btn{
            border:none;
            border-radius:14px;
            padding:10px 14px;
            font-weight:800;
            font-size:14px;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:8px;
            transition: transform .15s ease, opacity .15s ease, border-color .15s ease;
            white-space:nowrap;
        }
        .btn-secondary{
            background:#fff;
            border:1px solid var(--line);
            color:#111827;
            box-shadow: var(--shadow-soft);
        }
        .btn-secondary:hover{ transform: translateY(-1px); border-color:#d1d5db; }
        .btn-primary{
            background: var(--green);
            color:#fff;
            box-shadow: 0 10px 25px rgba(47,111,62,.18);
        }
        .btn-primary:hover{ transform: translateY(-1px); opacity:.95; }

        .alert{
            display:flex;
            gap:10px;
            align-items:flex-start;
            padding:12px 14px;
            border-radius:12px;
            border:1px solid;
            margin: 10px 0 14px;
            animation: slideDown .25s ease;
        }
        .alert-error{ background:#fef2f2; border-color:#fecaca; color:#7f1d1d; }
        .alert-success{ background:#ecfdf5; border-color:#bbf7d0; color:#065f46; }
        @keyframes slideDown{
            from{ opacity:0; transform: translateY(-8px); }
            to{ opacity:1; transform: translateY(0); }
        }

        .card{
            background:#fff;
            border-radius: var(--radius);
            border:1px solid var(--border);
            box-shadow: var(--shadow);
            padding: 18px;
        }

        .form-grid{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 18px;
        }
        .full{ grid-column: 1 / -1; }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }
        label{
            font-weight:700;
            font-size:13px;
            color:#111827;
            display:flex;
            align-items:center;
            gap:6px;
        }
        .req{ color:var(--danger); font-weight:900; }

        input, select{
            width:100%;
            height:44px;
            padding:10px 12px;
            border-radius:12px;
            border:1px solid var(--line);
            font-size:14px;
            outline:none;
            background:#fff;
            transition: border-color .15s ease, box-shadow .15s ease;
            font-family:'Poppins', sans-serif;
        }
        input:focus, select:focus{
            border-color: rgba(47,111,62,.55);
            box-shadow: 0 0 0 4px rgba(47,111,62,.12);
        }
        input[disabled]{
            background:#f9fafb;
            color:#111827;
        }

        .helper{
            font-size:12.5px;
            color:var(--muted);
            display:flex;
            gap:8px;
            align-items:flex-start;
            line-height:1.4;
        }

        .dropzone{
            border: 1.8px dashed #d1d5db;
            border-radius: 16px;
            padding: 16px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;
            cursor:pointer;
            transition: background .15s ease, border-color .15s ease, transform .15s ease;
            background: #fafafa;
        }
        .dropzone:hover{
            border-color: rgba(47,111,62,.55);
            background: #f6fbf7;
            transform: translateY(-1px);
        }

        .dz-left{ display:flex; gap:12px; align-items:flex-start; }
        .dz-icon{
            width:44px; height:44px;
            border-radius:14px;
            display:grid; place-items:center;
            background: rgba(47,111,62,.10);
            border: 1px solid rgba(47,111,62,.18);
            color: var(--green);
            flex:0 0 44px;
        }
        .dz-icon i{ font-size:18px; }
        .dz-text{ display:flex; flex-direction:column; gap:2px; }
        .dz-text strong{ font-size:14px; }
        .dz-text span{ font-size:12.5px; color:var(--muted); }

        .dz-right .pill{
            padding:8px 12px;
            border-radius:999px;
            border:1px solid var(--line);
            background:#fff;
            font-size:12.5px;
            color:var(--muted);
            white-space:nowrap;
        }

        input[type="file"]{ display:none; }

        .actions{
            display:flex;
            justify-content:space-between;
            gap:12px;
            margin-top:16px;
            padding-top:16px;
            border-top:1px solid var(--border);
        }

        .btn-link{
            background: transparent;
            border: none;
            color: var(--green);
            padding: 0;
            font-weight: 700;
            text-decoration: underline;
            cursor:pointer;
        }

        /* ✅ responsive sama kayak index */
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

    <!-- NAVBAR (SAMA PERSIS INDEX) -->
    <div class="topbar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form action="/pembayaran" method="GET">
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

        <div class="page-head">
            <div class="page-title">
                <h2>Edit Pembayaran #{{ $pembayaran->id }}</h2>
                <p>Perbarui data pembayaran. Kolom bertanda <span class="req">*</span> wajib diisi.</p>
            </div>

            <div style="display:flex; gap:10px; align-items:center;">
                <a href="{{ url('/pembayaran') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" form="editForm" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Update
                </button>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation" style="margin-top:2px;"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check" style="margin-top:2px;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation" style="margin-top:2px;"></i>
                <div>
                    <div style="font-weight:800;">Terjadi kesalahan validasi</div>
                    <ul style="margin:6px 0 0 18px; padding:0;">
                        @foreach($errors->all() as $error)
                            <li style="font-size:13px; margin-bottom:2px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="card">
            <form id="editForm" action="{{ url('/pembayaran/' . $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- pemesanan_id tetap terkirim -->
                <input type="hidden" name="pemesanan_id" value="{{ $pembayaran->pemesanan_id }}">

                <div class="form-grid">
                    <div class="form-group">
                        <label>ID Pemesanan <span class="req">*</span></label>
                        <input type="text" value="{{ $pembayaran->pemesanan_id }}" disabled>
                        <div class="helper">
                            <i class="fa-regular fa-circle-info"></i>
                            <span>ID pemesanan otomatis terisi dan tidak bisa diubah di halaman edit.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Pembayaran <span class="req">*</span></label>
                        <input type="date" name="tanggal_pembayaran"
                               value="{{ old('tanggal_pembayaran', date('Y-m-d', strtotime($pembayaran->tanggal_pembayaran))) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Metode Pembayaran <span class="req">*</span></label>
                        <select name="metode_pembayaran" required>
                            <option value="Transfer Bank" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                            <option value="E-Wallet" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                            <option value="Cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Bank / E-Wallet</label>
                        <input type="text" name="nama_bank" value="{{ old('nama_bank', $pembayaran->nama_bank) }}">
                    </div>

                    <div class="form-group">
                        <label>Nama Pengirim</label>
                        <input type="text" name="nama_pengirim" value="{{ old('nama_pengirim', $pembayaran->nama_pengirim) }}">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Bayar <span class="req">*</span></label>
                        <input type="number" name="jumlah_bayar" min="0" step="1000"
                               value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status Pembayaran <span class="req">*</span></label>
                        <select name="status_pembayaran" required>
                            <option value="Pending" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Berhasil" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                            <option value="Dibatalkan" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Bukti Pembayaran</label>

                        <div class="dropzone" id="dropzone">
                            <div class="dz-left">
                                <div class="dz-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="dz-text">
                                    <strong id="dzTitle">Klik untuk upload bukti pembayaran</strong>
                                    <span id="dzSub">Format: JPG, PNG, JPEG • Maks 2MB</span>

                                    @if($pembayaran->bukti_pembayaran)
                                        <span style="margin-top:6px;">
                                            File saat ini:
                                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn-link">
                                                Lihat Bukti
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="dz-right">
                                <div class="pill"><i class="fa-regular fa-image"></i> Pilih File</div>
                            </div>
                        </div>

                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg">

                        <div class="helper">
                            <i class="fa-regular fa-circle-info"></i>
                            <span>Kalau tidak upload file baru, bukti pembayaran lama tetap digunakan.</span>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ url('/pembayaran') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Update Pembayaran
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
(function(){
    const MAX_SIZE = 2 * 1024 * 1024;
    const dz = document.getElementById('dropzone');
    const fi = document.getElementById('bukti_pembayaran');
    const dzTitle = document.getElementById('dzTitle');
    const dzSub = document.getElementById('dzSub');

    if (dz && fi) {
        dz.addEventListener('click', () => fi.click());
        fi.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) return;

            if (file.size > MAX_SIZE) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                fi.value = '';
                return;
            }

            const allowed = ['image/jpeg','image/png','image/jpg'];
            if (!allowed.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG atau PNG.');
                fi.value = '';
                return;
            }

            dzTitle.textContent = file.name;
            dzSub.textContent = 'File baru berhasil dipilih';
        });
    }
})();
</script>

</body>
</html>
