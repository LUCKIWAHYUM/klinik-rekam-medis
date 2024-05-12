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
        $kunjungan = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pemeriksaan.tindakan', 'pembayaran.status as statuspembayaran', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status as statuspemeriksaan', 'resepobat.status as statusobat', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan', DB::raw('SUM(obat.harga) as total_harga_obat'))
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id') // Join dengan tabel resepobat
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa') // Left join dengan tabel pembayaran
            ->groupBy('pemeriksaan.no_periksa', 'resepobat.id_periksa', 'pemeriksaan.pasien_id', 'pembayaran.status', 'pasien.nama_pasien', 'pasien.no_rmd', 'pemeriksaan.status', 'resepobat.status', 'pemeriksaan.tgl_kunjungan', 'pasien.askes', 'pemeriksaan.waktu_kunjungan')
            ->get();

        // Loop melalui setiap item dalam $kunjungan
        foreach ($kunjungan as $data) {
            // Ambil nama tindakan dari baris saat ini
            $nama_tindakan = $data->tindakan;

            // Hitung total harga tindakan berdasarkan nama tindakan dari baris saat ini
            $harga_tindakan = Tindakan::where('nama_tindakan', $nama_tindakan)->sum('harga');

            // Menyimpan total harga tindakan ke dalam item saat ini
            $data->total_harga_tindakan = $harga_tindakan;
        }

        return view('pages.pembayaran', compact('kunjungan', 'no'));
    }
}
