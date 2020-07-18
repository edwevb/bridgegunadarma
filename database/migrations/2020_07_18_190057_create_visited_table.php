<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitedTable extends Migration
{
    public function up()
    {
        Schema::create('tb_visited', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('atlet_id')->unsigned();
            $table->foreign('atlet_id')->references('id')->on('tb_atlet')->onDelete('cascade');
            $table->integer('hits');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tb_visited');
    }
}
