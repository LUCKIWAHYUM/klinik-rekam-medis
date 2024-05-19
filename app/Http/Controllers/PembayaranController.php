<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Tindakan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $no = 1;
        
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pemeriksaan.tindakan', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pemeriksaan.tgl_kunjungan', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
            ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
            ->orderBy('pemeriksaan.waktu_kunjungan', 'desc') // Mengurutkan berdasarkan waktu kunjungan (dari terbaru ke terlama)
            ->get();

        // Loop melalui setiap item dalam $kunjungan
       foreach ($kunjungan as $data) {
    //     if ($data->askes == "Dana_Sehat") {
    //    $harga = Tindakan::select('harga')->where('nama_tindakan','!=','periksa')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();

    //     }else {
    $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();

    // }
    $data->total_harga_tindakan = 0;
    $hargatindakan = [];
    $namatindakan = [];
    // $data->hargatindakan = $harga->harga;
    foreach ($harga as $item) {
        $namatindakan[] = $item->nama_tindakan;
        if ($data->askes == "Dana_Sehat") {

            if ($item->nama_tindakan == "periksa") {
                $hargatindakan[] = 0;

                $data->total_harga_tindakan += 0;
            } else {
                $hargatindakan[] = $item->harga;

                $data->total_harga_tindakan += $item->harga;

            }
        } else {
            $hargatindakan[] = $item->harga;

            $data->total_harga_tindakan += $item->harga;

        }

    }
    $data->hargatindakan = $hargatindakan;
    $data->namatindakan = $namatindakan;
}


        return view('pages.pembayaran', compact('kunjungan', 'no'));
    }
}
