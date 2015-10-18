<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterPower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_power', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('power_id')->unsigned();
            $table->integer('character_id')->unsigned();
            $table->timestamps();

            $table->foreign('power_id')->references('id')->on('powers');
            $table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('character_power');
    }
}
