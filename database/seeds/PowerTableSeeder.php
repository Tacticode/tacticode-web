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

        Power::create(array('name' => 'LIFE', 'description' => 'Gain additional life.', 'spell' => false));
        Power::create(array('name' => 'FORCE', 'description' => 'Gain additional force.', 'spell' => false));
        Power::create(array('name' => 'INTELLIGENCE', 'description' => 'Gain additional intelligence.', 'spell' => false));
        Power::create(array('name' => 'DEFENCE', 'description' => 'Gain additional defence.', 'spell' => false));
        Power::create(array('name' => 'RESILIENCE', 'description' => 'Gain additional resilience.', 'spell' => false));
        Power::create(array('name' => 'LUCK', 'description' => 'Gain additional luck.', 'spell' => false));
        Power::create(array('name' => 'MOVEMENT', 'description' => 'Gain and additional movement point.', 'spell' => false));

        Power::create(array('name' => 'NIGHTMARE', 'description' => 'Applies a debuff on the taget, which takes magical damages each time it moves.', 'spell' => true));
        Power::create(array('name' => 'CLAIRVOYANCE', 'description' => 'Dispells the invisibility of all opponents in range.', 'spell' => true));
        Power::create(array('name' => 'CURSE', 'description' => 'Curses a player, making him take magical damages each turn.', 'spell' => true));
        Power::create(array('name' => 'TRANCE', 'description' => 'Increases the duration of casted debuffs by 1 turn. Reduces the duration of taken debuffs by 1 turn.', 'spell' => false));
        Power::create(array('name' => 'REVELATION', 'description' => 'See the closest invisible players.', 'spell' => false));

        Power::create(array('name' => 'FIREBALL', 'description' => 'Launches a fire ball at a location, dealing magical damages.', 'spell' => true));
        Power::create(array('name' => 'METEOR', 'description' => 'Deals magical damages to all entities within an area. Can be used without line of sight.', 'spell' => true));
        Power::create(array('name' => 'COLD_FEETS', 'description' => 'Freezes the target, dealing little magical damages but making him unable to move for the next turn.', 'spell' => true));
        Power::create(array('name' => 'OFFENSIVES_SENSES', 'description' => 'Double all magical damages dealt and all damages taken.', 'spell' => false));
        Power::create(array('name' => 'DAMAGE_ZONE', 'description' => 'Inflicts damages to all closed by enemies each turn.', 'spell' => false));

        Power::create(array('name' => 'FIRE_TRAP', 'description' => 'Places a trap on the map which deals mafical damages when walked over.', 'spell' => true));
        Power::create(array('name' => 'SNARE_TRAP', 'description' => 'Places a trap on the map which remove movement points when walked over.', 'spell' => true));
        Power::create(array('name' => 'STUN_TRAP', 'description' => 'Places a trap on the map which stun the target when walked over.', 'spell' => true));
        Power::create(array('name' => 'CAREFUL', 'description' => 'Do not trigger allies traps.', 'spell' => false));
        Power::create(array('name' => 'FAR_SIGHT', 'description' => 'Adds more range to all abilities.', 'spell' => false));

        Power::create(array('name' => 'SNIPE', 'description' => 'Shoots an arrow from far away.', 'spell' => true));
        Power::create(array('name' => 'DAZZLE', 'description' => 'Shoots a target. Stun if there is an entity behind it. If the entity is an enemy, both are stunned.', 'spell' => true));
        Power::create(array('name' => 'GHOST_ARROW', 'description' => 'Shoots every entities in range.', 'spell' => true));
        Power::create(array('name' => 'POISON', 'description' => 'Each physical attack has a chance to poison the target.', 'spell' => false));
        Power::create(array('name' => 'SNIPER', 'description' => 'Increases range when motionless.', 'spell' => false));

        Power::create(array('name' => 'SHADOW_WALK', 'description' => 'Becomes invisible for the next turn. Ends if the player attacks or receives damages during the skill.', 'spell' => true));
        Power::create(array('name' => 'HEAVY_POISON', 'description' => 'Reduces the movement of the target by 4 during 2 turns.', 'spell' => true));
        Power::create(array('name' => 'DAZZLING_POISON', 'description' => 'The target can not use an ability next turn.', 'spell' => true));
        Power::create(array('name' => 'SNEAKY', 'description' => 'Deals more damage when attacking an enemy from behind.', 'spell' => false));
        Power::create(array('name' => 'LUCKY_FOOT', 'description' => 'Do not trigger traps.', 'spell' => false));

        Power::create(array('name' => 'SMASH', 'description' => 'Frontal smash dealing zone physical damages.', 'spell' => true));
        Power::create(array('name' => 'BLADESTORM', 'description' => 'Blade swing dealing zone physical damages.', 'spell' => true));
        Power::create(array('name' => 'ENHANCED_SWORD', 'description' => 'The next attack ignores armor and resilience and deal additional magic damages.', 'spell' => true));
        Power::create(array('name' => 'PENETRATION', 'description' => 'Attacks ignore a part of the targets armor.', 'spell' => false));
        Power::create(array('name' => 'AVENGER', 'description' => 'Increases attack depending on health lost.', 'spell' => false));

        Power::create(array('name' => 'SHIELD_BREAK', 'description' => 'Pushes back the entities around the player.', 'spell' => true));
        Power::create(array('name' => 'SHIELD_BUMP', 'description' => 'Pushes back an enemy.', 'spell' => true));
        Power::create(array('name' => 'GREAT_WALL', 'description' => 'The character takes a defensive stance, gaining armor but losing movement points.', 'spell' => true));
        Power::create(array('name' => 'LAST_MAN_STANDING', 'description' => 'Increases armor depending on health lost.', 'spell' => false));
        Power::create(array('name' => 'WAY_OF_THE_SHIELD', 'description' => 'Halve physical damages taken and damages dealt. Reduces movement points by 1.', 'spell' => false));

        Power::create(array('name' => 'HOLY_HAND', 'description' => 'Heals a character.', 'spell' => true));
        Power::create(array('name' => 'DIVINE_PROTECTION', 'description' => 'Applies a shield on all the entities within a zone. Also works on enemies.', 'spell' => true));
        Power::create(array('name' => 'SHIELDIFY', 'description' => 'Slightly increases the armor of an ally.', 'spell' => true));
        Power::create(array('name' => 'PHOENIX', 'description' => 'Revives on time with 10% HP.', 'spell' => false));
        Power::create(array('name' => 'HOLY_WELL', 'description' => 'Heals every allies within range each turn.', 'spell' => false));
    }
}
