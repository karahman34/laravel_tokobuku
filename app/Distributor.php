<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected $primaryKey = 'id_distributor';

    protected $fillable = [
        'nama_distributor', 'alamat', 'telepon',
    ];
}
