<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obatmasuk extends Model
{
    use HasFactory;
      protected $table = 'obatmasuk';
    protected $fillable =
    [
        'id_obat',
        'jumlah',
        'created_at',
    ];
      public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat','id');
    }
}

