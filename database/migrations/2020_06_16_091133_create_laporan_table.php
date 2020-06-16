<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_kk')->unsigned();
            $table->string('no_kk');
            $table->string('rt');
            $table->string('judul');
            $table->string('subjek');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('id_kk')->references('id')->on('kartu_keluarga')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
