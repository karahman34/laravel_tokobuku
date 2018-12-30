<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => 'super@admin.com',
        'password' => Hash::make('flatisjustice'),
        'nama' => 'administrator',
        'alamat' => 'Jl.Tank Baja No 35/21',
        'telepon' => '0822145212481',
        'akses' => 'admin',
        'photo' => '1169562599.jpg',  
        'email_verified_at' => '2018-12-26 07:33:10',     
    ];
});
