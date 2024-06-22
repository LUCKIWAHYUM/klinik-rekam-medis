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
            '12' => 'Desember'
        ];

        // $namaobat = $request->input('obat_id');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $no = 1;
        $query = Pemeriksaan::select(
            'diagnosa', 
            DB::raw('count(*) as total'),
            DB::raw('SUM(CASE WHEN pasien.jenis_kelamin = "P" THEN 1 ELSE 0 END) as wanita'),
            DB::raw('SUM(CASE WHEN pasien.jenis_kelamin = "L" THEN 1 ELSE 0 END) as pria'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 0 AND 5 THEN 1 ELSE 0 END) as balita'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 6 AND 11 THEN 1 ELSE 0 END) as anak'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 12 AND 16 THEN 1 ELSE 0 END) as remaja_awal'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 17 AND 25 THEN 1 ELSE 0 END) as remaja_akhir'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 26 AND 35 THEN 1 ELSE 0 END) as dewasa_awal'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 36 AND 45 THEN 1 ELSE 0 END) as dewasa_akhir'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 46 AND 55 THEN 1 ELSE 0 END) as lansia_awal'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 56 AND 65 THEN 1 ELSE 0 END) as lansia_akhir'),
            DB::raw('SUM(CASE WHEN pasien.usia > 65 THEN 1 ELSE 0 END) as manula')
        )
        ->leftJoin('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
        ->groupBy('diagnosa');

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
        $query = Pemeriksaan::select(
            'diagnosa',
            DB::raw('count(*) as total'),
            DB::raw('SUM(CASE WHEN pasien.jenis_kelamin = "P" THEN 1 ELSE 0 END) as wanita'),
            DB::raw('SUM(CASE WHEN pasien.jenis_kelamin = "L" THEN 1 ELSE 0 END) as pria'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 0 AND 5 THEN 1 ELSE 0 END) as balita'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 6 AND 11 THEN 1 ELSE 0 END) as anak'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 12 AND 16 THEN 1 ELSE 0 END) as remaja_awal'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 17 AND 25 THEN 1 ELSE 0 END) as remaja_akhir'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 26 AND 35 THEN 1 ELSE 0 END) as dewasa_awal'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 36 AND 45 THEN 1 ELSE 0 END) as dewasa_akhir'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 46 AND 55 THEN 1 ELSE 0 END) as lansia_awal'),
            DB::raw('SUM(CASE WHEN pasien.usia BETWEEN 56 AND 65 THEN 1 ELSE 0 END) as lansia_akhir'),
            DB::raw('SUM(CASE WHEN pasien.usia > 65 THEN 1 ELSE 0 END) as manula')
        )
        ->leftJoin('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
        ->groupBy('diagnosa');


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
