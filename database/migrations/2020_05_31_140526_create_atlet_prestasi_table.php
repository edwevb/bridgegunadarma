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
            $table->integer('atlet_id');
            $table->integer('prestasi_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atlet_prestasi');
    }
}
