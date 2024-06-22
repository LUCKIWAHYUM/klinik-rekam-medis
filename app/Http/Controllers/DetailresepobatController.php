<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class DetailresepobatController extends Controller
{
    public function index(Request $request)
    {
        $no = 1;
        // dd($request['id_periksa']);
        $periksaId = $request['id_periksa'];
        // dd($periksaId);
        $resep = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pasien.usia', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.alergi', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'resepobat.aturanpakai','resepobat.jumlah', 'obat.satuan', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
        $kunjungan = Resep::select('pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pasien.usia', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.alergi')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->groupBy('pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pasien.usia', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.alergi')
            ->where('resepobat.id_periksa', $periksaId)
            ->get();
        $periksa = Pemeriksaan::with('pasien')->orderBy('created_at', 'desc')->get();

        return view('pages.detailresepobat', compact(
            'no',
            'kunjungan',
            'periksa',
            'resep'
        ));
    }

    public function cetak($id)
    {
        $no = 1;
        // dd($request['id_periksa']);
        // $periksaId = $request['id_periksa'];
        // dd($id);
        $resep = Resep::select('resepobat.id_periksa', 'pemeriksaan.no_periksa', 'pasien.nama_pasien', 'pemeriksaan.status as statuspemeriksaan', 'obat.nama_obat', 'resepobat.aturanpakai', 'resepobat.jumlah', 'pasien.usia', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.alergi', 'obat.satuan', 'resepobat.deskripsi', 'pemeriksaan.tgl_kunjungan', 'pemeriksaan.waktu_kunjungan')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->join('obat', 'resepobat.id_obat', '=', 'obat.id')
            ->where('resepobat.id_periksa', $id)
            ->get();
        $kunjungan = Resep::select('pemeriksaan.no_periksa', 'pasien.nama_pasien', 'resepobat.id_periksa', 'pasien.usia', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.alergi')
            ->join('pemeriksaan', 'resepobat.id_periksa', '=', 'pemeriksaan.id')
            ->join('pasien', 'pemeriksaan.pasien_id', '=', 'pasien.id')
            ->groupBy('pemeriksaan.no_periksa', 'pasien.nama_pasien', 'resepobat.id_periksa', 'pasien.usia', 'pemeriksaan.bb', 'pemeriksaan.td', 'pemeriksaan.nadi', 'pemeriksaan.alergi')
            ->where('resepobat.id_periksa', $id)
            ->get();
        return view('pages.cetakResep', compact(
            'no',
            'kunjungan',
            'resep'
        ));
        
    }
}
