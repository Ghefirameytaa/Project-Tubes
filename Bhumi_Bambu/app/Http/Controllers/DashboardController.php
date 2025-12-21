<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));

        $acaraBerlangsung = Acara::where('status', 'berlangsung')
            ->whereDate('tanggal_acara', $tanggal)
            ->count();
        
        $menungguKonfirmasi = Acara::where('status', 'menunggu')
            ->whereDate('tanggal_acara', $tanggal)
            ->count();

        $acaraSelesai = Acara::where('status', 'berhasil')
            ->whereDate('tanggal_acara', $tanggal)
            ->count();

        $venueTerpakai = Acara::where('status', '!=', 'dibatalkan')
            ->whereDate('tanggal_acara', $tanggal)
            ->distinct('venue_id')
            ->count('venue_id');

        // Detail pelanggan untuk tanggal yang dipilih
        $detailPelanggan = Acara::with(['paket', 'venue', 'pelanggan'])
            ->whereDate('tanggal_acara', $tanggal)
            ->orderBy('waktu_mulai', 'asc')
            ->get()
            ->map(function($acara) {
                return [
                    'nama_paket' => $acara->paket->nama ?? '-',
                    'nama_pelanggan' => $acara->pelanggan->nama ?? '-',
                    'tanggal_acara' => Carbon::parse($acara->tanggal_acara)->format('d F Y'),
                    'waktu_mulai' => Carbon::parse($acara->waktu_mulai)->format('H.i') . ' WIB',
                    'total_harga' => 'Rp' . number_format($acara->total_harga, 0, ',', '.'),
                    'venue' => $acara->venue->nama ?? '-',
                    'status' => $acara->status,
                    'status_label' => $this->getStatusLabel($acara->status),
                    'status_color' => $this->getStatusColor($acara->status)
                ];
            });
    }

    private function getStatusLabel($status)
    {
        $labels = [
            'berhasil' => 'Berhasil',
            'menunggu' => 'Menunggu',
            'dibatalkan' => 'Dibatalkan',
            'berlangsung' => 'Berlangsung'
        ];
        
        return $labels[$status] ?? $status;
    }
    
    private function getStatusColor($status)
    {
        $colors = [
            'berhasil' => 'success',
            'menunggu' => 'warning',
            'dibatalkan' => 'danger',
            'berlangsung' => 'primary'
        ];
        
        return $colors[$status] ?? 'secondary';
    }
}

