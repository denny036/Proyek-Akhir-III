<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordCheckoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_checkout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_out_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('petugas_id')->nullable();

            $table->foreign('check_out_id')->on('check_out')->references('id')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

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
        Schema::dropIfExists('record_checkout');
    }
}
