<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUserFacebookIntoNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_facebook', 255)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement('UPDATE `users` SET `id_facebook` = 0 WHERE `id_facebook` IS NULL;');
            DB::statement('ALTER TABLE `users` MODIFY `id_facebook` INTEGER UNSIGNED NOT NULL;');
        });
    }
}
