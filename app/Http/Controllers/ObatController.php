<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ObatRequest;
// use App\Http\Controllers\ObatController;
use App\Models\Obat;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $obat = Obat::get();
        $jumlah_obat = Obat::count();
        return view('pages.obat', compact(
            'no',
            'obat',
            'jumlah_obat'

        ));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    try {
        // Simpan data ke database
        $obat = Obat::create($request->all());

        // Cek stok obat
        if ($obat->stock <= 5) {
            // Jika stok obat tinggal 5 atau kurang, berikan pesan peringatan
            return redirect()->route('obat.index')->with('warning', 'Stok obat "' . $obat->nama_obat . '" tinggal ' . $obat->stock . '. Segera restock obat.');
        }

        return redirect()->route('obat.index')->with('success', 'Obat "' . $obat->nama_obat . '" berhasil ditambahkan.');
    } catch (\Exception $e) {
        // Tangkap pengecualian dan tampilkan pesan kesalahan
        return redirect()->route('obat.index')->with('error', 'Gagal menambahkan obat: ' . $e->getMessage());
    }
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Obat::find($id); // Mencari data berdasarkan ID
        return view('edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $obat = Obat::findOrFail($id);
            $obat->update($request->all());
            return redirect()->route('obat.index')->with('success', 'Data obat "' . $obat->nama_obat . '" berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('obat.index')->with('error', 'Gagal memperbarui data obat: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Obat::findOrFail($id);
            $data->delete();
            return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('obat.index')->with('error', 'Gagal menghapus data obat: ' . $e->getMessage());
        }
    }
}
