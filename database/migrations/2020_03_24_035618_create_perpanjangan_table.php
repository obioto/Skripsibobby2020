<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerpanjanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perpanjangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_konten');
            $table->string('status')->default('verifikasi');
            $table->string('jumlah_hari');
            $table->string('alasan');
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
        Schema::dropIfExists('perpanjangan');
    }
}
