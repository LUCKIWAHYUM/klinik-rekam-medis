<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Obat;

class rekapobatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $listbulan = [
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'];

        $namaobat = $request->input('obat_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $no = 1;
        $nameobat = Obat::get();
$query = Resep::with(['periksa', 'periksa.pasien', 'obat'])
                ->where('pembelian', 'apotek');

if ($namaobat) {
    $query->where('id_obat', $namaobat);
}

if ($bulan) {
    $query->whereHas('periksa', function($q) use ($bulan) {
        $q->whereMonth('tgl_kunjungan', $bulan);
    });
}

if ($tahun) {
    $query->whereHas('periksa', function($q) use ($tahun) {
        $q->whereYear('tgl_kunjungan', $tahun);
    });
}

$Obat = $query->get();

        return view('pages.rekapobat', compact('no', 'Obat', 'listbulan','nameobat'));

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
        //
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
