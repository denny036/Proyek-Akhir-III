<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinBermalamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_bermalam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->dateTime('rencana_berangkat');
            $table->dateTime('rencana_kembali');
            $table->string('keperluan_ib');
            $table->string('tempat_tujuan');
            $table->integer('status')->nullable();
            $table->string('alasan_tolak', 45)->nullable();

            $table->foreign('users_id')->on('users')->references('id')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('petugas_id')->nullable()->references('id')->on('petugas')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izin_bermalam');
    }
}

