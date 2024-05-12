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
    ];
    public function periksa()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_periksa','id');
    }
}
