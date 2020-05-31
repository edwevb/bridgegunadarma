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
            $table->integer('atlet_id');
            $table->integer('iuran_sk_id');
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
