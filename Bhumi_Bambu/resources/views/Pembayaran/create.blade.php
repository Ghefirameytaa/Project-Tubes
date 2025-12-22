<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran</title>

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

        .wrap{
            max-width: 980px;
            margin: 28px auto;
            padding: 0 16px;
        }

        .page-head{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:16px;
            margin-bottom: 14px;
        }

        .title{
            display:flex;
            flex-direction:column;
            gap:4px;
        }

        .title h2{
            margin:0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing:.2px;
        }

        .title p{
            margin:0;
            color:var(--muted);
            font-size: 13px;
        }

        .head-actions{
            display:flex;
            gap:10px;
            align-items:center;
        }

        .btn{
            border:none;
            border-radius: 14px;
            padding: 10px 14px;
            font-weight: 600;
            font-size: 14px;
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:8px;
            transition: transform .15s ease, background .15s ease, border-color .15s ease;
            white-space:nowrap;
        }

        .btn-secondary{
            background:#fff;
            border:1px solid var(--line);
            color:#111827;
            box-shadow: var(--shadow-soft);
        }
        .btn-secondary:hover{
            border-color:#d1d5db;
            transform: translateY(-1px);
        }

        .btn-primary{
            background:var(--green);
            color:#fff;
            box-shadow: 0 10px 25px rgba(47,111,62,.18);
        }
        .btn-primary:hover{
            background:var(--green-dark);
            transform: translateY(-1px);
        }

        .alert{
            display:flex;
            gap:10px;
            align-items:flex-start;
            padding: 12px 14px;
            border-radius: 12px;
            border:1px solid;
            margin: 12px 0 14px;
            animation: slideDown .25s ease;
        }

        .alert-error{
            background:#fef2f2;
            border-color:#fecaca;
            color:#7f1d1d;
        }

        @keyframes slideDown{
            from{ opacity:0; transform: translateY(-8px); }
            to{ opacity:1; transform: translateY(0); }
        }

        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 18px;
        }

        .card-head{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            margin-bottom: 14px;
        }

        .card-head .hint{
            color:var(--muted);
            font-size: 12.5px;
        }

        .form-grid{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 18px;
        }

        .form-group{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .full{ grid-column: 1 / -1; }

        label{
            font-weight: 600;
            font-size: 13.5px;
            color:#111827;
            display:flex;
            align-items:center;
            gap:6px;
        }

        .req{
            color:#ef4444;
            font-weight:700;
        }

        .control{ position:relative; }

        input, select{
            width:100%;
            height: 44px;
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid var(--line);
            font-size: 14px;
            outline:none;
            background:#fff;
            transition: border-color .15s ease, box-shadow .15s ease;
            font-family:'Poppins', sans-serif;
        }

        input::placeholder{ color:#9ca3af; }

        input:focus, select:focus{
            border-color: rgba(47,111,62,.55);
            box-shadow: 0 0 0 4px rgba(47,111,62,.12);
        }

        select:invalid{ color:#9ca3af; }
        select option{ color:#111827; }
        select option[disabled]{ color:#9ca3af; }

        .error{
            color:#ef4444;
            font-size: 12px;
            margin-top: -2px;
        }

        .dropzone{
            border: 1.8px dashed #d1d5db;
            border-radius: 16px;
            padding: 18px;
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

        .dz-left{
            display:flex;
            align-items:flex-start;
            gap:12px;
        }

        .dz-icon{
            width:44px;
            height:44px;
            border-radius: 14px;
            display:grid;
            place-items:center;
            background: rgba(47,111,62,.10);
            border: 1px solid rgba(47,111,62,.18);
            color: var(--green);
            flex: 0 0 44px;
        }
        .dz-icon i{ font-size: 18px; }

        .dz-text{
            display:flex;
            flex-direction:column;
            gap:2px;
        }
        .dz-text strong{
            font-size: 14px;
            color:#111827;
        }
        .dz-text span{
            font-size: 12.5px;
            color: var(--muted);
        }

        .dz-right{
            display:flex;
            align-items:center;
            gap:10px;
            color: var(--muted);
            font-size: 12.5px;
            white-space: nowrap;
        }

        .dz-badge{
            padding: 8px 12px;
            border-radius: 999px;
            border:1px solid var(--line);
            background:#fff;
        }

        .dropzone.has-file{
            border-color:#10b981;
            background:#ecfdf5;
        }
        .dropzone.has-file .dz-icon{
            background: rgba(16,185,129,.12);
            border-color: rgba(16,185,129,.22);
            color:#10b981;
        }

        input[type="file"]{ display:none; }

        .preview{
            margin-top: 14px;
            display:none;
        }
        .preview img{
            width:100%;
            max-height: 320px;
            object-fit: contain;
            border-radius: 16px;
            border:1px solid var(--line);
            background:#fff;
        }

        .actions{
            display:flex;
            justify-content:flex-end;
            gap: 10px;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        @media (max-width: 820px){
            .form-grid{ grid-template-columns: 1fr; }
            .head-actions{ flex-wrap:wrap; justify-content:flex-end; }
        }
    </style>
</head>

<body>
    <div class="wrap">

        <div class="page-head">
            <div class="title">
                <h2>Tambah Pembayaran</h2>
                <p>Isi data pembayaran dengan lengkap. Kolom bertanda <span class="req">*</span> wajib diisi.</p>
            </div>

            <div class="head-actions">
                <a href="/pembayaran" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" form="paymentForm" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Simpan
                </button>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation" style="margin-top:2px;"></i>
                <div>
                    <div style="font-weight:700;">Terjadi kesalahan</div>
                    <div style="font-size:13px;">{{ session('error') }}</div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fa-solid fa-triangle-exclamation" style="margin-top:2px;"></i>
                <div>
                    <div style="font-weight:700;">Validasi gagal</div>
                    <ul style="margin:6px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li style="font-size:13px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-head">
                <div class="hint"><i class="fa-regular fa-circle-info"></i> Pastikan ID pemesanan dan jumlah bayar sesuai data pemesanan.</div>
            </div>

            <form action="/pembayaran" method="POST" enctype="multipart/form-data" id="paymentForm">
                @csrf

                <div class="form-grid">
                    <!-- PEMESANAN ID -->
                    <div class="form-group">
                        <label>ID Pemesanan <span class="req">*</span></label>

                        @if(isset($pemesanan) && $pemesanan->isEmpty())
                            <div class="control">
                                <input
                                    type="number"
                                    name="pemesanan_id"
                                    placeholder="Masukkan ID Pemesanan"
                                    value="{{ old('pemesanan_id') }}"
                                    required
                                    min="1"
                                >
                            </div>
                        @else
                            <div class="control">
                                <select name="pemesanan_id" id="pemesanan_id" required>
                                    <option value="" disabled {{ old('pemesanan_id') ? '' : 'selected' }}>-- Pilih Pemesanan --</option>
                                    @foreach($pemesanan as $item)
                                        <option value="{{ $item->id }}" {{ (string)old('pemesanan_id') === (string)$item->id ? 'selected' : '' }}>
                                            Pemesanan #{{ $item->id }} - Rp {{ number_format($item->total_harga ?? 0, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @error('pemesanan_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- TANGGAL -->
                    <div class="form-group">
                        <label>Tanggal Pembayaran <span class="req">*</span></label>
                        <div class="control">
                            <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" required>
                        </div>
                        @error('tanggal_pembayaran')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- METODE -->
                    <div class="form-group">
                        <label>Metode Pembayaran <span class="req">*</span></label>
                        <div class="control">
                            <select name="metode_pembayaran" id="metode_pembayaran" required>
                                <option value="" disabled {{ old('metode_pembayaran') ? '' : 'selected' }}>-- Pilih Metode --</option>
                                <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                        </div>
                        @error('metode_pembayaran')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- BANK -->
                    <div class="form-group">
                        <label>Nama Bank / E-Wallet</label>
                        <div class="control">
                            <input type="text" name="nama_bank" placeholder="Contoh: BCA, Mandiri, GoPay" value="{{ old('nama_bank') }}">
                        </div>
                        @error('nama_bank')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- PENGIRIM -->
                    <div class="form-group">
                        <label>Nama Pengirim</label>
                        <div class="control">
                            <input type="text" name="nama_pengirim" placeholder="Nama sesuai rekening" value="{{ old('nama_pengirim') }}">
                        </div>
                        @error('nama_pengirim')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- JUMLAH -->
                    <div class="form-group">
                        <label>Jumlah Bayar <span class="req">*</span></label>
                        <div class="control">
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" placeholder="100000" value="{{ old('jumlah_bayar') }}" required min="0">
                        </div>
                        @error('jumlah_bayar')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- STATUS -->
                    <div class="form-group">
                        <label>Status Pembayaran <span class="req">*</span></label>
                        <div class="control">
                            <select name="status_pembayaran" required>
                                <option value="" disabled>-- Pilih Status --</option>
                                <option value="Pending" {{ old('status_pembayaran', 'Pending') == 'Pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                <option value="Berhasil" {{ old('status_pembayaran') == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                                <option value="Dibatalkan" {{ old('status_pembayaran') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        @error('status_pembayaran')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- spacer -->
                    <div class="form-group" aria-hidden="true" style="opacity:0; pointer-events:none;">
                        <label>_</label>
                        <div class="control"><input type="text" /></div>
                    </div>

                    <!-- UPLOAD -->
                    <div class="form-group full">
                        <label>Bukti Pembayaran</label>

                        <div class="dropzone" id="dropzone">
                            <div class="dz-left">
                                <div class="dz-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="dz-text">
                                    <strong id="dzTitle">Klik untuk upload bukti pembayaran</strong>
                                    <span id="dzSub">Format: JPG, PNG, JPEG • Maks 2MB</span>
                                </div>
                            </div>
                            <div class="dz-right">
                                <span class="dz-badge"><i class="fa-regular fa-image"></i> Pilih File</span>
                            </div>
                        </div>

                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg">

                        @error('bukti_pembayaran')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        <div class="preview" id="previewWrap">
                            <img id="previewImg" src="" alt="Preview Bukti Pembayaran">
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <a href="/pembayaran" class="btn btn-secondary">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
(function(){
    const MAX_SIZE = 2 * 1024 * 1024; // 2MB

    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('bukti_pembayaran');
    const dzTitle = document.getElementById('dzTitle');
    const dzSub = document.getElementById('dzSub');
    const previewWrap = document.getElementById('previewWrap');
    const previewImg = document.getElementById('previewImg');

    if (dropzone && fileInput) {
        dropzone.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files && event.target.files[0];
            if (!file) return;

            if (file.size > MAX_SIZE) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                fileInput.value = '';
                dropzone.classList.remove('has-file');
                dzTitle.textContent = 'Klik untuk upload bukti pembayaran';
                dzSub.textContent = 'Format: JPG, PNG, JPEG • Maks 2MB';
                previewWrap.style.display = 'none';
                return;
            }

            const allowed = ['image/jpeg','image/png','image/jpg'];
            if (!allowed.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG atau PNG.');
                fileInput.value = '';
                return;
            }

            dropzone.classList.add('has-file');
            dzTitle.textContent = file.name;
            dzSub.textContent = 'File berhasil dipilih';

            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                previewWrap.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }

    // Autofill jumlah bayar dari option text
    const pemesananSelect = document.getElementById('pemesanan_id');
    const jumlahBayar = document.getElementById('jumlah_bayar');

    if (pemesananSelect && jumlahBayar) {
        pemesananSelect.addEventListener('change', function(){
            const selectedOption = this.options[this.selectedIndex];
            const text = selectedOption ? selectedOption.text : '';
            const match = text.match(/Rp\s([\d.,]+)/);

            if (match) {
                const angka = match[1].replace(/\./g, '').replace(/,/g, '');
                jumlahBayar.value = angka;
            }
        });
    }
})();
</script>

</body>
</html>
