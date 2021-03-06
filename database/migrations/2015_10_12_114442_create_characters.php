<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->integer('race_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('script_id')->unsigned()->nullable()->default(NULL);
            $table->boolean('adventure')->default(false);
            $table->integer('level')->unsigned()->default(1);
            $table->integer('experience')->unsigned()->default(0);
            $table->integer('elo')->default(0);
            $table->boolean('visible')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('script_id')->references('id')->on('scripts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('characters');
    }
}
