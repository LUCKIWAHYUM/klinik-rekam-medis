<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = auth()->user()->role; // Mengambil peran (role) pengguna yang sudah login
        $pasien = Pasien::get()->count();
        $pemeriksaan = Pemeriksaan::get()->count();
        $resep = Resep::get()->count();
        $resepdiambil = Resep::where('status', 'sudah diambil')->get()->count();
        $pembelianobat = Resep::where('pembelian', 'sendiri')->get()->count();
        $jumlahobat = Obat::get()->count();
        $pemeriksaan = Pemeriksaan::whereIn('status', ['0', '1'])->get()->count();
        $pemeriksaandone = Pemeriksaan::where('status', '2')->get()->count();
        $pemeriksaanwait = Pemeriksaan::where('status', '0')->get()->count();
        $pemeriksaanperiksa = Pemeriksaan::where('status', '1')->get()->count();
        $pembayarandone = Pembayaran::where('status', 'sudah bayar')->get()->count();
        $pembayaranwait = Pembayaran::where('status', 'belum')->get()->count();
        // Mengarahkan pengguna berdasarkan peran (role)
        if ($role === 'dokter') {
            return view('pages.dashboard-dokter', compact('pasien', 'pemeriksaan', 'pemeriksaandone', 'resep'));
        } elseif ($role === 'perawat') {
            return view('pages.dashboard-perawat', compact('pemeriksaandone', 'pemeriksaanwait', 'pemeriksaanperiksa'));
        } elseif ($role === 'admin') {
            return view('pages.dashboard-admin', compact('pasien', 'pemeriksaan', 'pembayarandone', 'pembayaranwait'));
        } elseif ($role === 'apoteker') {
            return view('pages.dashboard-apoteker', compact('jumlahobat', 'resepdiambil', 'pembelianobat'));
        } else {
            // Pengguna tidak memiliki peran yang sesuai, lakukan sesuai kebijakan aplikasi Anda
        }
    }
}
