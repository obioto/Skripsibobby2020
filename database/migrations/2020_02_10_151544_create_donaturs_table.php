<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonatursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donaturs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_konten')->unsigned();
            $table->string('namaLengkap');            
            $table->integer('jumlah');
            $table->string('nomorTelepon');
            $table->string('bukti');
            $table->boolean('isconfirmed')->default('0');
            $table->boolean('isanonim')->default('0');
            $table->timestamps();

            $table->foreign('id_konten')
            ->references('id')
            ->on('kontens')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donaturs');
    }
}
