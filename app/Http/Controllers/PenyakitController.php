<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PenyakitRequest;
use App\Http\Controllers\PenyakitController;
use App\Models\Penyakit;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use App\Imports\PenyakitImport;

class PenyakitController extends Controller
{
    public function index()
    {
        $no = 1;
        $penyakit = Penyakit::get();

        return view('pages.penyakit', compact(
            'no',
            'penyakit',
            
        ));
    }

    public function store(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // Ambil data dari file yang diunggah
        $importedData = Excel::toArray(new PenyakitImport, $request->file('file'));

        // Loop melalui data yang diimpor
        foreach ($importedData[0] as $data) {
            // Validasi bahwa 'kode' tidak null atau kosong
            if (isset($data['kode']) && !empty($data['kode'])) {
                // Simpan data dengan ID kecamatan yang cocok
                // Mencari penyakit berdasarkan kode atau nama_penyakit
                $existingPenyakit = Penyakit::where('kode', $data['kode'])
                    ->orWhere('nama_penyakit', $data['nama_penyakit'])
                    ->first();

                if (!$existingPenyakit) {
                    // Jika tidak ditemukan, buat entri baru
                    Penyakit::create([
                        'kode' => $data['kode'],
                        'nama_penyakit' => $data['nama_penyakit'],
                    ]);
                }

            } else {
                \Log::warning('Data entry skipped due to missing kode:', $data);
            }
        }

        return redirect()->back()->with('success', 'File Excel berhasil diunggah dan data berhasil diimpor.');
    }
    public function update(Request $request, string $id)
    {
        try {
            $data = Penyakit::find($id); // Mencari data berdasarkan ID

            // Validasi input data jika diperlukan
            $request->validate([
                'kode' => 'required',
                'nama_penyakit' => 'required',
                // Tambahkan validasi untuk kolom lain sesuai kebutuhan
            ]);

            // Simpan perubahan data
            $data->kode = $request->input('kode');
            $data->nama_penyakit = $request->input('nama_penyakit');
            // Setel nilai kolom lain sesuai kebutuhan
            $data->save();
           return redirect()->route('penyakit.index')->with('success', 'Data penyakit "' . $data->nama_penyakit . '" berhasil diperbarui.');

        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('penyakit.index')->with('error', 'Gagal memperbarui penyakit: ' . $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        try {
            $data = Penyakit::findOrFail($id);
            $data->delete();

            return redirect()->route('penyakit.index')->with('success', 'Data penyakit berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangkap pengecualian dan tampilkan pesan kesalahan
            return redirect()->route('penyakit.index')->with('error', 'Gagal menghapus data penyakit: ' . $e->getMessage());
        }
    }
}
