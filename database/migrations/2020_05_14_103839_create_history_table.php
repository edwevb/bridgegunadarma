<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hist_title',128);
            $table->date('hist_date');
            $table->text('hist_loc');
            $table->text('hist_keterangan')->nullable($value=true);
            $table->text('hist_dist')->nullable($value=true);
            
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
        Schema::dropIfExists('tb_history');
    }
}
