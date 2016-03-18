<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Character;

class CharacterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('characters')->delete();

        Character::create(array('name' => 'Toto', 'race_id' => 1, 'user_id' => 1, 'script_id' => 1));
        Character::create(array('name' => 'Tata', 'race_id' => 2, 'user_id' => 1, 'script_id' => 1));
        Character::create(array('name' => 'Titi', 'race_id' => 3, 'user_id' => 1, 'script_id' => 1));
        Character::create(array('name' => 'Tutu', 'race_id' => 4, 'user_id' => 1, 'script_id' => 1));

        Character::create(array('name' => 'Poudre', 'race_id' => 1, 'user_id' => 2, 'script_id' => 2));
        Character::create(array('name' => 'De ', 'race_id' => 2, 'user_id' => 2, 'script_id' => 2));
        Character::create(array('name' => 'Perlin', 'race_id' => 3, 'user_id' => 2, 'script_id' => 2));
        Character::create(array('name' => 'Pinpin', 'race_id' => 4, 'user_id' => 2, 'script_id' => 2));
    }
}
