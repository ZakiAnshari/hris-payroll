<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wiraniaga extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'status',
        'target',
        'jumlah_penjualan'
    ];
}
