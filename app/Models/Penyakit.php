<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'data_penyakit';
    protected $fillable =
    [
        'id',
        'kode',
        'nama_penyakit',
    ];
}
