<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterFight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_fight', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fight_id')->unsigned();
            $table->integer('character_id')->unsigned();
            $table->integer('team_id')->unsigned()->nullable();
            $table->integer('elo_change')->default(0);
            $table->timestamps();

            $table->foreign('fight_id')->references('id')->on('fights');
            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('character_fight');
    }
}
