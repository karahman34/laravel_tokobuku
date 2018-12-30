<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->increments('id_penjualan');
            $table->integer('id_buku')->unsigned();
            $table->foreign('id_buku')
                  ->references('id_buku')->on('bukus')
                  ->onDelete('cascade');
            $table->integer('id_kasir')->unsigned();      
            $table->foreign('id_kasir')
                  ->references('id_kasir')->on('kasirs')
                  ->onDelete('cascade');
            $table->integer('jumlah', false, true);
            $table->integer('total', false, true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
