<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable =
    [
        'id_periksa',
        'total',
        'status',
    ];
    public function periksa()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_periksa', 'id');
    }
}
