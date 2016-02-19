<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePowers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('powers', function (Blueprint $table) {
            $table->dropForeign('powers_class_id_foreign');
            $table->dropColumn('class_id');
            $table->boolean('spell')->default(false)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('powers', function (Blueprint $table) {
            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->dropColumn('spell');
        });
    }
}