<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordMahasiswaAsramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_mahasiswa_asrama', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('asrama_id');
            $table->timestamps();

            $table->foreign('users_id')->on('users')->references('id')
                    ->onDelete('CASCADE')
                    ->onUpdate('CASCADE');

            $table->foreign('asrama_id')->on('asrama')->references('id')
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
        Schema::dropIfExists('record_mahasiswa_asrama');
    }
}
