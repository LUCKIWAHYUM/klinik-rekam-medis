<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Tindakan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class DetailRekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $periksaId = $request['id_periksa'];
        // dd($periksaId);
        $no = 1;
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pemeriksaan.tindakan', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pasien.nik', 'pasien.pekerjaan', 'pasien.nik', 'pasien.agama', 'pasien.jenis_kelamin', 'pasien.alamat', 'pasien.no_telp', 'pasien.no_dana_sehat', 'pasien.tanggal_lahir', 'pemeriksaan.alergi', 'pemeriksaan.keluhan', 'pemeriksaan.subjective', 'pemeriksaan.objective', 'pemeriksaan.assessment', 'pemeriksaan.plan','pemeriksaan.waktu_kunjungan','pemeriksaan.diagnosa', DB::raw('SUM(obat.harga) as total_harga_obat'))
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
            ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
        $resep = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'obat.harga', 'resepobat.aturanpakai', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
        $totalobat = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'obat.harga', 'resepobat.aturanpakai', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $periksaId)
            ->sum('harga');
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

            if ($item->nama_tindakan == "periksa") {
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
        return view('pages.detailrekmed', compact('kunjungan', 'no', 'resep', 'totalobat'));
    }
    public function cetak($id)
    {
        App::setLocale('id');

        // $periksaId = $request['id_periksa'];
        // dd($periksaId);
        $no = 1;
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pemeriksaan.keluhan','pemeriksaan.alergi','pemeriksaan.subjective', 'pemeriksaan.objective', 'pemeriksaan.assessment', 'pemeriksaan.plan', 'pemeriksaan.keterangan_dokter', 'pemeriksaan.tindakan', 'pasien.agama', 'pasien.tanggal_lahir', 'pasien.nik', 'pasien.jenis_kelamin', 'pasien.pekerjaan', 'pasien.no_telp', 'pasien.no_dana_sehat', 'pemeriksaan.diagnosa', 'pasien.tempat_lahir', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
            ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
            ->where('resepobat.id_periksa', $id)
            ->get();
        $resep = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'obat.harga', 'resepobat.aturanpakai', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $id)
            ->get();
        $totalobat = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'obat.harga', 'resepobat.aturanpakai', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $id)
            ->sum('harga');
            foreach ($kunjungan as $data) {
        // Loop melalui setiap item dalam $kunjungan
                 if ($data->askes == "Dana_Sehat") {
           $harga = Tindakan::select('harga')->where('nama_tindakan','!=','periksa')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();
                
            }else {
            $harga = Tindakan::select('harga')->whereIn('nama_tindakan', json_decode($data->tindakan, true))->get();

            }
            $data->total_harga_tindakan = 0;
            // $data->hargatindakan = $harga->harga;
            foreach ($harga as $item) {
    $data->hargatindakan = $item->harga;
  

    $data->total_harga_tindakan += $item->harga;
            }
}
        return view('pages.cetakrekammedis', compact('kunjungan', 'no', 'resep', 'totalobat'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Pembayaran::create($data);

        return redirect()->route('detailpembayaran.index');
    }
}
