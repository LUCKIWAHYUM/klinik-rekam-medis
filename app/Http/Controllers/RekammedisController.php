<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Pasien;
class RekammedisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $dokter = User::where('role','dokter')
            ->where('status','aktif')->get();
        $pasien = Pasien::whereRaw('(SELECT count(*) FROM pemeriksaan WHERE pemeriksaan.pasien_id = pasien.id) > 0')->orderBy('no_rmd', 'DESC')->get();
        // Ambil data kunjungan dengan urutan berdasarkan waktu pembuatan, dimulai dari yang terbaru
        $kunjungan = Pemeriksaan::select('pemeriksaan.*', 'pasien.no_rmd', 'pasien.nama_pasien')
            ->leftJoin('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->orderBy('pemeriksaan.created_at', 'desc') // atau kolom lain yang menunjukkan waktu terbaru
            ->distinct('pasien.no_rmd')
            ->get();
        return view('pages.rekammedis',compact('kunjungan','no','dokter','pasien'));
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

        return redirect()->route('rekammedis.index');
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

            return redirect()->route('rekammedis.index')->with('success', 'User updated successfully');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pemeriksaan::findOrFail($id);
        $data->delete();

        return redirect()->route('rekammedis.index');
    }
}

