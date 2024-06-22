<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Tindakan;
use App\Models\Pembayaran;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


class DetailRekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $no_rmd = $request['no_rmd'];

        $pasien = Pasien::where('no_rmd', $no_rmd)->first();

        $kunjunganpasien = Pemeriksaan::select('*',
            DB::raw('
                (
                    SELECT JSON_ARRAYAGG(
                        JSON_OBJECT(
                            "id", resepobat.id,
                            "nama_obat", (SELECT nama_obat FROM obat WHERE obat.id = resepobat.id_obat),
                            "deskripsi", resepobat.deskripsi,
                            "aturanpakai", resepobat.aturanpakai,
                            "jumlah", resepobat.jumlah
                        )
                    )
                    FROM resepobat
                    WHERE resepobat.id_periksa = pemeriksaan.id
                ) as resep
            ') 
        )->where('pasien_id', $pasien->id)->get();
        // print_r($kunjunganpasien); die();
        // dd($periksaId);
        $no = 1;
        return view('pages.detailrekmed', compact('kunjunganpasien', 'no', 'pasien'));
    }
    public function cetak($no_rmd)
    {
        App::setLocale('id');
        $id = 1;
        $pasien = Pasien::where('no_rmd', $no_rmd)->first();

        $kunjunganpasien = Pemeriksaan::select('*',
            DB::raw('
                        (
                            SELECT JSON_ARRAYAGG(
                                JSON_OBJECT(
                                    "id", resepobat.id,
                                    "nama_obat", (SELECT nama_obat FROM obat WHERE obat.id = resepobat.id_obat),
                                    "deskripsi", resepobat.deskripsi,
                                    "aturanpakai", resepobat.aturanpakai,
                                    "jumlah", resepobat.jumlah
                                )
                            )
                            FROM resepobat
                            WHERE resepobat.id_periksa = pemeriksaan.id
                        ) as resep
                    ')
        )->where('pasien_id', $pasien->id)->get();
        
        // dd($periksaId);
        $no = 1;
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pemeriksaan.keluhan','pemeriksaan.alergi', 'pemeriksaan.tb', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.suhutubuh', 'pemeriksaan.spo2', 'pemeriksaan.pernapasan', 'pemeriksaan.periksalain',  'pemeriksaan.tindakan', 'pasien.agama', 'pasien.tanggal_lahir', 'pasien.nik', 'pasien.jenis_kelamin', 'pasien.pekerjaan', 'pasien.no_telp', 'pasien.no_dana_sehat', 'pemeriksaan.diagnosa', 'pasien.tempat_lahir', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
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
        return view('pages.cetakrekammedis', compact('kunjungan', 'no', 'resep', 'totalobat', 'kunjunganpasien', 'pasien'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Pembayaran::create($data);

        return redirect()->route('detailpembayaran.index');
    }
}
