<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerkembangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkembangans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('id_konten')->nullable();
            $table->date('tanggal');
            $table->string('deskripsi');
            $table->string('gambar')->nullable();
            $table->integer('pengeluaran')->nullable();
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
        Schema::dropIfExists('perkembangans');
    }
}
