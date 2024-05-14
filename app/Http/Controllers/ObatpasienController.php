<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Resep;

class ObatpasienController extends Controller
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
    $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'resepobat.pembelian as pembelian', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
        ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
        ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
        ->orderByDesc('pemeriksaan.tgl_kunjungan') // Urutkan berdasarkan tanggal kunjungan secara descending
        ->orderByDesc('pemeriksaan.waktu_kunjungan') // Urutkan berdasarkan waktu kunjungan secara descending
        ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pembelian', 'pemeriksaan.status', 'resepobat.status', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
        ->get();

    return view('pages.obatpasien', compact('kunjungan', 'no', 'dokter', 'pasien', 'resep_obat', 'periksa'));
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
        // dd($request['pembelian']);
        try{
        foreach ($request['id_obat'] as $index => $id_obat) {
            $aturanpakai = (string) $request['aturanpakai'][$index];
            $deskripsi = $request['deskripsi'][$index];

                // Simpan ke database sesuai kebutuhan Anda
                Resep::create([
                    'id_periksa' => $request['id_periksa'],
                    'pembelian' => $request['pembelian'],
                    'status' => $request['status'],
                    'deskripsi' => (string) $deskripsi,
                    'aturanpakai' => (string) $aturanpakai,
                    'id_obat' => (string) $id_obat,
                ]);
}
        // Pemeriksa::create($data);

        return redirect()->route('obatpasien.index');
    }catch(\Exception $e){
        dd($e);
    }
    }


public function update(Request $request, $id)
{
    try {
        // Temukan resep berdasarkan id_periksa
        $resep = Resep::where('id_periksa', $id)->firstOrFail();

        // Lakukan pembaruan pada atribut yang diperlukan
        $resep->update($request->all());

        // Perbarui semua entri dengan id_periksa yang sama jika status adalah 'selesai'
        if ($request->status === 'sudah diambil') {
            Resep::where('id_periksa', $id)->update(['status' => 'sudah diambil']);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('obatpasien.index')->with('success', 'Resep updated successfully');
    } catch (\Exception $e) {
        // Tangkap pengecualian dan tampilkan pesan kesalahan
        return redirect()->route('obatpasien.index')->with('error', 'Failed to update resep: ' . $e->getMessage());
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
