<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $primaryKey = 'id_penjualan';

    protected $fillable = [
        'id_buku', 'id_kasir', 'jumlah', 'total',
    ];
}
