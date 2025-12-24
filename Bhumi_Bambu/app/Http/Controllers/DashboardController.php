<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acara;
use App\Models\Pemesanan;
use App\Models\Venue;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin
     */
    public function index(Request $request)
    {
        // Ambil tanggal dari query string, default hari ini
        $tanggal = $request->get('tanggal', date('Y-m-d'));

        // Statistik kartu
        $acaraBerlangsung = Acara::where('status', 'berlangsung')
            ->whereDate('tanggal', $tanggal)
            ->count();

        $menungguKonfirmasi = Pemesanan::where('status_pemesanan', 'menunggu')
            ->whereDate('tanggal_pemesanan', $tanggal)
            ->count();

        $acaraSelesai = Acara::where('status', 'selesai')
            ->whereDate('tanggal', $tanggal)
            ->count();

        $venueTerpakai = 0; // default

        // Detail pelanggan
        $detailPelanggan = Pemesanan::with(['acara', 'pelanggan', 'venue'])
            ->whereDate('tanggal_pemesanan', $tanggal)
            ->get()
            ->map(function($item) {
                return [
                    'nama_paket' => $item->acara->nama_paket ?? '-',
                    'nama_pelanggan' => $item->pelanggan->nama ?? '-',
                    'tanggal_acara' => $item->tanggal_acara,
                    'waktu_mulai' => $item->waktu_mulai,
                    'total_harga' => $item->total_harga,
                    'venue' => $item->venue->nama ?? '-',
                    'status' => $item->status,
                    'status_label' => ucfirst($item->status),
                ];
            });

        // Kirim data ke view
        return view('dashboard', compact(
            'acaraBerlangsung',
            'menungguKonfirmasi',
            'acaraSelesai',
            'venueTerpakai',
            'detailPelanggan',
            'tanggal'
        ));
    }
}
