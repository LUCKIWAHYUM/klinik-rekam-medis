<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $no = 1;
        $kunjungan = Pemeriksaan::select(
            DB::raw('MONTHNAME(tgl_kunjungan) AS nama_bulan'),
            DB::raw('YEAR(tgl_kunjungan) AS tahun'),
            DB::raw('MONTH(tgl_kunjungan) AS bulan')
        )
            ->groupBy('nama_bulan', 'tahun', 'bulan')
            ->get();

        return view('pages.laporan-kunjungan', compact('kunjungan', 'no'));
    }

    public function cetak($bulan, $tahun)
    {
        $periksa = Pemeriksaan::with('pasien')
            ->whereMonth('tgl_kunjungan', $bulan)
            ->whereYear('tgl_kunjungan', $tahun)
            ->get();
        return view('pages.cetakLaporanKunjungan', compact('periksa'));
    }
}
