<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\Pemeriksaan;
use App\Models\Resep;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $role = auth()->user()->role; // Mengambil peran (role) pengguna yang sudah login
        // Menghitung jumlah pasien berdasarkan bulan dan tahun saat ini
       $pasien = Pasien::count();

       $user = User::count();


        $count = Pemeriksaan::where('status', '2')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $resep = Resep::groupBy('id_periksa')
            ->select('id_periksa', DB::raw('COUNT(*) as total'))
            ->get()
            ->count();
        $pembeliansendiri = Resep::where('pembelian', 'sendiri')
            ->groupBy('id_periksa')
            ->select('id_periksa', DB::raw('COUNT(*) as total'))
            ->get()
            ->count();
        $pembelianapotek = Resep::where('pembelian', 'apotek')
            ->groupBy('id_periksa')
            ->select('id_periksa', DB::raw('COUNT(*) as total'))
            ->get()
            ->count();
        $pendapatan = Pembayaran::where('status' ,'sudah bayar')->get()->sum('total');
        $pendapatanbulan = Pembayaran::where('status' ,'sudah bayar')
        ->whereMonth('created_at', $currentMonth)
        ->get()->sum('total');
        $jumlahobat = Obat::get()->count();
        $pemeriksaan = Pemeriksaan::whereIn('status', ['0', '1'])->get()->count();
        $per = Pemeriksaan::get()->count();
        $pemeriksaandone = Pemeriksaan::where('status', '2')->get()->count();
        $pemeriksaanwait = Pemeriksaan::where('status', '0')->get()->count();
        $pemeriksaanperiksa = Pemeriksaan::where('status', '1')->get()->count();
        $pembayarandone = Pembayaran::where('status', 'sudah bayar')->get()->count();
        $pembayaranwait = Pembayaran::where('status', 'belum')->get()->count();


        $jumlahIdPeriksa = DB::table('pemeriksaan')
    ->leftJoin('pembayaran', 'pemeriksaan.id', '=', 'pembayaran.id_periksa')
    ->whereNull('pembayaran.id_periksa')
    ->count('pemeriksaan.id');

        $penyakitterbanyak = Pemeriksaan::select(
            'diagnosa',
            DB::raw('count(*) as total'),
            DB::raw('(SELECT kode FROM data_penyakit WHERE data_penyakit.nama_penyakit = diagnosa LIMIT 1) as kode')
        )
        ->groupBy('diagnosa')
        ->orderBy('total', 'desc') // Mengurutkan berdasarkan total dalam urutan menurun
        ->limit(10);

        $tahun = $request->input('tahun');

        if ($tahun) {
            $penyakitterbanyak->whereYear('tgl_kunjungan', $tahun);
        }

        $penyakitterbanyak = $penyakitterbanyak->get();

        // Mengarahkan pengguna berdasarkan peran (role)
        if ($role === 'dokter') {
            return view('pages.dashboard-dokter', compact('pasien', 'pemeriksaan', 'pemeriksaandone', 'resep'));
        } elseif ($role === 'perawat') {
            return view('pages.dashboard-perawat', compact('pemeriksaandone', 'pemeriksaanwait', 'pemeriksaanperiksa'));
        } elseif ($role === 'admin') {
            return view('pages.dashboard-admin', compact('pendapatanbulan','pendapatan','pasien', 'count', 'pembayarandone', 'pembayaranwait','jumlahIdPeriksa','user', 'penyakitterbanyak'));
        } elseif ($role === 'apoteker') {
            return view('pages.dashboard-apoteker', compact('jumlahobat', 'pembeliansendiri', 'pembelianapotek'));
        } else {
            // Pengguna tidak memiliki peran yang sesuai, lakukan sesuai kebijakan aplikasi Anda
        }
    }
}
