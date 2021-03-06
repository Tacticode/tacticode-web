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

        $character1 = Character::create(array('name' => 'Toto', 'race_id' => 1, 'user_id' => 1, 'script_id' => 1, 'visible' => 1));
        $character1->node()->sync([1]);
        $character2 = Character::create(array('name' => 'Tata', 'race_id' => 2, 'user_id' => 1, 'script_id' => 1, 'visible' => 1));
        $character2->node()->sync([2]);
        $character3 = Character::create(array('name' => 'Titi', 'race_id' => 3, 'user_id' => 1, 'script_id' => 1, 'visible' => 1));
        $character3->node()->sync([3]);
        $character4 = Character::create(array('name' => 'Tutu', 'race_id' => 4, 'user_id' => 1, 'script_id' => 1, 'visible' => 1));
        $character4->node()->sync([4]);

        $character5 = Character::create(array('name' => 'Poudre', 'race_id' => 1, 'user_id' => 2, 'script_id' => 2, 'visible' => 1));
        $character5->node()->sync([1]);
        $character6 = Character::create(array('name' => 'De ', 'race_id' => 2, 'user_id' => 2, 'script_id' => 2, 'visible' => 1));
        $character6->node()->sync([2]);
        $character7 = Character::create(array('name' => 'Perlin', 'race_id' => 3, 'user_id' => 2, 'script_id' => 2, 'visible' => 1));
        $character7->node()->sync([3]);
        $character8 = Character::create(array('name' => 'Pinpin', 'race_id' => 4, 'user_id' => 2, 'script_id' => 2, 'visible' => 1));
        $character8->node()->sync([4]);

        $characterEip1 = Character::create(array('name' => 'Lab', 'race_id' => 2, 'user_id' => 3, 'script_id' => 3, 'visible' => 1));
        $characterEip1->node()->sync([2]);
        $characterEip2 = Character::create(array('name' => 'EIP', 'race_id' => 3, 'user_id' => 3, 'script_id' => 4, 'visible' => 1));
        $characterEip2->node()->sync([3]);
        $characterAdmin1 = Character::create(array('name' => 'Jean', 'race_id' => 4, 'user_id' => 4, 'script_id' => 5, 'visible' => 1));
        $characterAdmin1->node()->sync([4]);
        $characterAdmin2 = Character::create(array('name' => 'Michelle', 'race_id' => 1, 'user_id' => 4, 'script_id' => 6, 'visible' => 1));
        $characterAdmin2->node()->sync([1]);
    }
}
