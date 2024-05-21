<?php

namespace App\Imports;

use App\Models\Penyakit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenyakitImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penyakit([
            'kode' => $row['kode'],
            'nama_penyakit' => $row['nama_penyakit']
        ]);
    }
}
