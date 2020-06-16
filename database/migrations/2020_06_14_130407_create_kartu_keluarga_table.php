<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_kk');
            $table->string('nama_kepala_keluarga');
            $table->integer('rt');
            $table->string('alamat');
            $table->string('no_kontak')->nullable();
            $table->string('email_kontak')->nullable();
            $table->string('kartu_keluarga_img')->nullable();
            $table->string('approval');
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kartu_keluarga');
    }
}
