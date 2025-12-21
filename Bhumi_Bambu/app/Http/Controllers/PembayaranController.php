<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     * MENAMPILKAN LIST PEMBAYARAN
     */
    public function index(Request $request)
    {
        // Ambil semua data pembayaran, urutkan dari yang terbaru
        $query = Pembayaran::query();

        // Filter berdasarkan status (kalau ada)
        if ($request->has('status') && $request->status != '') {
            $status = $request->status;
            $query->where(function($q) use ($status) {
                if ($status == 'pending') {
                    $q->where('status_pembayaran', 'pending')
                      ->orWhere('status_pembayaran', 'Menunggu');
                } elseif ($status == 'approved') {
                    $q->where('status_pembayaran', 'approved')
                      ->orWhere('status_pembayaran', 'Berhasil');
                } elseif ($status == 'rejected') {
                    $q->where('status_pembayaran', 'rejected')
                      ->orWhere('status_pembayaran', 'Dibatalkan');
                }
            });
        }

        // Search (kalau ada)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('nama_pengirim', 'like', "%{$search}%");
            });
        }

        // Ambil data
        $pembayaran = $query->latest()->get();
        
        // Kirim ke view
        return view('Pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     * HALAMAN FORM TAMBAH PEMBAYARAN
     */
    public function create()
    {
        $pemesanan = Pemesanan::all();
        return view('Pembayaran.create', compact('pemesanan'));
    }

    /**
     * Store a newly created resource in storage.
     * PROSES SIMPAN DATA PEMBAYARAN KE DATABASE
     */
    public function store(Request $request)
    {
        // Log untuk debugging
        Log::info('Store pembayaran dipanggil', $request->all());

        // Validasi input
        $validated = $request->validate([
            'id_pemesanan' => 'required|integer|min:1',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'nama_bank' => 'nullable|string|max:255',
            'nama_pengirim' => 'nullable|string|max:255',
            'jumlah_bayar' => 'required|integer|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_pembayaran' => 'required|string',
        ]);

        try {
            // Siapkan data untuk disimpan
            $data = [
                'id_pemesanan' => $request->id_pemesanan,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nama_bank' => $request->nama_bank,
                'nama_pengirim' => $request->nama_pengirim,
                'jumlah_bayar' => $request->jumlah_bayar,
                'status_pembayaran' => $request->status_pembayaran,
            ];

            // Upload bukti pembayaran (kalau ada)
            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bukti-pembayaran', $filename, 'public');
                $data['bukti_pembayaran'] = $path;
                
                Log::info('File uploaded', ['path' => $path]);
            }

            // Simpan ke database
            $pembayaran = Pembayaran::create($data);
            
            Log::info('Pembayaran berhasil disimpan', ['id' => $pembayaran->id]);
            
            // Redirect ke halaman list dengan pesan sukses
            return redirect('/pembayaran')
                ->with('success', 'Pembayaran berhasil ditambahkan! ID: ' . $pembayaran->id);
            
        } catch (\Exception $e) {
            Log::error('Error menyimpan pembayaran: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            return view('Pembayaran.show', compact('pembayaran'));
        } catch (\Exception $e) {
            return redirect('/pembayaran')->with('error', 'Data tidak ditemukan.');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            $pemesanan = Pemesanan::all();
            return view('Pembayaran.edit', compact('pembayaran', 'pemesanan'));
        } catch (\Exception $e) {
            return redirect('/pembayaran')->with('error', 'Data tidak ditemukan.');
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pemesanan' => 'required|integer|min:1',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'nama_bank' => 'nullable|string|max:255',
            'nama_pengirim' => 'nullable|string|max:255',
            'jumlah_bayar' => 'required|integer|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_pembayaran' => 'required|string',
        ]);

        try {
            $pembayaran = Pembayaran::findOrFail($id);
            
            $data = [
                'id_pemesanan' => $request->id_pemesanan,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
                'metode_pembayaran' => $request->metode_pembayaran,
                'nama_bank' => $request->nama_bank,
                'nama_pengirim' => $request->nama_pengirim,
                'jumlah_bayar' => $request->jumlah_bayar,
                'status_pembayaran' => $request->status_pembayaran,
            ];

            // Upload bukti pembayaran baru (kalau ada)
            if ($request->hasFile('bukti_pembayaran')) {
                // Hapus file lama
                if ($pembayaran->bukti_pembayaran) {
                    Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
                }

                $file = $request->file('bukti_pembayaran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bukti-pembayaran', $filename, 'public');
                $data['bukti_pembayaran'] = $path;
            }

            $pembayaran->update($data);
            
            return redirect('/pembayaran')->with('success', 'Pembayaran berhasil diperbarui.');
            
        } catch (\Exception $e) {
            Log::error('Error updating pembayaran: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);
            
            // Hapus file bukti pembayaran
            if ($pembayaran->bukti_pembayaran) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }

            $pembayaran->delete();

            return redirect('/pembayaran')->with('success', 'Pembayaran berhasil dihapus.');
            
        } catch (\Exception $e) {
            Log::error('Error deleting pembayaran: ' . $e->getMessage());
            
            return redirect('/pembayaran')->with('error', 'Gagal menghapus pembayaran.');
        }
    }

    /**
     * Verify payment (approve or reject)
     */
    public function verify(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Berhasil,Dibatalkan,approved,rejected',
            'catatan_admin' => 'nullable|string',
        ]);

        try {
            $pembayaran = Pembayaran::findOrFail($id);

            $pembayaran->update([
                'status_pembayaran' => $request->status_pembayaran,
                'catatan_admin' => $request->catatan_admin,
                'waktu_verifikasi' => now(),
                'verifikasi_oleh' => Auth::id(),
            ]);

            $message = ($request->status_pembayaran == 'Berhasil' || $request->status_pembayaran == 'approved')
                       ? 'Pembayaran berhasil disetujui' 
                       : 'Pembayaran ditolak';

            return redirect('/pembayaran/' . $id)->with('success', $message);
            
        } catch (\Exception $e) {
            Log::error('Error verifying pembayaran: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Gagal memverifikasi pembayaran.');
        }
    }
}
// namespace App\Http\Controllers;
// use App\Models\Pembayaran;
// use App\Models\Pemesanan;
// use Illuminate\Http\Request;
// use Illuminate\Facedes\Auth;

// class PembayaranController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $pembayaran = Pembayaran::with('pemesanan')->get();
//         return view('pembayaran.index', compact('pembayaran'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         $pemesanan = Pemesanan::all();
//         return view('pembayaran.create', compact('pemesanan'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'id_pemesanan' => 'required|exists:pemesanan,id',
//             'tanggal_pembayaran' => 'required|date',
//             'metode_pembayaran' => 'required|string',
//             'jumlah_bayar' => 'required|integer',
//             'status_pembayaran' => 'required|string',
//         ]);
//         Pembayaran::create($request->all());
//         return redirect('/pembayaran')->with('success', 'Pembayaran berhasil ditambahkan.');

//     }
    
//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit($id)
//     {
//         $pembayaran = Pembayaran::findOrFail($id);
//         $pemesanan = Pemesanan::all();
//         return view('pembayaran.edit', compact('pembayaran', 'pemesanan'));
//     }
    
//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'id_pemesanan' => 'required|exists:pemesanan,id',
//             'tanggal_pembayaran' => 'required|date',
//             'metode_pembayaran' => 'required|string',
//             'jumlah_bayar' => 'required|integer',
//             'status_pembayaran' => 'required|string',
//         ]);
//         $pembayaran = Pembayaran::findOrFail($id);
//         $pembayaran->update($request->all());
//         return redirect('/pembayaran')->with('success', 'Pembayaran berhasil diperbarui.');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy($id)
//     {
//         $pembayaran = Pembayaran::findOrFail($id);
//         $pembayaran->delete();

//         return redirect('/pembayaran')->with('success', 'Pembayaran berhasil dihapus.');
//     }
// }

