<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('password');
            $table->Integer('role_id')->unsigned()->nullable();
            $table->string('namaLengkap')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nomorKtp')->nullable();
            $table->string('noHp')->nullable();
            $table->string('fotoKtp')->nullable();
            $table->boolean('confirmed')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
            ->references('id')
            ->on('roles')
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
        Schema::dropIfExists('users');
    }
}
