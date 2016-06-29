<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Team;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->delete();

        $team1 = Team::create(array('name' => 'La super team de GDF', 'user_id' => 1, 'visible' => 1));
        $team1->character()->sync([2, 3, 4]);

        $team2 = Team::create(array('name' => 'La super team de Poney', 'user_id' => 2, 'visible' => 1));
        $team2->character()->sync([6, 7, 8]);

        $team3 = Team::create(array('name' => 'Team EIP', 'user_id' => 3, 'visible' => 1));
        $team3->character()->sync([9, 10]);
        $team4 = Team::create(array('name' => 'Team Admin', 'user_id' => 4, 'visible' => 1));
        $team4->character()->sync([11, 12]);
	}
}
