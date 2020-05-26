<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_atlet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik',32)->unique();
            $table->string('atlet_name',64);
            $table->date('tgl_lahir');
            $table->string('gender');
            $table->text('telp');
            $table->text('email');
            $table->text('alamat')->nullable($value = true);
            $table->string('fakultas',64);
            $table->string('jurusan',64);   
            $table->string('angkatan',4)->nullable($value = true);
            $table->text('fb')->nullable($value = true);
            $table->text('twt')->nullable($value = true);
            $table->text('ig')->nullable($value = true);
            $table->text('brg_taught')->nullable($value = true);
            $table->text('img_atlet')->nullable($value = true);
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
        Schema::dropIfExists('tb_atlet');
    }
}
