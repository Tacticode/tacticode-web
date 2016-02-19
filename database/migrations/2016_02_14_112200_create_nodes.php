<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('race_id')->unsigned()->nullable()->default(null);
            $table->integer('power_id')->unsigned()->nullable()->default(null);
            $table->integer('pos_x');
            $table->integer('pos_y');
            $table->timestamps();
            
            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('power_id')->references('id')->on('powers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
    }
}
