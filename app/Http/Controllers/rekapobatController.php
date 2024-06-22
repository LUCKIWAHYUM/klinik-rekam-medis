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

        $namaobat = $request->input('obat_id','obat.satuan');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $no = 1;
        $nameobat = Obat::get();
$query = Resep::select('obat.nama_obat', 'obat.satuan', \DB::raw('count(*) as totalobat'), \DB::raw('sum(jumlah) as totalterjual'))
                ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
                ->where('pembelian', 'apotek')
                ->groupBy('id_obat', 'obat.satuan');


if ($bulan) {
    $query->whereMonth('resepobat.created_at', $bulan);
}

if ($tahun) {
    $query->whereYear('resepobat.created_at', $tahun);
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

$namaobat = $request->input('obat_id','obat.satuan');
$bulan = $request->input('bulan');
$tahun = $request->input('tahun');
$no = 1;
$nameobat = Obat::get();
$query = Resep::select('obat.nama_obat','obat.satuan', \DB::raw('count(*) as totalobat'), \DB::raw('sum(jumlah) as totalterjual'))
    ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
    ->where('pembelian', 'apotek')
    ->groupBy('id_obat', 'obat.satuan');

if ($bulan) {
    $query->whereMonth('resepobat.created_at', $bulan);
}

if ($tahun) {
    $query->whereYear('resepobat.created_at', $tahun);
}

$Obat = $query->get();
$totalobat = $query->select('jumlah')->count();

        return view('pages.cetakrekapobat', compact('no', 'Obat', 'listbulan','nameobat','totalobat'));

    }
}
