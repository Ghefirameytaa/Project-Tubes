<?php

namespace App\Http\Controllers;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::with('pemesanan')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemesanan = Pemesanan::all();
        return view('pembayaran.create', compact('pemesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'jumlah_bayar' => 'required|integer',
            'status_pembayaran' => 'required|string',
        ]);
        Pembayaran::create($request->all());
        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil ditambahkan.');

    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pemesanan = Pemesanan::all();
        return view('pembayaran.edit', compact('pembayaran', 'pemesanan'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanan,id',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'jumlah_bayar' => 'required|integer',
            'status_pembayaran' => 'required|string',
        ]);
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());
        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil dihapus.');
    }
}

