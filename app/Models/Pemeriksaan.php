<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaan';
    protected $fillable =
    [
        'user_id',
        'pasien_id',
        'tgl_kunjungan',
        'waktu_kunjungan',
        'no_periksa',
        'no_antrian',
        'keluhan',
        'tb',
        'td',
        'bb',
        'nadi',
        'alergi',
        'diagnosa',
        'tindakan',
        'keterangan_dokter',
        'diameter',
        'jumlah',
        'posisi',
        'foto',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }
}
