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

        Power::create(array('name' => 'Life', 'description' => 'Gain additional life.', 'spell' => false));
        Power::create(array('name' => 'Force', 'description' => 'Gain additional force.', 'spell' => false));
        Power::create(array('name' => 'Intelligence', 'description' => 'Gain additional intelligence.', 'spell' => false));
        Power::create(array('name' => 'Defence', 'description' => 'Gain additional defence.', 'spell' => false));
        Power::create(array('name' => 'Resilience', 'description' => 'Gain additional resilience.', 'spell' => false));
        Power::create(array('name' => 'Luck', 'description' => 'Gain additional luck.', 'spell' => false));
        Power::create(array('name' => 'Movement', 'description' => 'Gain and additional movement point.', 'spell' => false));

        Power::create(array('name' => 'Nightmare', 'description' => 'Applies a debuff on the taget, which takes magical damages each time it moves.', 'spell' => true));
        Power::create(array('name' => 'Clairvoyance', 'description' => 'Dispells the invisibility of all opponents in range.', 'spell' => true));
        Power::create(array('name' => 'Malediction', 'description' => 'Curses a player, making him take magical damages each turn.', 'spell' => true));
        Power::create(array('name' => 'Trance', 'description' => 'Increases the duration of casted debuffs by 1 turn. Reduces the duration of taken debuffs by 1 turn.', 'spell' => false));
        Power::create(array('name' => 'Revelation', 'description' => 'See the closest invisible players.', 'spell' => false));

        Power::create(array('name' => 'Fire Ball', 'description' => 'Launches a fire ball at a location, dealing magical damages.', 'spell' => true));
        Power::create(array('name' => 'Meteore', 'description' => 'Deals magical damages to all entities within an area. Can be used without line of sight.', 'spell' => true));
        Power::create(array('name' => 'Cold feets', 'description' => 'Freezes the target, dealing little magical damages but making him unable to move for the next turn.', 'spell' => true));
        Power::create(array('name' => 'Offensive Senses', 'description' => 'Double all magical damages dealt and all damages taken.', 'spell' => false));
        Power::create(array('name' => 'Damage Zone', 'description' => 'Inflicts damages to all closed by enemies each turn.', 'spell' => false));

        Power::create(array('name' => 'Fire Trap', 'description' => 'Places a trap on the map which deals mafical damages when walked over.', 'spell' => true));
        Power::create(array('name' => 'Snare Trap', 'description' => 'Places a trap on the map which remove movement points when walked over.', 'spell' => true));
        Power::create(array('name' => 'Stun Trap', 'description' => 'Places a trap on the map which stun the target when walked over.', 'spell' => true));
        Power::create(array('name' => 'Careful', 'description' => 'Do not trigger allies traps.', 'spell' => false));
        Power::create(array('name' => 'Far Sight', 'description' => 'Adds more range to all abilities.', 'spell' => false));

        Power::create(array('name' => 'Snipe', 'description' => 'Shoots an arrow from far away.', 'spell' => true));
        Power::create(array('name' => 'Dazzle', 'description' => 'Shoots a target. Stun if there is an entity behind it. If the entity is an enemy, both are stunned.', 'spell' => true));
        Power::create(array('name' => 'Ghost Arrow', 'description' => 'Shoots every entities in range.', 'spell' => true));
        Power::create(array('name' => 'Poison', 'description' => 'Each physical attack has a chance to poison the target.', 'spell' => false));
        Power::create(array('name' => 'Sniper', 'description' => 'Increases range when motionless.', 'spell' => false));

        Power::create(array('name' => 'Shadow Walk', 'description' => 'Becomes invisible for the next turn. Ends if the player attacks or receives damages during the skill.', 'spell' => true));
        Power::create(array('name' => 'Heavy Poison', 'description' => 'Reduces the movement of the target by 4 during 2 turns.', 'spell' => true));
        Power::create(array('name' => 'Dazzling Poison', 'description' => 'The target can not use an ability next turn.', 'spell' => true));
        Power::create(array('name' => 'Sneaky', 'description' => 'Deals more damage when attacking an enemy from behind.', 'spell' => false));
        Power::create(array('name' => 'Lucky Foot', 'description' => 'Do not trigger traps.', 'spell' => false));

        Power::create(array('name' => 'Smash', 'description' => 'Frontal smash dealing zone physical damages.', 'spell' => true));
        Power::create(array('name' => 'Bladestorm', 'description' => 'Blade swing dealing zone physical damages.', 'spell' => true));
        Power::create(array('name' => 'Enhanced sword', 'description' => 'The next attack ignores armor and resilience and deal additional magic damages.', 'spell' => true));
        Power::create(array('name' => 'Penetration', 'description' => 'Attacks ignore a part of the targets armor.', 'spell' => false));
        Power::create(array('name' => 'Avenger', 'description' => 'Increases attack depending on health lost.', 'spell' => false));

        Power::create(array('name' => 'Shield break', 'description' => 'Pushes back the entities around the player.', 'spell' => true));
        Power::create(array('name' => 'Shield bump', 'description' => 'Pushes back an enemy.', 'spell' => true));
        Power::create(array('name' => 'Great Wall', 'description' => 'The character takes a defensive stance, gaining armor but losing movement points.', 'spell' => true));
        Power::create(array('name' => 'Last Man Standing', 'description' => 'Increases armor depending on health lost.', 'spell' => false));
        Power::create(array('name' => 'Way Of The Shield', 'description' => 'Halve physical damages taken and damages dealt. Reduces movement points by 1.', 'spell' => false));

        Power::create(array('name' => 'Holy Hand', 'description' => 'Heals a character.', 'spell' => true));
        Power::create(array('name' => 'Divine Protection', 'description' => 'Applies a shield on all the entities within a zone. Also works on enemies.', 'spell' => true));
        Power::create(array('name' => 'Shieldify', 'description' => 'Slightly increases the armor of an ally.', 'spell' => true));
        Power::create(array('name' => 'Phoenix', 'description' => 'Revives on time with 10% HP.', 'spell' => false));
        Power::create(array('name' => 'Holy Well', 'description' => 'Heals every allies within range each turn.', 'spell' => false));
    }
}
