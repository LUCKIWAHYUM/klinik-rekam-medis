<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Http\Controllers\SupplierController;
use App\Models\Supplier;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $supplier = Supplier::get();

        return view('pages.supplier', compact(
            'no',
            'supplier'
            
        ));
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        try {
            // Simpan data ke database
            Supplier::create($request->all());
            return redirect()->route('supplier.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('supplier.index')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
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
        $data = Supplier::find($id); // Mencari data berdasarkan ID
        return view('edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Supplier::find($id); // Mencari data berdasarkan ID

        // Validasi input data jika diperlukan
        $request->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            // Tambahkan validasi untuk kolom lain sesuai kebutuhan
        ]);

        // Simpan perubahan data
        $data->nama_supplier = $request->input('nama_supplier');
        $data->alamat = $request->input('alamat');
        $data->no_telp = $request->input('no_telp');
        // Setel nilai kolom lain sesuai kebutuhan
        $data->save();
        return redirect()->route('supplier.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();

        return redirect()->route('supplier.index');
    }
}
