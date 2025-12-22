<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran #{{ $pembayaran->id }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --bg:#f4f6f8;
            --card:#ffffff;
            --text:#111827;
            --muted:#6b7280;
            --line:#e5e7eb;
            --border:#eef0f2;

            --green:#2f6f3e;
            --green-dark:#265c33;

            --success:#10b981;
            --warning:#f59e0b;
            --danger:#ef4444;
            --info:#2563eb;

            --shadow: 0 18px 40px rgba(17,24,39,.06);
            --shadow-soft: 0 10px 25px rgba(17,24,39,.05);

            --radius:18px;
            --radius-sm:12px;
        }

        *{ box-sizing:border-box; }
        body{
            margin:0;
            font-family:'Poppins', sans-serif;
            background:var(--bg);
            color:var(--text);
        }

        /* ================= SIDEBAR ================= */
        .sidebar{
            width:240px;
            background:#fff;
            height:100vh;
            padding:20px;
            position:fixed;
            left:0; top:0;
            border-right:1px solid var(--border);
            box-shadow:2px 0 10px rgba(0,0,0,0.04);
        }

        .logo{
            display:flex;
            justify-content:center;
            align-items:center;
            padding: 6px 0 18px;
            margin-bottom: 18px;
        }
        .sidebar-logo{
            width:140px;
            height:auto;
            object-fit:contain;
            display:block;
        }

        .menu a{
            display:flex;
            align-items:center;
            padding:12px 15px;
            margin-bottom:8px;
            text-decoration:none;
            color:#374151;
            border-radius:12px;
            font-size:14px;
            transition: background .15s ease, color .15s ease;
        }
        .menu a i{ margin-right:12px; width:20px; }
        .menu a.active, .menu a:hover{ background:var(--green); color:#fff; }

        /* ================= MAIN ================= */
        .main{
            margin-left:240px;
            min-height:100vh;
        }

        /* ================= TOPBAR ================= */
        .topbar{
            height:70px;
            background:var(--green);
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 30px;
            position:sticky;
            top:0;
            z-index:10;
        }

        .search-box{
            background:#fff;
            border-radius:999px;
            padding:10px 14px;
            width:380px;
            display:flex;
            align-items:center;
            gap:10px;
            border:1px solid rgba(17,24,39,.08);
        }
        .search-box i{ color:#9ca3af; }
        .search-box input{
            border:none;
            outline:none;
            width:100%;
            font-size:14px;
        }

        .topbar-right{
            display:flex;
            align-items:center;
            gap:14px;
            color:#fff;
        }

        .bell{
            width:40px;
            height:40px;
            border-radius:999px;
            display:grid;
            place-items:center;
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.14);
            cursor:pointer;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:10px;
            padding:6px 10px;
            border-radius:999px;
            background:rgba(255,255,255,.10);
            border:1px solid rgba(255,255,255,.14);
            cursor:pointer;
        }
        .profile img{
            width:36px; height:36px;
            border-radius:999px;
            object-fit:cover;
        }
        .profile-text{ line-height:1.2; }
        .profile-text .name{ font-size:14px; font-weight:600; }
        .profile-text .role{ font-size:12px; opacity:.85; }
        .chev{ opacity:.9; }

        /* ================= CONTENT ================= */
        .content{ padding:26px 28px; }

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

        /* badge status */
        .badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 12px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            color:#fff;
            white-space:nowrap;
        }
        .badge--pending{ background:var(--warning); }
        .badge--success{ background:var(--success); }
        .badge--cancel{ background:var(--danger); }

        /* alert */
        .alert{
            display:flex;
            gap:10px;
            align-items:center;
            padding:12px 14px;
            border-radius:12px;
            border:1px solid;
            margin: 10px 0 14px;
            animation: slideDown .25s ease;
        }
        .alert-success{
            background:#ecfdf5;
            border-color:#bbf7d0;
            color:#065f46;
        }
        @keyframes slideDown{
            from{ opacity:0; transform: translateY(-8px); }
            to{ opacity:1; transform: translateY(0); }
        }

        /* card */
        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:var(--radius);
            box-shadow: var(--shadow);
            padding:18px;
        }

        .grid{
            display:grid;
            grid-template-columns: 1.25fr .75fr;
            gap:16px;
        }

        .section-title{
            display:flex;
            align-items:center;
            gap:10px;
            margin:0 0 12px;
            font-size:14px;
            font-weight:800;
            color:var(--green);
        }
        .section-title i{
            width:34px; height:34px;
            border-radius:12px;
            display:grid;
            place-items:center;
            background: rgba(47,111,62,.10);
            border:1px solid rgba(47,111,62,.18);
        }

        /* info list */
        .info{
            margin:0;
            display:flex;
            flex-direction:column;
            gap:10px;
        }
        .row{
            display:grid;
            grid-template-columns: 180px 1fr;
            gap:12px;
            padding:10px 12px;
            border-radius:14px;
            background:#fafafa;
            border:1px solid #f0f2f4;
        }
        .row .k{
            font-size:13px;
            color:var(--muted);
            font-weight:600;
        }
        .row .v{
            font-size:13.5px;
            color:#111827;
            font-weight:600;
        }
        .row .v.muted{ color:var(--muted); font-weight:500; }
        .price{
            font-size:18px;
            font-weight:900;
            color:var(--success);
        }

        /* Bukti pembayaran */
        .proof{
            background:#fafafa;
            border:1px solid #f0f2f4;
            border-radius:16px;
            padding:14px;
        }
        .proof .thumb{
            width:100%;
            border-radius:14px;
            border:1px solid var(--line);
            overflow:hidden;
            background:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            min-height: 220px;
        }
        .proof img{
            width:100%;
            height:auto;
            display:block;
            object-fit:contain;
            cursor: zoom-in;
        }
        .proof .empty{
            color:var(--muted);
            font-size:13px;
            display:flex;
            flex-direction:column;
            gap:8px;
            align-items:center;
            padding:24px 10px;
        }
        .proof .empty i{
            width:44px; height:44px;
            border-radius:14px;
            display:grid;
            place-items:center;
            background:#f3f4f6;
            border:1px solid var(--line);
            color:#9ca3af;
        }

        .proof-actions{
            display:flex;
            gap:10px;
            margin-top:12px;
        }

        /* buttons */
        .btn{
            border:none;
            border-radius:14px;
            padding:10px 14px;
            font-weight:700;
            font-size:14px;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:8px;
            transition: transform .15s ease, background .15s ease, border-color .15s ease, opacity .15s ease;
            white-space:nowrap;
        }

        .btn-secondary{
            background:#fff;
            border:1px solid var(--line);
            color:#111827;
            box-shadow: var(--shadow-soft);
        }
        .btn-secondary:hover{ transform: translateY(-1px); border-color:#d1d5db; }

        .btn-info{
            background: var(--info);
            color:#fff;
            box-shadow: 0 10px 25px rgba(37,99,235,.18);
        }
        .btn-info:hover{ transform: translateY(-1px); opacity:.95; }

        .btn-warning{
            background: var(--warning);
            color:#fff;
            box-shadow: 0 10px 25px rgba(245,158,11,.18);
        }
        .btn-warning:hover{ transform: translateY(-1px); opacity:.95; }

        .btn-success{
            background: var(--success);
            color:#fff;
            box-shadow: 0 10px 25px rgba(16,185,129,.18);
        }
        .btn-success:hover{ transform: translateY(-1px); opacity:.95; }

        .btn-danger{
            background: var(--danger);
            color:#fff;
            box-shadow: 0 10px 25px rgba(239,68,68,.18);
        }
        .btn-danger:hover{ transform: translateY(-1px); opacity:.95; }

        /* footer action bar */
        .footer-actions{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            margin-top:16px;
            padding-top:16px;
            border-top:1px solid var(--border);
        }
        .right-actions{ display:flex; gap:10px; flex-wrap:wrap; }

        /* Notes */
        .note{
            background:#fff;
            border:1px solid var(--line);
            border-radius:16px;
            padding:14px;
            margin-top:16px;
        }
        .note p{
            margin:0;
            color:#374151;
            font-size:13.5px;
            line-height:1.5;
        }

        /* ================= MODAL ================= */
        .modal{
            display:none;
            position:fixed;
            inset:0;
            background: rgba(0,0,0,.45);
            z-index:1000;
            padding: 20px;
        }
        .modal.show{
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .modal-card{
            width: min(520px, 100%);
            background:#fff;
            border-radius: 18px;
            border:1px solid rgba(255,255,255,.2);
            box-shadow: 0 20px 60px rgba(0,0,0,.25);
            overflow:hidden;
        }
        .modal-head{
            padding:14px 16px;
            background: #f9fafb;
            border-bottom:1px solid var(--line);
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:10px;
        }
        .modal-head strong{ font-size:15px; }
        .modal-close{
            width:40px; height:40px;
            border-radius:999px;
            border:1px solid var(--line);
            background:#fff;
            cursor:pointer;
        }
        .modal-body{
            padding:16px;
        }
        .modal-body p{
            margin:0 0 12px;
            color:var(--muted);
            font-size:13.5px;
        }
        .modal-body label{
            display:block;
            font-weight:700;
            font-size:13px;
            margin: 10px 0 6px;
        }
        .modal-body textarea{
            width:100%;
            border:1px solid var(--line);
            border-radius:14px;
            padding:12px;
            font-family:'Poppins', sans-serif;
            font-size:14px;
            resize: vertical;
            outline:none;
        }
        .modal-body textarea:focus{
            border-color: rgba(47,111,62,.55);
            box-shadow: 0 0 0 4px rgba(47,111,62,.12);
        }
        .modal-foot{
            padding:14px 16px;
            border-top:1px solid var(--line);
            display:flex;
            justify-content:flex-end;
            gap:10px;
        }

        @media (max-width: 980px){
            .search-box{ width: 260px; }
            .grid{ grid-template-columns: 1fr; }
            .row{ grid-template-columns: 1fr; }
        }
        @media (max-width: 720px){
            .sidebar{ position:static; width:auto; height:auto; }
            .main{ margin-left:0; }
            .topbar{ padding:0 16px; }
            .content{ padding:16px; }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
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

<div class="main">
    <!-- TOPBAR -->
    <div class="topbar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari pembayaran..." />
        </div>

        <div class="topbar-right">
            <div class="bell" title="Notifikasi"><i class="fa-regular fa-bell"></i></div>

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
                <h2>Detail Pembayaran #{{ $pembayaran->id }}</h2>
                <p>Lihat detail transaksi pembayaran dan bukti pembayaran.</p>
            </div>

            <div>
                @if($pembayaran->status_pembayaran == 'Pending')
                    <span class="badge badge--pending"><i class="fa-regular fa-clock"></i> Menunggu Verifikasi</span>
                @elseif($pembayaran->status_pembayaran == 'Berhasil')
                    <span class="badge badge--success"><i class="fa-regular fa-circle-check"></i> Berhasil</span>
                @else
                    <span class="badge badge--cancel"><i class="fa-regular fa-circle-xmark"></i> Dibatalkan</span>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="card">
            <div class="grid">
                <!-- LEFT: Info -->
                <div>
                    <div class="section-title">
                        <i class="fa-solid fa-receipt"></i>
                        Informasi Pembayaran
                    </div>

                    <div class="info">
                        <div class="row">
                            <div class="k">ID Pembayaran</div>
                            <div class="v">#{{ $pembayaran->id }}</div>
                        </div>

                        <div class="row">
                            <div class="k">ID Pemesanan</div>
                            <div class="v">{{ $pembayaran->pemesanan_id }}</div>
                        </div>

                        <div class="row">
                            <div class="k">Tanggal Pembayaran</div>
                            <div class="v">{{ date('d/m/Y', strtotime($pembayaran->tanggal_pembayaran)) }}</div>
                        </div>

                        <div class="row">
                            <div class="k">Metode Pembayaran</div>
                            <div class="v">{{ $pembayaran->metode_pembayaran }}</div>
                        </div>

                        <div class="row">
                            <div class="k">Nama Bank / E-Wallet</div>
                            <div class="v">{{ $pembayaran->nama_bank ?? '-' }}</div>
                        </div>

                        <div class="row">
                            <div class="k">Nama Pengirim</div>
                            <div class="v">{{ $pembayaran->nama_pengirim ?? '-' }}</div>
                        </div>

                        <div class="row">
                            <div class="k">Jumlah Bayar</div>
                            <div class="v"><span class="price">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</span></div>
                        </div>

                        <div class="row">
                            <div class="k">Status</div>
                            <div class="v">
                                @if($pembayaran->status_pembayaran == 'Pending')
                                    <span class="badge badge--pending"><i class="fa-regular fa-clock"></i> Menunggu Verifikasi</span>
                                @elseif($pembayaran->status_pembayaran == 'Berhasil')
                                    <span class="badge badge--success"><i class="fa-regular fa-circle-check"></i> Berhasil</span>
                                @else
                                    <span class="badge badge--cancel"><i class="fa-regular fa-circle-xmark"></i> Dibatalkan</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="k">Tanggal Dibuat</div>
                            <div class="v muted">{{ $pembayaran->created_at->format('d/m/Y H:i') }}</div>
                        </div>

                        @if($pembayaran->waktu_verifikasi)
                        <div class="row">
                            <div class="k">Waktu Verifikasi</div>
                            <div class="v muted">{{ date('d/m/Y H:i', strtotime($pembayaran->waktu_verifikasi)) }}</div>
                        </div>
                        @endif
                    </div>

                    @if($pembayaran->catatan_admin)
                        <div class="note">
                            <div class="section-title" style="margin:0 0 10px; color:#111827;">
                                <i class="fa-regular fa-note-sticky" style="background:#f3f4f6;border-color:var(--line);color:#6b7280;"></i>
                                Catatan Admin
                            </div>
                            <p>{{ $pembayaran->catatan_admin }}</p>
                        </div>
                    @endif
                </div>

                <!-- RIGHT: Proof -->
                <div>
                    <div class="section-title">
                        <i class="fa-regular fa-image"></i>
                        Bukti Pembayaran
                    </div>

                    <div class="proof">
                        <div class="thumb">
                            @if($pembayaran->bukti_pembayaran)
                                <img
                                    src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}"
                                    alt="Bukti Pembayaran"
                                    id="proofImg"
                                >
                            @else
                                <div class="empty">
                                    <i class="fa-regular fa-image"></i>
                                    <div><strong>Belum ada bukti pembayaran</strong></div>
                                    <div style="font-size:12.5px;">Upload bukti saat melakukan input pembayaran.</div>
                                </div>
                            @endif
                        </div>

                        @if($pembayaran->bukti_pembayaran)
                            <div class="proof-actions">
                                <a class="btn btn-secondary" href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                                    <i class="fa-solid fa-up-right-from-square"></i> Buka
                                </a>
                                <a class="btn btn-info" href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" download>
                                    <i class="fa-solid fa-download"></i> Unduh
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- FOOTER ACTIONS -->
            <div class="footer-actions">
                <a href="{{ url('/pembayaran') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>

                <div class="right-actions">
                    @if($pembayaran->status_pembayaran == 'Pending')
                        <button type="button" class="btn btn-success" onclick="openModal('verifyModal')">
                            <i class="fa-solid fa-check"></i> Verifikasi
                        </button>
                        <button type="button" class="btn btn-danger" onclick="openModal('rejectModal')">
                            <i class="fa-solid fa-xmark"></i> Tolak
                        </button>
                    @endif

                    <a href="{{ url('/pembayaran/' . $pembayaran->id . '/edit') }}" class="btn btn-warning">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VERIFIKASI -->
<div id="verifyModal" class="modal" aria-hidden="true">
    <div class="modal-card">
        <div class="modal-head">
            <strong>Verifikasi Pembayaran</strong>
            <button class="modal-close" type="button" onclick="closeModal('verifyModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ url('/pembayaran/' . $pembayaran->id . '/verify') }}" method="POST">
            @csrf
            <input type="hidden" name="status_pembayaran" value="Berhasil">

            <div class="modal-body">
                <p>Apakah Anda yakin ingin memverifikasi pembayaran ini?</p>

                <label>Catatan Admin (Opsional)</label>
                <textarea name="catatan_admin" rows="3" placeholder="Tambahkan catatan jika diperlukan"></textarea>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn btn-secondary" onclick="closeModal('verifyModal')">
                    Batal
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-check"></i> Ya, Verifikasi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL TOLAK -->
<div id="rejectModal" class="modal" aria-hidden="true">
    <div class="modal-card">
        <div class="modal-head">
            <strong>Tolak Pembayaran</strong>
            <button class="modal-close" type="button" onclick="closeModal('rejectModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ url('/pembayaran/' . $pembayaran->id . '/verify') }}" method="POST">
            @csrf
            <input type="hidden" name="status_pembayaran" value="Dibatalkan">

            <div class="modal-body">
                <p>Isi alasan penolakan agar pengguna memahami kenapa pembayaran ditolak.</p>

                <label>Alasan Penolakan <span style="color:var(--danger)">*</span></label>
                <textarea name="catatan_admin" rows="3" placeholder="Masukkan alasan penolakan" required></textarea>
            </div>

            <div class="modal-foot">
                <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">
                    Batal
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="fa-solid fa-xmark"></i> Ya, Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id){
        document.getElementById(id).classList.add('show');
        document.getElementById(id).setAttribute('aria-hidden','false');
    }

    function closeModal(id){
        document.getElementById(id).classList.remove('show');
        document.getElementById(id).setAttribute('aria-hidden','true');
    }

    // close modal if click overlay
    window.addEventListener('click', function(e){
        if(e.target.classList.contains('modal')){
            e.target.classList.remove('show');
            e.target.setAttribute('aria-hidden','true');
        }
    });

    // zoom image open in new tab
    const proofImg = document.getElementById('proofImg');
    if (proofImg) {
        proofImg.addEventListener('click', () => window.open(proofImg.src, '_blank'));
    }

    // auto hide alert
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (!alert) return;
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.5s ease';
        setTimeout(() => alert.remove(), 500);
    }, 5000);
</script>

</body>
</html>
