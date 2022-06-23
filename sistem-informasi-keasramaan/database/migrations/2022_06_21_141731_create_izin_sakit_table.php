<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinSakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izin_sakit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->dateTime('jadwal_istirahat');
            $table->string('keterangan');
            $table->integer('status_izin')->nullable();
            $table->enum('kondisi', ['sakit', 'sembuh'])->default('sakit');
            $table->string('surat_sakit')->nullable();
            
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
        Schema::dropIfExists('izin_sakit');
    }
}
