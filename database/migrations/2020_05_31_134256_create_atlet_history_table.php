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
            $table->integer('atlet_id');
            $table->integer('history_id');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('atlet_history');
    }
}
