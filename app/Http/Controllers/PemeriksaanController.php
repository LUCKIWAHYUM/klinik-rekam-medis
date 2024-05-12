<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Tindakan;
class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $no = 1;
    $dokter = User::where('role','dokter')
        ->where('status','aktif')->get();
    $pasien = Pasien::get();
    $tindakan = Tindakan::get();
    $kunjungan = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc')->get();
    return view('pages.pemeriksaan',compact('kunjungan','no','dokter','pasien','tindakan'));
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

        return redirect()->route('pemeriksaan.index');
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

            // Dapatkan nama pasien yang terkait dengan pemeriksaan
            $nama_pasien = $pemeriksaan->pasien->nama_pasien;

            // Berikan pesan bahwa foto fisik telah berhasil dimasukkan sesuai dengan nama pasien
            return redirect()->route('pemeriksaan.index')->with('success', 'Pasien ' . $nama_pasien . ' telah diperiksa oleh perawat dan berhasil memasukkan foto fisik.');
        } else {
            $pemeriksaan->update($request->all());

            // Dapatkan nama pasien yang terkait dengan pemeriksaan
            $nama_pasien = $pemeriksaan->pasien->nama_pasien;

            // Berikan pesan bahwa pasien telah diperiksa oleh perawat
            return redirect()->route('pemeriksaan.index')->with('success', 'Pasien ' . $nama_pasien . ' telah diperiksa oleh perawat.');
        }
    } catch (\Exception $e) {
        // Tangkap pengecualian dan tampilkan pesan kesalahan
        return redirect()->route('pemeriksaan.index')->with('error', 'Gagal memperbarui pemeriksaan: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pemeriksaan::findOrFail($id);
        $data->delete();

        return redirect()->route('pemeriksaan.index');
    }
}