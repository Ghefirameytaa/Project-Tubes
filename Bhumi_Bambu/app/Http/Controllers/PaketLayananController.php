<?php
namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaketLayananController extends Controller
{
    /* =======================
        TAMPILKAN DATA
    ======================== */
    public function index()
    {
        $paketLayanan = PaketLayanan::all();
        return view('paketlayanan.index', compact('paketLayanan'));
    }

    /* =======================
        FORM TAMBAH
    ======================== */
    public function create()
    {
        return view('paketlayanan.create');
    }

    /* =======================
        SIMPAN DATA
    ======================== */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket'     => 'required',
            'kategori_paket' => 'required',
            'deskripsi'      => 'required',
            'harga_paket'    => 'required|numeric',
            'durasi'         => 'required',
            'status_paket'   => 'required',
            'detail_venue'   => 'required',
            'gambar_venue'   => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->all();
        $data['id_admin'] = Auth::id();

        // upload gambar
        if ($request->hasFile('gambar_venue')) {
            $data['gambar_venue'] = $request->file('gambar_venue')
                ->store('paket_layanan', 'public');
        }

        PaketLayanan::create($data);

        return redirect()
            ->route('paket-layanan.index')
            ->with('success', 'Paket layanan berhasil ditambahkan');
    }

    /* =======================
        FORM EDIT
    ======================== */
    public function edit($id_paket)
    {
        $paket = PaketLayanan::findOrFail($id_paket);
        return view('paketlayanan.edit', compact('paket'));
    }

    /* =======================
        UPDATE DATA
    ======================== */
    public function update(Request $request, $id_paket)
    {
        $paket = PaketLayanan::findOrFail($id_paket);

        $request->validate([
            'nama_paket'     => 'required',
            'kategori_paket' => 'required',
            'deskripsi'      => 'required',
            'harga_paket'    => 'required|numeric',
            'durasi'         => 'required',
            'status_paket'   => 'required',
            'detail_venue'   => 'required',
            'gambar_venue'   => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->all();

        // update gambar
        if ($request->hasFile('gambar_venue')) {
            if ($paket->gambar_venue) {
                Storage::disk('public')->delete($paket->gambar_venue);
            }

            $data['gambar_venue'] = $request->file('gambar_venue')
                ->store('paket_layanan', 'public');
        }

        $paket->update($data);

        return redirect()
            ->route('paket-layanan.index')
            ->with('success', 'Paket layanan berhasil diperbarui');
    }

    /* =======================
        HAPUS DATA
    ======================== */
    public function destroy($id_paket)
    {
        $paket = PaketLayanan::findOrFail($id_paket);

        if ($paket->gambar_venue) {
            Storage::disk('public')->delete($paket->gambar_venue);
        }

        $paket->delete();

        return redirect()
            ->route('paket-layanan.index')
            ->with('success', 'Paket layanan berhasil dihapus');
    }
}
