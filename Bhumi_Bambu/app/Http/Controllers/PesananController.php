<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\PaketLayanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['paket','pelanggan'])
            ->orderByDesc('id')
            ->get();

        $paket = PaketLayanan::orderBy('nama_paket')->get();
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();

        return view('pesanan.index', compact('pesanan','paket','pelanggan'));
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

        $data['nama_pemesan'] = Pelanggan::where('id', $data['id_pelanggan'])->value('nama_pelanggan') ?? '-';

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

        $data['nama_pemesan'] = Pelanggan::where('id', $data['id_pelanggan'])->value('nama_pelanggan') ?? '-';

        $pesanan->update($data);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diubah');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }
}
