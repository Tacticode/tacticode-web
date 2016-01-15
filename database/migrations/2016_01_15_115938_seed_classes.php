<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('classes')->insert(
            [
                [
                    'name' => 'Warrior'
                ],
                [
                    'name' => 'Ranger'
                ],
                [
                    'name' => 'Mage'
                ],
                [
                    'name' => 'Priest'
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('classes')->delete();
    }
}
