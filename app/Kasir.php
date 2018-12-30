<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $primaryKey= 'id_kasir';

    protected $fillable = [
        'email', 'nama', 'alamat', 'telepon', 'photo', 'password'
    ];

    protected $hidden = [
        'password',
    ];
}
