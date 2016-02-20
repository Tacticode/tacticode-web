<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Power;

class PowerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('powers')->delete();

        Power::create(array('name' => 'Fireball', 'description' => 'Fire a fireball.', 'spell' => true));
        Power::create(array('name' => 'Health', 'description' => 'Adds 10 hp.', 'spell' => false));
        Power::create(array('name' => 'Power 1', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 2', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 3', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 4', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 5', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 6', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 7', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 8', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 9', 'description' => 'It\'s a power', 'spell' => false));
        Power::create(array('name' => 'Power 10', 'description' => 'It\'s a power', 'spell' => false));
    }
}
