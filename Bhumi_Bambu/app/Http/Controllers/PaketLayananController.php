<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;

class PaketLayananController extends Controller
{
    public function index()
    {
        $data = PaketLayanan::latest()->paginate(10);
        return view('paketlayanan.index', compact('data'));
    }

    public function create()
    {
        return view('paketlayanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket'   => 'required|string|max:255',
            'venue'        => 'required|string|max:255',
            'harga'        => 'required|string|max:255',
            'fasilitas'    => 'required|string|max:255',
            'deskripsi'    => 'required|string|max: 255',
            'kapasitas'    => 'required|integer|min:1',
            'gambar_venue' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // ✅ upload ke public/aset/gambarPaket
        $file = $request->file('gambar_venue');
        $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $tujuan = public_path('aset/gambarPaket');
        if (!is_dir($tujuan)) {
            mkdir($tujuan, 0755, true);
        }

        $file->move($tujuan, $namaFile);

        // ✅ simpan path relatif ke DB (buat asset())
        $pathDb = 'aset/gambarPaket/' . $namaFile;

        PaketLayanan::create([
            'nama_paket'   => $validated['nama_paket'],
            'venue'        => $validated['venue'],
            'harga'        => $validated['harga'],
            'fasilitas'    => $validated['fasilitas'],
            'deskripsi'    => $validated['deskripsi'],
            'kapasitas'    => $validated['kapasitas'],
            'gambar_venue' => $pathDb,
        ]);

        return redirect()->route('paket-layanan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(PaketLayanan $paketLayanan)
    {
        return view('paketlayanan.edit', compact('paketLayanan'));
    }

    public function update(Request $request, PaketLayanan $paketLayanan)
    {
        $validated = $request->validate([
            'nama_paket'   => 'required|string|max:255',
            'venue'        => 'required|string|max:255',
            'harga'        => 'required|string|max:255',
            'fasilitas'    => 'required|string|max:255',
            'deskripsi'    => 'required|string|max:255',
            'kapasitas'    => 'required|integer|min:1',
            'gambar_venue' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $updateData = [
            'nama_paket' => $validated['nama_paket'],
            'venue'      => $validated['venue'],
            'harga'      => $validated['harga'],
            'fasilitas'  => $validated['fasilitas'],
            'deskripsi'  => $validated['deskripsi'],
            'kapasitas'  => $validated['kapasitas'],
        ];

        if ($request->hasFile('gambar_venue')) {
            // hapus gambar lama
            if (!empty($paketLayanan->gambar_venue)) {
                $oldPath = public_path($paketLayanan->gambar_venue); // DB simpan 'aset/...'
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('gambar_venue');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $tujuan = public_path('aset/gambarPaket');
            if (!is_dir($tujuan)) {
                mkdir($tujuan, 0755, true);
            }

            $file->move($tujuan, $namaFile);

            $updateData['gambar_venue'] = 'aset/gambarPaket/' . $namaFile;
        }

        $paketLayanan->update($updateData);

        return redirect()->route('paket-layanan.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(PaketLayanan $paketLayanan)
    {
        if (!empty($paketLayanan->gambar_venue)) {
            $oldPath = public_path($paketLayanan->gambar_venue);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $paketLayanan->delete();

        return redirect()->route('paket-layanan.index')->with('success', 'Data berhasil dihapus.');
    }
}
