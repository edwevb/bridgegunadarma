<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletIuranSkTable extends Migration
{
    public function up()
    {
        Schema::create('atlet_iuran_sk', function (Blueprint $table) {
            $table->id();
            $table->integer('atlet_id')->unsigned();
            $table->integer('iuran_sk_id')->unsigned();
            $table->foreign('atlet_id')->references('id')->on('tb_atlet')->onDelete('cascade');
            $table->foreign('iuran_sk_id')->references('id')->on('tb_iuran_sk')->onDelete('cascade');
            $table->date('sk_date');
            $table->double('sk_bayar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atlet_iuran_sk');
    }
}
