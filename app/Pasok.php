<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasok extends Model
{
    protected $primaryKey = 'id_pasok';

    protected $fillable = [
        'id_distributor', 'id_buku', 'jumlah',
    ];
}
