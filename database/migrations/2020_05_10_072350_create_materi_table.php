<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_materi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mat_title');
            $table->date('mat_date');
            $table->text('mat_keterangan')->nullable($value = true);
            $table->text('file_mat')->nullable($value = true);
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
        Schema::dropIfExists('tb_materi');
    }
}
