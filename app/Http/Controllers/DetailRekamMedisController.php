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
        return view('pages.cetakrekammedis', compact('no', 'kunjunganpasien', 'pasien'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        Pembayaran::create($data);

        return redirect()->route('detailpembayaran.index');
    }
}
