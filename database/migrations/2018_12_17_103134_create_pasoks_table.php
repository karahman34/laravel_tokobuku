<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasoks', function (Blueprint $table) {
            $table->increments('id_pasok');
            $table->integer('id_distributor')->unsigned();
            $table->foreign('id_distributor')
                  ->references('id_distributor')->on('distributors')
                  ->onDelete('cascade');
            $table->integer('id_buku')->unsigned();
            $table->foreign('id_buku')
                  ->references('id_buku')->on('bukus')
                  ->onDelete('cascade');
            $table->integer('jumlah', false, true);
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
        Schema::dropIfExists('pasoks');
    }
}
