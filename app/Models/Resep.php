<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'resepobat';
    protected $fillable =
    [
        'id_obat',
        'id_pasien',
        'id_periksa',
        'pembelian',
        'deskripsi',
        'aturanpakai',
        'jumlah',
        'status',
        'created_at'
    ];
    public function periksa()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_periksa','id');
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat','id');
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien','id');
    }
}
