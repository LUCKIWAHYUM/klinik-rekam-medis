<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Resep;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class DetailPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $periksaId = $request['id_periksa'];
        $no = 1;
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa','users.name as nama_dokter', 'pemeriksaan.tindakan', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'resepobat.pembelian as pembelian', 'pasien.askes', 'pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->join('users', 'pemeriksaan.user_id','=','users.id')
            ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
            ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pembelian', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
        $resep = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'obat.harga', 'resepobat.aturanpakai', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan', 'pembelian')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
      foreach ($kunjungan as $data) {
        //     if ($data->askes == "Dana_Sehat") {
        //    $harga = Tindakan::select('harga')->where('nama_tindakan','!=','periksa')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();
                
        //     }else {
            $harga = Tindakan::select('harga','nama_tindakan')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();

            // }
            $data->total_harga_tindakan = 0;
            $hargatindakan = [];
            $namatindakan = [];
            // $data->hargatindakan = $harga->harga;
            foreach ($harga as $item) {
                $namatindakan[] = $item->nama_tindakan;
                if ($data->askes == "Dana_Sehat"){
                    if ($item->nama_tindakan == "periksa" || $item->nama_tindakan == "pemeriksaan dan konsultasi") {
                        $hargatindakan[] = 0;
                        $data->total_harga_tindakan += 0;
                    }else{
                        $hargatindakan[] = $item->harga;
                        $data->total_harga_tindakan += $item->harga;
                    }
                }else{
                    $hargatindakan[] = $item->harga;
                    $data->total_harga_tindakan += $item->harga;
                }

            }
            $data->hargatindakan = $hargatindakan;
            $data->namatindakan = $namatindakan;
        }
        return view('pages.detailpembayaran', compact('kunjungan', 'no', 'resep'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Pembayaran::create($data);

        return redirect()->route('pembayaran.index');
    }



        public function cetak($id)
    {
        App::setLocale('id');
        // $periksaId = $request['id_periksa'];
$no = 1;
$kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'users.name as nama_dokter', 'pemeriksaan.tindakan', 'pemeriksaan.tindakan', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'resepobat.pembelian as pembelian', 'pasien.askes', 'pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
    ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
    ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
    ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
    ->join('users', 'pemeriksaan.user_id', '=', 'users.id')
    ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
    ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pembelian', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
    ->where('resepobat.id_periksa', $id)
    ->get();
$resep = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'obat.harga', 'resepobat.aturanpakai', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan', 'pembelian')
    ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
    ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
    ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
    ->where('resepobat.id_periksa', $id)
    ->get();
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
            if ($item->nama_tindakan == "periksa" || $item->nama_tindakan == "pemeriksaan dan konsultasi") {
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

        return view('pages.cetaknota', compact('kunjungan', 'no', 'resep'));
    }
}
