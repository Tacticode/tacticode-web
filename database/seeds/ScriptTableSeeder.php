<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Script;

class ScriptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scripts')->delete();

        Script::create(array('name' => 'Super Script', 'content' => '', 'user_id' => 1));
        Script::create(array('name' => 'Secret Plan', 'content' => '', 'user_id' => 2));
    }
}
