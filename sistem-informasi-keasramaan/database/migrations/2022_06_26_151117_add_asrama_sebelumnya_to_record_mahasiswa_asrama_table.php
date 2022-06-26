<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsramaSebelumnyaToRecordMahasiswaAsramaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('record_mahasiswa_asrama', function (Blueprint $table) {
            $table->bigInteger('asrama_sebelumnya')->after('asrama_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('record_mahasiswa_asrama', function (Blueprint $table) {
            $table->dropColumn('asrama_sebelumnya');
        });
    }
}
