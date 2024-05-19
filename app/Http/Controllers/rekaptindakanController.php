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
        '12' => 'Desember'
    ];
    $no = 1;
    $pasien = Pasien::get();
    $periksa = Pemeriksaan::with('pasien')->get();
    $resep_obat = Obat::get();
    $datatindakan = Tindakan::get();

    // Mengambil data pemeriksaan dengan mengurutkan berdasarkan waktu pembuatan secara descending
    $query = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc');

    if ($tindakan) {
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
        $hargatindakan = [];

        if ($data->tindakan && is_array($data->tindakan)) {
            foreach ($data->tindakan as $nama_tindakan) {
                $item = Tindakan::where('nama_tindakan', $nama_tindakan)->first();
                if ($item) {
                    if ($data->pasien->askes == "Dana_Sehat" && ($nama_tindakan == "periksa" || $nama_tindakan == "pemeriksaan dan konsultasi")) {
                        $hargatindakan[$nama_tindakan] = 0;
                    } else {
                        $hargatindakan[$nama_tindakan] = $item->harga;
                    }
                }
            }
        }

        $data->hargatindakan = $hargatindakan;
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
            $hargatindakan = [];

            if ($data->tindakan && is_array($data->tindakan)) {
                foreach ($data->tindakan as $nama_tindakan) {
                    $item = Tindakan::where('nama_tindakan', $nama_tindakan)->first();
                    if ($item) {
                        if ($data->pasien->askes == "Dana_Sehat" && ($nama_tindakan == "periksa" || $nama_tindakan == "pemeriksaan dan konsultasi")) {
                            $hargatindakan[$nama_tindakan] = 0;
                        } else {
                            $hargatindakan[$nama_tindakan] = $item->harga;
                        }
                    }
                }
            }

            $data->hargatindakan = $hargatindakan;
        }


        return view('pages.cetakrekaptindakan', compact('kunjungan', 'no', 'pasien', 'resep_obat', 'periksa', 'datatindakan', 'listbulan'));
    }

}
