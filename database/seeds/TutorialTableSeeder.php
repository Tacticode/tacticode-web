<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Tutorial;

class TutorialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tutorials')->delete();

        Tutorial::create(array('title' => 'Hello', 'message' => 'Hey :)'));
    }
}
