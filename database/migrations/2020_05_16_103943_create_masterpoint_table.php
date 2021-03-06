<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_masterpoint', function (Blueprint $table) {
            $table->id();
            $table->integer('atlet_id')->unsigned();
            $table->foreign('atlet_id')->references('id')->on('tb_atlet')->onDelete('cascade');
            $table->double('discipline', 2, 2);
            $table->double('bidding', 2, 2);
            $table->double('play', 2, 2);
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
        Schema::dropIfExists('tb_masterpoint');
    }
}
