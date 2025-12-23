<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['pelanggan', 'paket'])->orderByDesc('id')->get();
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();
        $paket = PaketLayanan::orderBy('nama_paket')->get();

        return view('pesanan.index', compact('pesanan', 'pelanggan', 'paket'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_paket' => 'required|exists:paket_layanan,id',
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'tanggal_pesanan' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'status_pesanan' => 'required|in:Berhasil,Menunggu,Dibatalkan',
        ]);

        Pesanan::create($data);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $data = $request->validate([
            'id_paket' => 'required|exists:paket_layanan,id',
            'id_pelanggan' => 'required|exists:pelanggan,id',
            'tanggal_pesanan' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'status_pesanan' => 'required|in:Berhasil,Menunggu,Dibatalkan',
        ]);

        $pesanan->update($data);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
