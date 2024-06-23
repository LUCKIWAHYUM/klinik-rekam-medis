<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Tindakan;
use App\Models\Pemeriksaan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $no = 1;
        
        $kunjungan = Pemeriksaan::select('*', 'pemeriksaan.id as id_periksa')
            ->leftJoin('pasien', 'pasien.id', 'pemeriksaan.pasien_id')
            ->orderBy('pemeriksaan.created_at', 'desc')
            ->get();

        // Loop melalui setiap item dalam $kunjungan
        foreach ($kunjungan as $data) {
            $harga = Tindakan::select('harga', 'nama_tindakan')->whereIn('nama_tindakan', $data->tindakan)->get();

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

            $data->statuspembayaran = Pembayaran::where('id_periksa', $data->id_periksa)->first()->status ?? "belum";
        }


        return view('pages.pembayaran', compact('kunjungan', 'no'));
    }
}
