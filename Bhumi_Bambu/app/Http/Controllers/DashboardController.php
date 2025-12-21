<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Pemesanan;

class DashboardController extends Controller
{
    public function index()
    {
        // Tanggal dari query string, default hari ini
        $tanggal = request()->get('tanggal', date('Y-m-d'));

        // Statistik kartu
        $acaraBerlangsung = Acara::where('status', 'berlangsung')->count();
        $acaraSelesai = Acara::where('status', 'selesai')->count();
        $menungguKonfirmasi = Pemesanan::where('status_pemesanan', 'menunggu')->count();

        // Venue terpakai default 0
        $venueTerpakai = 0;

        // Detail pelanggan
        $detailPelanggan = Pemesanan::with(['paket', 'pelanggan'])
            ->whereDate('tanggal_pemesanan', $tanggal)
            ->get()
            ->map(function ($item) {
                return [
                    'nama_paket' => $item->paket->nama ?? '-',
                    'nama_pelanggan' => $item->pelanggan->nama_pelanggan ?? '-',
                    'tanggal_acara' => $item->tanggal_acara,
                    'waktu_mulai' => $item->waktu_mulai ?? '-',
                    'total_harga' => $item->total_harga ?? '-',
                    'venue' => $item->venue ?? '-',
                    'status' => $item->status,
                    'status_label' => ucfirst($item->status),
                ];
            });

        return view('dashboard', compact(
            'acaraBerlangsung',
            'acaraSelesai',
            'menungguKonfirmasi',
            'venueTerpakai',
            'detailPelanggan',
            'tanggal'
        ));
    }
}
