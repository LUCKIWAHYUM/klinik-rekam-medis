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
                ->where('pembelian', 'apotek')
                ->where('id_obat', $namaobat);


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
$totalobat = $query->select('jumlah')->count();

        return view('pages.rekapobat', compact('no', 'Obat', 'listbulan','nameobat','totalobat'));

    }
    public function cetakrekapobat(Request $request)
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
// dd($Obat);
        return view('pages.cetakrekapobat', compact('no', 'Obat', 'listbulan','nameobat'));

    }
}
