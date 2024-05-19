<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Tindakan;

class rekaptindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index(Request $request)
    {
        $tindakan = $request->input('tindakan');
$bulan = $request->input('bulan');
$tahun = $request->input('tahun');

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
        $no = 1;
        $pasien = Pasien::get();
        $periksa = Pemeriksaan::with('pasien')->get();
        $resep_obat = Obat::get();
        $datatindakan = Tindakan::get();
        // Mengambil data pemeriksaan dengan mengurutkan berdasarkan waktu pembuatan secara descending
            $query = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc');

    if ($tindakan) {
        // $query->whereJsonContains('tindakan', ['infus']);
        $query->whereJsonContains('tindakan', [$tindakan]);
    }

    if ($bulan) {
        $query->whereMonth('tgl_kunjungan', $bulan);

    }

    if ($tahun) {
        $query->whereYear('tgl_kunjungan', $tahun);

    }
    $kunjungan = $query->get();


foreach ($kunjungan as $data) {
if ($tindakan) {
    $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', [$tindakan])->get();
}else{
    //  $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();
    $harga = Tindakan::get();
}
    // $data->total_harga_tindakan = 0;
    $hargatindakan = [];
    $namatindakan = [];
    foreach ($harga as $item) {
        $namatindakan[] = $item->nama_tindakan;
        if ($data->askes == "Dana_Sehat") {
            if ($item->nama_tindakan == "periksa" || $item->nama_tindakan == "pemeriksaan dan konsultasi") {
                $hargatindakan[] = 0;
                // $data->total_harga_tindakan += 0;
            } else {
                $hargatindakan[] = $item->harga;
                // $data->total_harga_tindakan += $item->harga;
            }
        } else {
            $hargatindakan[] = $item->harga;
            // $data->total_harga_tindakan += $item->harga;
        }

    }
    $data->hargatindakan = $hargatindakan;
    $data->namatindakan = $namatindakan;
}

        return view('pages.rekaptindakan', compact('kunjungan', 'no', 'pasien', 'resep_obat', 'periksa', 'datatindakan', 'listbulan'));
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
 public function cetakrekaptindakan(Request $request)
    {
        $tindakan = $request->input('tindakan');
$bulan = $request->input('bulan');
$tahun = $request->input('tahun');

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
        $no = 1;
        $pasien = Pasien::get();
        $periksa = Pemeriksaan::with('pasien')->get();
        $resep_obat = Obat::get();
        $datatindakan = Tindakan::get();
        // Mengambil data pemeriksaan dengan mengurutkan berdasarkan waktu pembuatan secara descending
            $query = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc');

    if ($tindakan) {
        // $query->whereJsonContains('tindakan', ['infus']);
        $query->whereJsonContains('tindakan', [$tindakan]);
    }

    if ($bulan) {
        $query->whereMonth('tgl_kunjungan', $bulan);

    }

    if ($tahun) {
        $query->whereYear('tgl_kunjungan', $tahun);

    }
    $kunjungan = $query->get();


foreach ($kunjungan as $data) {
if ($tindakan) {
    $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', [$tindakan])->get();
}else{
    //  $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();
    $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();
}
    // $data->total_harga_tindakan = 0;
    $hargatindakan = [];
    $namatindakan = [];
    foreach ($harga as $item) {
        $namatindakan[] = $item->nama_tindakan;
        if ($data->askes == "Dana_Sehat") {
            if ($item->nama_tindakan == "periksa" || $item->nama_tindakan == "pemeriksaan dan konsultasi") {
                $hargatindakan[] = 0;
                // $data->total_harga_tindakan += 0;
            } else {
                $hargatindakan[] = $item->harga;
                // $data->total_harga_tindakan += $item->harga;
            }
        } else {
            $hargatindakan[] = $item->harga;
            // $data->total_harga_tindakan += $item->harga;
        }

    }
    $data->hargatindakan = $hargatindakan;
    $data->namatindakan = $namatindakan;
}

        return view('pages.cetakrekaptindakan', compact('kunjungan', 'no', 'pasien', 'resep_obat', 'periksa', 'datatindakan', 'listbulan'));
    }

}
