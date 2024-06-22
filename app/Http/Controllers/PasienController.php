<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pasien;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PasienRequest;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $pasien = Pasien::orderBy('created_at', 'desc')->get(); // Mengambil data pasien dengan urutan berdasarkan waktu pembuatan, dengan yang terbaru di atas


        return view('pages.pasien', compact(
            'no',
            'pasien'
        ));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request['jenis_kelamin']);
        try {
            // Validasi data
            $request->validate([
                'no_rmd' => 'required|unique:pasien,no_rmd',
                // tambahkan validasi lainnya sesuai kebutuhan
            ]);
            // Simpan data ke database
            $user = Pasien::create($request->all());

            $no_rmd = $this->generateNoRmd();
            // Update nilai noregis di dalam data user
            $user->update(['no_rmd' => $no_rmd]);
            return redirect()->route('pasien.index')->with('success', 'Data pasien ' . $request->nama_pasien . ' berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('pasien.index')->with('error', 'Gagal menambahkan data pasien: ' . $e->getMessage());
        }
    }

    public function generateNoRmd()
    {
        $currentYear = date('y'); // Get the last two digits of the current year, e.g., 24 for 2024
        $latestRecord = Pasien::where('no_rmd', 'LIKE', $currentYear . '-%')
            ->orderBy('no_rmd', 'desc')
            ->first();

        if ($latestRecord) {
            // Extract the numeric part (after the dash) and increment it
            $latestNumber = intval(substr($latestRecord->no_rmd, 3)); // Extracts the sequence part
            $newNumber = $latestNumber + 1; // Increment the sequence
        } else {
            $newNumber = 1; // Start the sequence from 1 if no records are found
        }

        // Format the new no_rmd with leading zeros
        $noRmd = $currentYear . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return $noRmd;
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
        $data = Pasien::find($id); // Mencari data berdasarkan ID
        return view('edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pasien = Pasien::findOrFail($id); // Mencari data berdasarkan ID

            // Validasi input data jika diperlukan
            $request->validate([
                'no_rmd' => 'required',
                'nik' => 'required',
                'nama_pasien' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'usia' => 'required',
                'agama' => 'required',
                'pekerjaan' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'askes' => 'required',
                'statuspasien' => 'nullable',
                'no_dana_sehat' => 'nullable',
                // Tambahkan validasi untuk kolom lain sesuai kebutuhan
            ]);

            // Simpan perubahan data
            $pasien->update($request->all());

            return redirect()->route('pasien.index')->with('success', 'Data pasien ' . $pasien->nama_pasien . ' berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('pasien.index')->with('error', 'Gagal memperbarui data pasien: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
            $nama_pasien = $pasien->nama_pasien; // Simpan nama pasien sebelum dihapus
            $pasien->delete();

            return redirect()->route('pasien.index')->with('success', 'Data pasien ' . $nama_pasien . ' berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('pasien.index')->with('error', 'Gagal menghapus data pasien: ' . $e->getMessage());
        }
    }
}
