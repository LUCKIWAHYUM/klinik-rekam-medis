<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPeriksaController extends Controller
{
    public function index(Request $request)
    {
        $periksaId = $request['id_periksa'];
        // dd($periksaId);
        $no = 1;
        $kunjungan = Pemeriksaan::with('pasien')->where('id',$periksaId)->get();
        return view('pages.detailperiksa', compact('kunjungan', 'no'));
    }
}
