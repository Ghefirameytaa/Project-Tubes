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

        .full {
            grid-column: span 2;
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
    </style>
</head>
<body>

<div class="card">
    <h2>Tambah Pembayaran</h2>

    <form action="{{ url('/pembayaran') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Pemesanan <span>*</span></label>
                <select name="pemesanan_id" required>
                    <option value="">-- Pilih Pemesanan --</option>
                    @foreach($pemesanan as $psn)
                        <option value="{{ $psn->id }}">
                            Pemesanan #{{ $psn->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Metode Pembayaran <span>*</span></label>
                <input type="text" name="metode_pembayaran" required>
            </div>

            <div class="form-group">
                <label>Jumlah Bayar <span>*</span></label>
                <input type="number" name="jumlah_bayar" required>
            </div>

            <div class="form-group">
                <label>Tanggal Bayar <span>*</span></label>
                <input type="date" name="tanggal_bayar" required>
            </div>

            <div class="form-group full">
                <label>Status <span>*</span></label>
                <select name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="pending">Pending</option>
                    <option value="lunas">Lunas</option>
                </select>
            </div>

        </div>

        <div class="actions">
            <a href="{{ url('/pembayaran') }}">
                <button type="button" class="btn btn-batal">Batal</button>
            </a>

            <button type="submit" class="btn btn-simpan">Simpan</button>
        </div>

    </form>
</div>

</body>
</html>
