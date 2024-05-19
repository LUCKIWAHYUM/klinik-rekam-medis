<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable =
    [
        'no_rmd',
        'nik',
        'nama_pasien',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'agama',
        'pekerjaan',
        'alamat',
        'no_telp',
        'askes',
        'noregis',
        'statuspasien',
        'no_dana_sehat'
    ];
        public function resep()
    {
        return $this->hasmany(Resep::class, 'id','id_pasien');
    }
}
