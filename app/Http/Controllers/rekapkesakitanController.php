<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;


class rekapkesakitanController extends Controller
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

        // $namaobat = $request->input('obat_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $no = 1;
      $query = Pemeriksaan::select('diagnosa', DB::raw('count(*) as total'))
        ->groupBy('diagnosa')
         ->orderBy('total', 'desc'); // Urutkan berdasarkan total dari yang terbesar ke yang terkecil


        if ($bulan) {
            $query->whereMonth('tgl_kunjungan', $bulan);

        }

        if ($tahun) {
            $query->whereYear('tgl_kunjungan', $tahun);

        }

    $periksa = $query->get();
    $total = $query->count();
        return view('pages.rekapkesakitan', compact('no', 'listbulan','periksa','total'));

    }
    public function cetakrekapsakit(Request $request)
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

// $namaobat = $request->input('obat_id');
$bulan = $request->input('bulan');
$tahun = $request->input('tahun');
$no = 1;
$query = Pemeriksaan::select('diagnosa', DB::raw('count(*) as total'))
    ->groupBy('diagnosa')
     ->orderBy('total', 'desc'); // Urutkan berdasarkan total dari yang terbesar ke yang terkecil

if ($bulan) {
    $query->whereMonth('tgl_kunjungan', $bulan);

}

if ($tahun) {
    $query->whereYear('tgl_kunjungan', $tahun);

}

$periksa = $query->get();
$total = $query->count();

        return view('pages.cetakrekapsakit', compact('no', 'listbulan','periksa','total'));

    }
}
