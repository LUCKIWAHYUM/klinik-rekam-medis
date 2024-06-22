<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Tindakan;
use App\Models\Penyakit;
use App\Models\Obat;


class PemeriksaandokterController extends Controller
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
        $tindakan = Tindakan::get();
        $penyakit = Penyakit::get();
        $kunjungan = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc')->get();
        $resep_obat = Obat::get();
        // print_r($kunjungan[0]); die();
        return view('pages.pemeriksaandokter', compact('kunjungan', 'no', 'dokter', 'pasien', 'tindakan', 'penyakit', 'resep_obat'));
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
        $data = $request->all();
        Pemeriksaan::create($data);

        return redirect()->route('pemeriksaandokter.index');
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
        try {
            $pemeriksaan = Pemeriksaan::findOrFail($id);

            if ($request->hasFile('foto')) {
                $data = $request->all();
                $data['foto'] = $request->file('foto')->store('assets/foto_fisik', 'public');
                $pemeriksaan->update($data);
            } else {
                $pemeriksaan->update($request->all());
            }

            // Dapatkan nama pasien yang terkait dengan pemeriksaan
            $nama_pasien = $pemeriksaan->pasien->nama_pasien;

            // Berikan pesan bahwa pasien telah selesai diperiksa oleh dokter
            return redirect()->route('pemeriksaandokter.index')->with('success', 'Pasien ' . $nama_pasien . ' telah selesai diperiksa oleh dokter.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('pemeriksaandokter.index')->with('error', 'Gagal memperbarui pemeriksaan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pemeriksaan::findOrFail($id);
        $data->delete();

        return redirect()->route('pemeriksaandokter.index');
    }
}
