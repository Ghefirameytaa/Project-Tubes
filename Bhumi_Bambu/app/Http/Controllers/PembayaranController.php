<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('nama_pengirim', 'like', '%' . $request->search . '%');
        }

        $pembayaran = $query->latest()->get();

        return view('Pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $pemesanan = Pemesanan::all();
        return view('Pembayaran.create', compact('pemesanan'));
    }

    public function store(Request $request)
    {
        Log::info('=== STORE PEMBAYARAN ===');
        Log::info('Request data:', $request->all());

        try {
            // ✅ Validasi: terima id_pemesanan dari FORM
            $validated = $request->validate([
                'pemesanan_id' => 'required|integer|min:1',
                'tanggal_pembayaran' => 'required|date',
                'metode_pembayaran' => 'required|string',
                'nama_bank' => 'nullable|string|max:255',
                'nama_pengirim' => 'nullable|string|max:255',
                'jumlah_bayar' => 'required|integer|min:0',
                'status_pembayaran' => 'required|string',
                'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // ✅ MAPPING: form (id_pemesanan) → database (pemesanan_id)
            $data = [
                'pemesanan_id' => $request->pemesanan_id,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nama_bank' => $request->nama_bank,
                'nama_pengirim' => $request->nama_pengirim,
                'jumlah_bayar' => $request->jumlah_bayar,
                'status_pembayaran' => $request->status_pembayaran,
            ];

            Log::info('Data untuk database:', $data);

            // Upload file
            if ($request->hasFile('bukti_pembayaran')) {
                $data['bukti_pembayaran'] = 
                    $request->file('bukti_pembayaran')
                            ->store('bukti-pembayaran', 'public');
                Log::info('File uploaded:', ['path' => $data['bukti_pembayaran']]);
            }

            $pembayaran = Pembayaran::create($data);
            
            Log::info('✅ BERHASIL DISIMPAN! ID:', ['id' => $pembayaran->id]);

            return redirect('/pembayaran')
                ->with('success', 'Pembayaran berhasil ditambahkan! ID: ' . $pembayaran->id);

        } catch (\Exception $e) {
            Log::error('❌ ERROR STORE:', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('Pembayaran.show', compact('pembayaran'));
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pemesanan = Pemesanan::all();

        return view('Pembayaran.edit', compact('pembayaran', 'pemesanan'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'pemesanan_id' => 'required|integer|min:1',
                'tanggal_pembayaran' => 'required|date',
                'metode_pembayaran' => 'required|string',
                'nama_bank' => 'nullable|string|max:255',
                'nama_pengirim' => 'nullable|string|max:255',
                'jumlah_bayar' => 'required|integer|min:0',
                'status_pembayaran' => 'required|string',
                'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $pembayaran = Pembayaran::findOrFail($id);

            $data = [
                'pemesanan_id' => $request->pemesanan_id,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nama_bank' => $request->nama_bank,
                'nama_pengirim' => $request->nama_pengirim,
                'jumlah_bayar' => $request->jumlah_bayar,
                'status_pembayaran' => $request->status_pembayaran,
            ];

            if ($request->hasFile('bukti_pembayaran')) {
                if ($pembayaran->bukti_pembayaran) {
                    Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
                }

                $data['bukti_pembayaran'] = 
                    $request->file('bukti_pembayaran')
                            ->store('bukti-pembayaran', 'public');
            }

            $pembayaran->update($data);

            return redirect('/pembayaran')
                ->with('success', 'Pembayaran berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Update error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();

        return redirect('/pembayaran')
            ->with('success', 'Pembayaran berhasil dihapus');
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Berhasil,Dibatalkan',
            'catatan_admin' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_admin' => $request->catatan_admin,
            'waktu_verifikasi' => now(),
            'verifikasi_oleh' => auth()->id(),
        ]);

        return redirect()->back()
            ->with('success', 'Status pembayaran diperbarui');
    }
}