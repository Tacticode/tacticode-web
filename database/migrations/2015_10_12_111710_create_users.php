<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 45)->unique();
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('id_facebook', 255)->nullable()->default(null);
            $table->rememberToken();
            $table->integer('group_id')->unsigned();
            $table->boolean('banned')->default(false);
            $table->date('banned_until')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
