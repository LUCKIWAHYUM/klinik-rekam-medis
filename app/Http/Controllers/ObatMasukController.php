<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\obatmasuk;
use App\Models\Obat;


class ObatMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obatmasuk = obatmasuk::with('obat')->get();
        $obat = Obat::get();
        $no = 1;
        return view('pages.obatmasuk',compact('obatmasuk','obat','no'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
        $obat = obatmasuk::create($request->all());
$obat = Obat::find($request['id_obat']);

// Memperbarui stok obat
if ($obat) {
    $obat->stok += $request['jumlah']; // Menambah stok obat
    $obat->save(); // Menyimpan perubahan stok ke database
} else {
    // Tindakan jika obat tidak ditemukan (opsional)
}

        \Log::info('Stok obat berhasil ditambahkan: ' . $obat->nama_obat); // Tambahkan pernyataan log
        return redirect()->route('obatmasuk.index')->with('success', 'Stok obat "' . $obat->nama_obat . '" berhasil ditambahkan.');
    } catch (\Exception $e) {
        \Log::error('Gagal menambahkan stok obat: ' . $e->getMessage()); // Tambahkan pernyataan log
        // Tangkap pengecualian dan tampilkan pesan kesalahan
        return redirect()->route('obatmasuk.index')->with('error', 'Gagal menambahkan stok obat: ' . $e->getMessage());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
