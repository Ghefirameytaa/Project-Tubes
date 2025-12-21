<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard Admin</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container mt-4">

    <h4 class="mb-3">Tanggal: {{ $tanggal }}</h4>

    <!-- KARTU STATISTIK -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h6>Acara Berlangsung</h6>
                    <h3>{{ $acaraBerlangsung }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h6>Menunggu Konfirmasi</h6>
                    <h3>{{ $menungguKonfirmasi }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h6>Acara Selesai</h6>
                    <h3>{{ $acaraSelesai }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-dark">
                <div class="card-body">
                    <h6>Venue Terpakai</h6>
                    <h3>{{ $venueTerpakai }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL DETAIL -->
    <div class="card">
        <div class="card-header">
            <strong>Detail Acara Pelanggan</strong>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Paket</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Total</th>
                        <th>Venue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailPelanggan as $item)
                    <tr>
                        <td>{{ $item['nama_paket'] }}</td>
                        <td>{{ $item['nama_pelanggan'] }}</td>
                        <td>{{ $item['tanggal_acara'] }}</td>
                        <td>{{ $item['waktu_mulai'] }}</td>
                        <td>{{ $item['total_harga'] }}</td>
                        <td>{{ $item['venue'] }}</td>
                        <td>
                            <span class="badge bg-{{ $item['status_color'] }}">
                                {{ $item['status_label'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     public function index(Request $request)
//     {
//         // Dummy data supaya view bisa jalan
//         $tanggal = $request->get('tanggal', now()->format('Y-m-d'));

//         $acaraBerlangsung = 0;
//         $menungguKonfirmasi = 0;
//         $acaraSelesai = 0;
//         $venueTerpakai = 0;

//         $detailPelanggan = [
//             [
//                 'nama_paket' => 'Paket A',
//                 'nama_pelanggan' => 'John Doe',
//                 'tanggal_acara' => date('d F Y'),
//                 'waktu_mulai' => '10.00 WIB',
//                 'total_harga' => 'Rp1.000.000',
//                 'venue' => 'Bhumi Bambu 1',
//                 'status' => 'berlangsung',
//                 'status_label' => 'Berlangsung',
//                 'status_color' => 'primary',
//             ],
//             [
//                 'nama_paket' => 'Paket B',
//                 'nama_pelanggan' => 'Jane Doe',
//                 'tanggal_acara' => date('d F Y'),
//                 'waktu_mulai' => '13.00 WIB',
//                 'total_harga' => 'Rp2.000.000',
//                 'venue' => 'Bhumi Bambu 2',
//                 'status' => 'menunggu',
//                 'status_label' => 'Menunggu',
//                 'status_color' => 'warning',
//             ],
//         ];

//         return view('dashboard', compact(
//             'tanggal',
//             'acaraBerlangsung',
//             'menungguKonfirmasi',
//             'acaraSelesai',
//             'venueTerpakai',
//             'detailPelanggan'
//         ));

        
//     }
// }
