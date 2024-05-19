<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Resep;

class ResepobatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $dokter = User::where('role', 'dokter')
            ->where('status', 'aktif')->get();
        $pasien = Pasien::get();
        $periksa = Pemeriksaan::with('pasien')->get();
        $resep_obat = Obat::get();
        // Mengambil data pemeriksaan dengan mengurutkan berdasarkan waktu pembuatan secara descending
        $kunjungan = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc')->get();
        return view('pages.resepobat', compact('kunjungan', 'no', 'dokter', 'pasien', 'resep_obat', 'periksa'));
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
        // var_dump($request); die();
        try {
            foreach ($request['id_obat'] as $index => $id_obat) {
                $aturanpakai = (string) $request['aturanpakai'][$index];
                $deskripsi = $request['deskripsi'][$index];
                $jumlah = $request['jumlah'][$index];


                if($request['pembelian'] == 'sendiri')
                $status = 'sudah diambil';
                else
                $status = $request['status'];
                // Simpan ke database resep
                Resep::create([
                    'id_periksa' => $request['id_periksa'],
                    'pembelian' => $request['pembelian'],
                    'status' => $status,
                    'deskripsi' => (string) $deskripsi,
                    'jumlah' => (string) $jumlah,
                    'aturanpakai' => (string) $aturanpakai,
                    'id_obat' => (string) $id_obat,
                ]);

              // Kurangi stok obat di table obat
$obat = Obat::find($id_obat); // Cari obat berdasarkan id_obat
if ($obat) {
    // Pastikan jumlah yang diinputkan tidak melebihi stok yang tersedia
    if ($obat->stok >= $jumlah) {
        // Kurangi stok obat sebanyak jumlah yang diinputkan
        $obat->stok -= $jumlah;

        // Simpan perubahan stok ke database
        $obat->save();
    } else {
        // Handle jika jumlah yang diinputkan melebihi stok yang tersedia
        // Misalnya: throw new Exception("Stok obat tidak mencukupi untuk jumlah yang diminta");
    }
} else {
    // Handle jika obat tidak ditemukan (opsional)
    // Misalnya: throw new Exception("Obat dengan ID $id_obat tidak ditemukan");
}

            }

            return redirect()->route('resepobat.index');
        } catch (\Exception $e) {
            dd($e);
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

    public function update(Request $request, $id)
    {
        $user = Pemeriksaan::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('resepobat.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
$datas = Resep::where('id_periksa', $id)->get(); // Menggunakan where untuk mencari semua data berdasarkan ID periksa
foreach ($datas as $data) {
    $data->delete(); // Menghapus data satu per satu
}



        return redirect()->route('resepobat.index');
    }
}
