<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi','255')->nullable();            
            $table->string('gambar')->nullable();
            $table->integer('target')->nullable();
            $table->integer('terkumpul')->nullable();
            $table->dateTime('lama_donasi')->nullable();            
            $table->boolean('confirmed')->default('0');
            $table->string('nomorRekening')->nullable();
            $table->string('bank')->nullable();
            $table->timestamps();

            $table->foreign('id_user')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('kontens');
    }
}
