<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran #{{ $pembayaran->id }}</title>
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2f6f3e;
            border-bottom: 2px solid #2f6f3e;
            padding-bottom: 10px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            color: #333;
        }

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

        .proof-image {
            max-width: 100%;
            max-height: 500px;
            border-radius: 8px;
            border: 1px solid #ddd;
            cursor: pointer;
            margin-top: 15px;
        }

        .proof-image:hover {
            opacity: 0.9;
        }

        .no-proof {
            padding: 40px;
            text-align: center;
            background: #f8f9fa;
            border-radius: 8px;
            color: #999;
        }

        .verification-form {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            border: 2px solid #2f6f3e;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            resize: vertical;
            min-height: 100px;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #2f6f3e;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-success {
            background: #17b890;
            color: white;
        }

        .btn-success:hover {
            background: #13996e;
        }

        .btn-danger {
            background: #ff5c5c;
            color: white;
        }

        .btn-danger:hover {
            background: #e04848;
        }

        .btn-warning {
            background: #f4b400;
            color: white;
        }

        .btn-warning:hover {
            background: #d99f00;
        }

        .note-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        .note-box strong {
            color: #856404;
        }

        .verified-info {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            color: #155724;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Detail Pembayaran #{{ $pembayaran->id }}</h1>
        <a href="/pembayaran" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fa-solid fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <h2><i class="fa-solid fa-info-circle"></i> Informasi Pembayaran</h2>
        
        <div class="detail-grid">
            <div class="detail-label">ID Pembayaran:</div>
            <div class="detail-value"><strong>#{{ $pembayaran->id }}</strong></div>

            <div class="detail-label">ID Pemesanan:</div>
            <div class="detail-value">#{{ $pembayaran->id_pemesanan }}</div>

            <div class="detail-label">Status:</div>
            <div class="detail-value">
                <span class="status {{ $pembayaran->getStatusBadgeClass() }}">
                    {{ $pembayaran->getStatusLabel() }}
                </span>
            </div>

            <div class="detail-label">Jumlah Pembayaran:</div>
            <div class="detail-value">
                <strong style="color: #17b890; font-size: 20px;">
                    Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                </strong>
            </div>

            <div class="detail-label">Metode Pembayaran:</div>
            <div class="detail-value">{{ $pembayaran->metode_pembayaran }}</div>

            @if($pembayaran->nama_bank)
                <div class="detail-label">Bank / E-Wallet:</div>
                <div class="detail-value">{{ $pembayaran->nama_bank }}</div>
            @endif

            @if($pembayaran->nama_pengirim)
                <div class="detail-label">Nama Pengirim:</div>
                <div class="detail-value">{{ $pembayaran->nama_pengirim }}</div>
            @endif

            <div class="detail-label">Tanggal Pembayaran:</div>
            <div class="detail-value">{{ $pembayaran->tanggal_pembayaran->format('d F Y') }}</div>

            @if($pembayaran->waktu_verifikasi)
                <div class="detail-label">Waktu Verifikasi:</div>
                <div class="detail-value">{{ $pembayaran->waktu_verifikasi->format('d F Y, H:i') }} WIB</div>
            @endif

            @if($pembayaran->verifikasi_oleh && $pembayaran->verifikator)
                <div class="detail-label">Diverifikasi Oleh:</div>
                <div class="detail-value">{{ $pembayaran->verifikator->name }}</div>
            @endif
        </div>

        @if($pembayaran->catatan_admin)
            <div class="note-box">
                <strong><i class="fa-solid fa-clipboard"></i> Catatan Admin:</strong><br>
                {{ $pembayaran->catatan_admin }}
            </div>
        @endif
    </div>

    <div class="card">
        <h2><i class="fa-solid fa-image"></i> Bukti Pembayaran</h2>
        
        @if($pembayaran->bukti_pembayaran)
            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" 
                 alt="Bukti Pembayaran" 
                 class="proof-image"
                 onclick="window.open(this.src, '_blank')">
            <p style="text-align: center; color: #999; margin-top: 10px; font-size: 13px;">
                <i class="fa-solid fa-info-circle"></i> Klik gambar untuk melihat ukuran penuh
            </p>
        @else
            <div class="no-proof">
                <i class="fa-solid fa-image" style="font-size: 48px; color: #ccc;"></i>
                <p>Bukti pembayaran belum diupload</p>
            </div>
        @endif
    </div>

    @if($pembayaran->isPending())
        <div class="card">
            <h2><i class="fa-solid fa-check-circle"></i> Verifikasi Pembayaran</h2>
            
            <form action="/pembayaran/{{ $pembayaran->id }}/verify" method="POST" class="verification-form">
                @csrf
                
                <div class="form-group">
                    <label for="catatan_admin">Catatan Admin (Opsional)</label>
                    <textarea name="catatan_admin" id="catatan_admin" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <div class="btn-group">
                    <button type="submit" name="status_pembayaran" value="Berhasil" class="btn btn-success" onclick="return confirm('Yakin ingin menyetujui pembayaran ini?')">
                        <i class="fa-solid fa-check"></i> Setujui Pembayaran
                    </button>
                    <button type="submit" name="status_pembayaran" value="Dibatalkan" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak pembayaran ini?')">
                        <i class="fa-solid fa-times"></i> Tolak Pembayaran
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="verified-info">
            <i class="fa-solid fa-check-circle"></i>
            <strong>Pembayaran ini sudah diverifikasi</strong><br>
            Status: {{ $pembayaran->getStatusLabel() }}
        </div>
    @endif

    <div style="margin-top: 30px;">
        <a href="/pembayaran/{{ $pembayaran->id }}/edit" class="btn btn-warning">
            <i class="fa-solid fa-edit"></i> Edit Pembayaran
        </a>
    </div>
</div>

</body>
</html>