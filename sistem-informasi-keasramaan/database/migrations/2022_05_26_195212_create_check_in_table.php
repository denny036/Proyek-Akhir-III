<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->unsignedBigInteger('record_mahasiswa_asrama_id')->nullable();
            $table->dateTime('tanggal_check_in');
            $table->string('asrama_tujuan');
            $table->text('keperluan');
            $table->string('status_request')->nullable();

            $table->foreign('users_id')->on('users')->references('id')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('petugas_id')->nullable()->references('id')->on('petugas')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('record_mahasiswa_asrama_id')->nullable()->references('id')->on('record_mahasiswa_asrama')
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
        Schema::dropIfExists('check_in');
    }
}
