<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_event', function (Blueprint $table) {
            $table->id();
            $table->string('eve_title',128);
            $table->date('eve_date');
            $table->text('eve_isi');
            $table->string('eve_loc',256);
            $table->text('kontak')->nullable($value = true);
            $table->double('fee_team_open')->nullable($value = true);
            $table->double('fee_team_mhs')->nullable($value = true);
            $table->double('fee_team_u21')->nullable($value = true);
            $table->double('fee_pas_open')->nullable($value = true);
            $table->double('fee_pas_mhs')->nullable($value = true);
            $table->double('fee_pas_u21')->nullable($value = true);
            $table->double('prizepool')->nullable($value = true);
            $table->text('eve_url')->nullable($value = true);
            $table->text('img_eve')->nullable($value = true);
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
        Schema::dropIfExists('tb_event');
    }
}
