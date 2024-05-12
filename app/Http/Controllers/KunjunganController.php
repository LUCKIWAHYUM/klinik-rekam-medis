<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Str;
use Carbon\Carbon;


class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $dokter = User::where('role', 'dokter')
            ->where('status', 'aktif')->get();
        $pasien = Pasien::get();
        $kunjungan = Pemeriksaan::with('pasien')->latest()->get(); // Mengambil data kunjungan dengan urutan berdasarkan waktu pembuatan, dengan yang terbaru di atas

        return view('pages.kunjungan', compact('kunjungan', 'no', 'dokter', 'pasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Mendapatkan tanggal hari ini
            // $today = Carbon::now()->format('Y-m-d');

            $today = $request['tgl_kunjungan'];
            // Mencari kunjungan terakhir pada hari ini
            $lastVisitToday = Pemeriksaan::whereDate('created_at', $today)
                ->orderBy('id', 'desc')
                ->first();

            // Mengatur nomor antrian berikutnya
            $nextQueueNumber = '001';

            if ($lastVisitToday) {
                // Jika ada kunjungan sebelumnya hari ini, ambil nomor antrian terakhir dan tambahkan 1
                $lastQueueNumber = substr($lastVisitToday->no_antrian, -3); // Mendapatkan 3 digit terakhir dari nomor antrian terakhir
                $nextQueueNumber = str_pad((int)$lastQueueNumber + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan pastikan format nomor antrian adalah 3 digit
            } else {
                // Jika tidak ada kunjungan hari ini, maka kembalikan nomor antrian ke "001"
                $nextQueueNumber = '001';
            }

            // Membuat data kunjungan baru dengan nomor antrian yang telah di-generate
            $data = $request->all();
            $data['no_antrian'] = $nextQueueNumber;
            $data['no_periksa'] = STR::random(5);
            Pemeriksaan::create($data);

            // Dapatkan nama pasien yang terkait dengan kunjungan baru
            $pasien = Pasien::findOrFail($data['pasien_id'])->nama_pasien;

            // Berikan pesan bahwa kunjungan baru telah ditambahkan sesuai dengan nama pasien
            return redirect()->route('kunjungan.index')->with('success', 'Kunjungan baru untuk ' . $pasien . ' dengan nomor antrian ' . $nextQueueNumber . ' telah ditambahkan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('kunjungan.index')->with('error', 'Gagal menambahkan kunjungan: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = Pemeriksaan::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('kunjungan.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Pemeriksaan::findOrFail($id);
            $nama_pasien = $data->pasien->nama_pasien; // Dapatkan nama pasien yang terkait dengan kunjungan yang akan dihapus
            $data->delete();

            // Berikan pesan bahwa kunjungan telah dihapus sesuai dengan nama pasien
            return redirect()->route('kunjungan.index')->with('success', 'Kunjungan untuk ' . $nama_pasien . ' telah dihapus.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('kunjungan.index')->with('error', 'Gagal menghapus kunjungan: ' . $e->getMessage());
        }
    }
    public function cetakAntrian($id)
    {
        $kunjungan = Pemeriksaan::where('id', $id)->get();
        return view('pages.cetak_antrian', compact('kunjungan'));
    }
}
