<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPeriksaController extends Controller
{
    public function index(Request $request)
    {
        $periksaId = $request['id_periksa'];
        // dd($periksaId);
        $no = 1;
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa','pasien.noregis', 'pemeriksaan.tindakan', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pasien.no_dana_sehat','pemeriksaan.tindakan','pemeriksaan.tb','pemeriksaan.bb','pemeriksaan.keluhan','pemeriksaan.nadi','pemeriksaan.alergi','pemeriksaan.diagnosa','pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
            ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
        return view('pages.detailperiksa', compact('kunjungan', 'no'));
    }
}
