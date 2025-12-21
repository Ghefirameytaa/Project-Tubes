<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembayaran</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
        }

        .card {
            width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px 40px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
        }

        label span {
            color: red;
        }

        input, select {
            height: 40px;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #f08a24;
        }

        /* Fix untuk select yang required */
        select:invalid {
            color: #999;
        }

        select option:first-child {
            color: #999;
        }

        select option:not(:first-child) {
            color: #333;
        }

        .full {
            grid-column: span 2;
        }

        /* File Upload Styling */
        .file-upload-wrapper {
            position: relative;
            margin-top: 5px;
        }

        .file-upload {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload:hover {
            border-color: #f08a24;
            background: #fff8f0;
        }

        .file-upload.has-file {
            border-color: #17b890;
            background: #f0fdf9;
        }

        .file-upload i {
            font-size: 32px;
            color: #999;
            margin-bottom: 10px;
        }

        .file-upload p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        #imagePreview {
            margin-top: 15px;
            display: none;
            text-align: center;
        }

        #imagePreview img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            padding: 10px 28px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-batal {
            background: #d9d9d9;
            color: #333;
        }

        .btn-simpan {
            background: #f08a24;
            color: #fff;
        }

        .btn-batal:hover {
            background: #c5c5c5;
        }

        .btn-simpan:hover {
            background: #db7b1f;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .helper-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="card">
    <h2>Tambah Pembayaran</h2>

    <form action="/pembayaran" method="POST" enctype="multipart/form-data" id="paymentForm">
        @csrf
        
        <div class="form-grid">
            <!-- ID Pemesanan -->
            <div class="form-group">
                <label>ID Pemesanan <span>*</span></label>
                @if($pemesanan->isEmpty())
                    <input type="number" name="id_pemesanan" placeholder="Masukkan ID Pemesanan" value="{{ old('id_pemesanan') }}" required min="1">
                    <span class="helper-text">⚠️ Belum ada data pemesanan. Masukkan ID pemesanan manual.</span>
                @else
                    <select name="id_pemesanan" id="id_pemesanan" required>
                        <option value="" disabled selected>-- Pilih Pemesanan --</option>
                        @foreach($pemesanan as $item)
                            <option value="{{ $item->id }}" {{ old('id_pemesanan') == $item->id ? 'selected' : '' }}>
                                Pemesanan #{{ $item->id }} - Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                @endif
                @error('id_pemesanan')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Pembayaran -->
            <div class="form-group">
                <label>Tanggal Pembayaran <span>*</span></label>
                <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" required>
                @error('tanggal_pembayaran')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label>Metode Pembayaran <span>*</span></label>
                <select name="metode_pembayaran" id="metode_pembayaran" required>
                    <option value="" disabled selected>-- Pilih Metode --</option>
                    <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                </select>
                @error('metode_pembayaran')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Bank -->
            <div class="form-group">
                <label>Nama Bank / E-Wallet</label>
                <input type="text" name="nama_bank" placeholder="Contoh: BCA, Mandiri, GoPay" value="{{ old('nama_bank') }}">
                @error('nama_bank')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Pengirim -->
            <div class="form-group">
                <label>Nama Pengirim</label>
                <input type="text" name="nama_pengirim" placeholder="Nama sesuai rekening" value="{{ old('nama_pengirim') }}">
                @error('nama_pengirim')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah Bayar -->
            <div class="form-group">
                <label>Jumlah Bayar <span>*</span></label>
                <input type="number" name="jumlah_bayar" id="jumlah_bayar" placeholder="100000" value="{{ old('jumlah_bayar') }}" required min="0">
                @error('jumlah_bayar')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Pembayaran -->
            <div class="form-group">
                <label>Status Pembayaran <span>*</span></label>
                <select name="status_pembayaran" required>
                    <option value="" disabled>-- Pilih Status --</option>
                    <option value="Menunggu" {{ old('status_pembayaran', 'Menunggu') == 'Menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="Berhasil" {{ old('status_pembayaran') == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                    <option value="Dibatalkan" {{ old('status_pembayaran') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status_pembayaran')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="form-group full">
                <label>Bukti Pembayaran</label>
                <div class="file-upload-wrapper">
                    <div class="file-upload" id="fileUpload" onclick="document.getElementById('bukti_pembayaran').click()">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p id="uploadText">Klik untuk upload bukti pembayaran<br>
                        <small>Format: JPG, PNG, JPEG (Max 2MB)</small></p>
                    </div>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(event)">
                    @error('bukti_pembayaran')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    
                    <div id="imagePreview">
                        <img id="preview" src="" alt="Preview">
                    </div>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="/pembayaran" class="btn btn-batal">Batal</a>
            <button type="submit" class="btn btn-simpan">Simpan</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const uploadDiv = document.getElementById('fileUpload');
        const uploadText = document.getElementById('uploadText');
        const imagePreview = document.getElementById('imagePreview');
        const preview = document.getElementById('preview');

        if (file) {
            // Validasi ukuran file (max 2MB)
            if (file.size > 2048000) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                event.target.value = '';
                return;
            }

            // Update upload area
            uploadDiv.classList.add('has-file');
            uploadText.innerHTML = `<i class="fa-solid fa-check-circle" style="color: #17b890;"></i><br>${file.name}<br><small>File berhasil dipilih</small>`;

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    // Fix untuk select styling saat ada value
    const metodeSelect = document.getElementById('metode_pembayaran');
    if (metodeSelect) {
        metodeSelect.addEventListener('change', function() {
            this.style.color = '#333';
        });
    }

    // Auto-fill jumlah bayar berdasarkan pemesanan yang dipilih (jika ada dropdown)
    const pemesananSelect = document.getElementById('id_pemesanan');
    if (pemesananSelect) {
        pemesananSelect.addEventListener('change', function() {
            this.style.color = '#333';
            
            const selectedOption = this.options[this.selectedIndex];
            const hargaText = selectedOption.text;
            
            // Extract harga dari text "Pemesanan #1 - Rp 500.000"
            const match = hargaText.match(/Rp\s([\d.,]+)/);
            if (match) {
                const harga = match[1].replace(/\./g, '').replace(',', '');
                document.getElementById('jumlah_bayar').value = harga;
            }
        });
    }
</script>

</body>
</html>