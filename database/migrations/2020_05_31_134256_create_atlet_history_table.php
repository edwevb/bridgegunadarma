<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('atlet_history', function (Blueprint $table) {
            $table->id();
            $table->integer('atlet_id')->unsigned();
            $table->integer('history_id')->unsigned();
            $table->foreign('atlet_id')->references('id')->on('tb_atlet')->onDelete('cascade');
            $table->foreign('history_id')->references('id')->on('tb_history')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('atlet_history');
    }
}
