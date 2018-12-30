<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'id_cart';

    protected $fillable = [
        'id_cart', 'id_kasir', 'id_buku', 'jumlah', 'harga_total',
    ];
}
