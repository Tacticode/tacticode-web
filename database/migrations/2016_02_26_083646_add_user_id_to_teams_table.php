<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('user_id');

            $table->dropForeign('teams_user_id_foregin');
        });
    }
}
