<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Paket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .paket-container {
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

<div class="paket-container">

    <div class="paket-header">
        <h4>Detail Paket</h4>
        <a href="{{ route('paket-layanan.create') }}" class="btn-tambah">
            + Tambah
        </a>
    </div>

    <div class="paket-card">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Fasilitas</th>
                    <th>Venue</th>
                    <th>Harga</th>
                    <th>Kapasitas</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($paketLayanan as $item)
                <tr>
                    <td>
                        <div class="nama-paket">
                            <img src="{{ asset('assets/gambarPaket/' . $item->gambar_venue) }}" alt="Gambar Paket">
                            <strong>{{ $item->nama_paket }}</strong>
                        </div>
                    </td>
                    <td>
                        Tenda<br>Matras<br>Makan & Minum
                    </td>
                    <td>{{ $item->detail_venue }}</td>
                    <td>Rp{{ number_format($item->harga_paket,0,',','.') }}</td>
                    <td>10 - 30 Orang</td>
                    <td class="aksi text-center">
                        <a href="{{ route('paket-layanan.edit', $item->id) }}">✏️</a>
                        <form action="{{ route('paket-layanan.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button>🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>

