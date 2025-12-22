<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pembayaran #{{ $pembayaran->id }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h2 {
            margin: 0;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
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

        .full {
            grid-column: span 2;
        }

        /* File Upload */
        .file-upload-wrapper {
            position: relative;
            margin-top: 5px;
        }

        .current-image {
            margin-bottom: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .current-image img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            border: 2px solid #ddd;
            cursor: pointer;
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

        .btn-danger {
            background: #ff5c5c;
            color: #fff;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
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
    <div class="header">
        <h2>Edit Pembayaran #{{ $pembayaran->id }}</h2>
        <a href="/pembayaran" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <form action="/pembayaran/{{ $pembayaran->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <!-- ID Pemesanan -->
            <div class="form-group">
                <label>ID Pemesanan <span>*</span></label>
                <input type="number" name="id_pemesanan" value="{{ old('id_pemesanan', $pembayaran->id_pemesanan) }}" required min="1">
                @error('id_pemesanan')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Pembayaran -->
            <div class="form-group">
                <label>Tanggal Pembayaran <span>*</span></label>
                <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran->format('Y-m-d')) }}" required>
                @error('tanggal_pembayaran')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label>Metode Pembayaran <span>*</span></label>
                <select name="metode_pembayaran" required>
                    <option value="" disabled>-- Pilih Metode --</option>
                    <option value="Transfer Bank" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="E-Wallet" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    <option value="Cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash</option>
                </select>
                @error('metode_pembayaran')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Bank -->
            <div class="form-group">
                <label>Nama Bank / E-Wallet</label>
                <input type="text" name="nama_bank" placeholder="Contoh: BCA, Mandiri, GoPay" value="{{ old('nama_bank', $pembayaran->nama_bank) }}">
                @error('nama_bank')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nama Pengirim -->
            <div class="form-group">
                <label>Nama Pengirim</label>
                <input type="text" name="nama_pengirim" placeholder="Nama sesuai rekening" value="{{ old('nama_pengirim', $pembayaran->nama_pengirim) }}">
                @error('nama_pengirim')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jumlah Bayar -->
            <div class="form-group">
                <label>Jumlah Bayar <span>*</span></label>
                <input type="number" name="jumlah_bayar" placeholder="100000" value="{{ old('jumlah_bayar', $pembayaran->jumlah_bayar) }}" required min="0">
                @error('jumlah_bayar')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status Pembayaran -->
            <div class="form-group">
                <label>Status Pembayaran <span>*</span></label>
                <select name="status_pembayaran" required>
                    <option value="" disabled>-- Pilih Status --</option>
                    <option value="Menunggu" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Menunggu' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="Berhasil" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                    <option value="Dibatalkan" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
                @error('status_pembayaran')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="form-group full">
                <label>Bukti Pembayaran</label>
                
                @if($pembayaran->bukti_pembayaran)
                    <div class="current-image">
                        <p style="margin: 0 0 10px 0; font-weight: 600; color: #666;">
                            <i class="fa-solid fa-image"></i> Bukti Saat Ini:
                        </p>
                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" 
                             alt="Bukti Pembayaran"
                             onclick="window.open(this.src, '_blank')">
                        <p style="margin: 10px 0 0 0; font-size: 12px; color: #666;">
                            <i class="fa-solid fa-info-circle"></i> Klik gambar untuk melihat ukuran penuh
                        </p>
                    </div>
                @endif
                
                <div class="file-upload-wrapper">
                    <div class="file-upload" id="fileUpload" onclick="document.getElementById('bukti_pembayaran').click()">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p id="uploadText">
                            @if($pembayaran->bukti_pembayaran)
                                Klik untuk ganti bukti pembayaran
                            @else
                                Klik untuk upload bukti pembayaran
                            @endif
                            <br><small>Format: JPG, PNG, JPEG (Max 2MB)</small>
                        </p>
                    </div>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(event)">
                    <span class="helper-text">* Opsional - Kosongkan jika tidak ingin mengubah bukti</span>
                    @error('bukti_pembayaran')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    
                    <div id="imagePreview">
                        <p style="margin-bottom: 10px; color: #17b890; font-weight: 600;">
                            <i class="fa-solid fa-check-circle"></i> Preview Bukti Baru:
                        </p>
                        <img id="preview" src="" alt="Preview">
                    </div>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="/pembayaran" class="btn btn-batal">Batal</a>
            <button type="submit" class="btn btn-simpan">
                <i class="fa-solid fa-save"></i> Update
            </button>
        </div>
    </form>

    <!-- Form Delete (Separate) -->
    <form action="/pembayaran/{{ $pembayaran->id }}" method="POST" style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('PERHATIAN: Data pembayaran akan dihapus permanen! Yakin ingin menghapus?')">
        @csrf
        @method('DELETE')
        <p style="color: #666; margin-bottom: 15px;">
            <i class="fa-solid fa-exclamation-triangle" style="color: #ff5c5c;"></i>
            <strong>Zona Bahaya:</strong> Hapus pembayaran ini secara permanen
        </p>
        <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-trash"></i> Hapus Pembayaran
        </button>
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
            uploadText.innerHTML = `<i class="fa-solid fa-check-circle" style="color: #17b890;"></i><br>${file.name}<br><small>File baru dipilih</small>`;

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }
</script>

</body>
</html>