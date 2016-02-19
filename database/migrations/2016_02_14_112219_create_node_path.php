<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodePath extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_path', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id_1')->unsigned();
            $table->integer('node_id_2')->unsigned();

            $table->foreign('node_id_1')->references('id')->on('nodes');
            $table->foreign('node_id_2')->references('id')->on('nodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('node_path');
    }
}
