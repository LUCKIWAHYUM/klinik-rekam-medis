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
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // Ambil data dari file yang diunggah
        $importedData = Excel::toArray(new PenyakitImport, $request->file('file'));

        // Loop melalui data yang diimpor
        foreach ($importedData[0] as $data) {
            // Simpan data dengan ID kecamatan yang cocok
            Penyakit::create([
                'kode' => $data['kode'],
                'nama_penyakit' => $data['nama_penyakit'],
            ]);

        }

        return redirect()->back()->with('success', 'File Excel berhasil diunggah dan data berhasil diimpor.');
    }
}
