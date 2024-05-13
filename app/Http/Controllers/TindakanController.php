<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TindakanRequest;
use App\Http\Controllers\TindakanController;
use App\Models\Tindakan;
class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $tindakan = Tindakan::get();

        return view('pages.tindakan', compact(
            'no',
            'tindakan'
            
        ));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TindakanRequest $request)
     {
        try {
            // Simpan data ke database
            Tindakan::create($request->all());
            return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('tindakan.index')->with('error', 'Gagal menambahkan tindakan: ' . $e->getMessage());
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
        $data = Tindakan::find($id); // Mencari data berdasarkan ID
        return view('edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = Tindakan::find($id); // Mencari data berdasarkan ID

            // Validasi input data jika diperlukan
            $request->validate([
                'nama_tindakan' => 'required',
                'harga' => 'required',
                // Tambahkan validasi untuk kolom lain sesuai kebutuhan
            ]);

            // Simpan perubahan data
            $data->nama_tindakan = $request->input('nama_tindakan');
            $data->harga = $request->input('harga');
            // Setel nilai kolom lain sesuai kebutuhan
            $data->save();
           return redirect()->route('tindakan.index')->with('success', 'Data tindakan "' . $data->nama_tindakan . '" berhasil diperbarui.');

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('tindakan.index')->with('error', 'Gagal memperbarui tindakan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Tindakan::findOrFail($id);
            $data->delete();

            return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('tindakan.index')->with('error', 'Gagal menghapus tindakan: ' . $e->getMessage());
        }
    }
}

