<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Bhumi Bambu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Selamat Datang, {{ session('user_name') }}</h1>

    <div class="row my-4">
        <div class="col-md-3"><div class="card p-3 bg-success text-white text-center">Acara Berlangsung: <h2>{{ $acaraBerlangsung }}</h2></div></div>
        <div class="col-md-3"><div class="card p-3 bg-warning text-white text-center">Menunggu Konfirmasi: <h2>{{ $menungguKonfirmasi }}</h2></div></div>
        <div class="col-md-3"><div class="card p-3 bg-primary text-white text-center">Acara Selesai: <h2>{{ $acaraSelesai }}</h2></div></div>
        <div class="col-md-3"><div class="card p-3 bg-secondary text-white text-center">Venue Terpakai: <h2>{{ $venueTerpakai }}</h2></div></div>
    </div>

    <h3>Detail Pelanggan ({{ $tanggal }})</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Paket</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Acara</th>
                <th>Waktu Mulai</th>
                <th>Total Harga</th>
                <th>Venue</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detailPelanggan as $item)
            <tr>
                <td>{{ $item['nama_paket'] }}</td>
                <td>{{ $item['nama_pelanggan'] }}</td>
                <td>{{ $item['tanggal_acara'] }}</td>
                <td>{{ $item['waktu_mulai'] }}</td>
                <td>{{ $item['total_harga'] }}</td>
                <td>{{ $item['venue'] }}</td>
                <td>{{ $item['status_label'] }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Tidak ada acara hari ini</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
