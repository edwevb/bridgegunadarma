<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletPrestasiTable extends Migration
{
    public function up()
    {
        Schema::create('atlet_prestasi', function (Blueprint $table) {
            $table->id();
            $table->integer('atlet_id')->unsigned();
            $table->integer('prestasi_id')->unsigned();
            $table->foreign('atlet_id')->references('id')->on('tb_atlet')->onDelete('cascade');
            $table->foreign('prestasi_id')->references('id')->on('tb_prestasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atlet_prestasi');
    }
}
