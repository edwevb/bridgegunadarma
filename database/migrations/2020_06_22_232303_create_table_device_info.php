<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDeviceInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_device', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable($value = true);
            $table->string('device')->nullable($value = true);
            $table->string('browser')->nullable($value = true);
            $table->string('platform')->nullable($value = true);
            $table->string('ip')->nullable($value = true);
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
        Schema::dropIfExists('tb_device');
    }
}
