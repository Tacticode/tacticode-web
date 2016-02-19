<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Race;

class RaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('races')->delete();

        Race::create(array('name' => 'Human'));
        Race::create(array('name' => 'Goblin'));
        Race::create(array('name' => 'Orc'));
        Race::create(array('name' => 'Elf'));
	}
}
