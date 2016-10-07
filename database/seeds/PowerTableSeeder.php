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

        Power::create(array('name' => 'LIFE', 'description' => 'Gain additional life.', 'type' => 0));
        Power::create(array('name' => 'FORCE', 'description' => 'Gain additional force.', 'type' => 0));
        Power::create(array('name' => 'INTELLIGENCE', 'description' => 'Gain additional intelligence.', 'type' => 0));
        Power::create(array('name' => 'DEFENCE', 'description' => 'Gain additional defence.', 'type' => 0));
        Power::create(array('name' => 'RESILIENCE', 'description' => 'Gain additional resilience.', 'type' => 0));
        Power::create(array('name' => 'LUCK', 'description' => 'Gain additional luck.', 'type' => 0));
        Power::create(array('name' => 'SPEED', 'description' => 'Gain additional speed.', 'type' => 0));
        Power::create(array('name' => 'MOVEMENT', 'description' => 'Gain and additional movement point.', 'type' => 0));

        Power::create(array('name' => 'NIGHTMARE', 'description' => 'Applies a debuff on the taget, which takes magical damages each time it moves.', 'type' => 2));
        Power::create(array('name' => 'CLAIRVOYANCE', 'description' => 'Dispells the invisibility of all opponents in range.', 'type' => 2));
        Power::create(array('name' => 'CURSE', 'description' => 'Curses a player, making him take magical damages each turn.', 'type' => 2));
        Power::create(array('name' => 'TRANCE', 'description' => 'Increases the duration of casted debuffs by 1 turn. Reduces the duration of taken debuffs by 1 turn.', 'type' => 1));
        Power::create(array('name' => 'REVELATION', 'description' => 'See the closest invisible players.', 'type' => 1));

        Power::create(array('name' => 'FIREBALL', 'description' => 'Launches a fire ball at a location, dealing magical damages.', 'type' => 2));
        Power::create(array('name' => 'METEOR', 'description' => 'Deals magical damages to all entities within an area. Can be used without line of sight.', 'type' => 2));
        Power::create(array('name' => 'COLD_FEETS', 'description' => 'Freezes the target, dealing little magical damages but making him unable to move for the next turn.', 'type' => 2));
        Power::create(array('name' => 'OFFENSIVES_SENSES', 'description' => 'Double all magical damages dealt and all damages taken.', 'type' => 1));
        Power::create(array('name' => 'DAMAGE_ZONE', 'description' => 'Inflicts damages to all closed by enemies each turn.', 'type' => 1));

        Power::create(array('name' => 'FIRE_TRAP', 'description' => 'Places a trap on the map which deals mafical damages when walked over.', 'type' => 2));
        Power::create(array('name' => 'SNARE_TRAP', 'description' => 'Places a trap on the map which remove movement points when walked over.', 'type' => 2));
        Power::create(array('name' => 'STUN_TRAP', 'description' => 'Places a trap on the map which stun the target when walked over.', 'type' => 2));
        Power::create(array('name' => 'CAREFUL', 'description' => 'Do not trigger allies traps.', 'type' => 1));
        Power::create(array('name' => 'FAR_SIGHT', 'description' => 'Adds more range to all abilities.', 'type' => 1));

        Power::create(array('name' => 'SNIPE', 'description' => 'Shoots an arrow from far away.', 'type' => 2));
        Power::create(array('name' => 'DAZZLE', 'description' => 'Shoots a target. Stun if there is an entity behind it. If the entity is an enemy, both are stunned.', 'type' => 2));
        Power::create(array('name' => 'GHOST_ARROW', 'description' => 'Shoots every entities in range.', 'type' => 2));
        Power::create(array('name' => 'POISON', 'description' => 'Each physical attack has a chance to poison the target.', 'type' => 1));
        Power::create(array('name' => 'SNIPER', 'description' => 'Increases range when motionless.', 'type' => 1));

        Power::create(array('name' => 'SHADOW_WALK', 'description' => 'Becomes invisible for the next turn. Ends if the player attacks or receives damages during the skill.', 'type' => 2));
        Power::create(array('name' => 'HEAVY_POISON', 'description' => 'Reduces the movement of the target by 4 during 2 turns.', 'type' => 2));
        Power::create(array('name' => 'DAZZLING_POISON', 'description' => 'The target can not use an ability next turn.', 'type' => 2));
        Power::create(array('name' => 'SNEAKY', 'description' => 'Deals more damage when attacking an enemy from behind.', 'type' => 1));
        Power::create(array('name' => 'LUCKY_FOOT', 'description' => 'Do not trigger traps.', 'type' => 1));

        Power::create(array('name' => 'SMASH', 'description' => 'Frontal smash dealing zone physical damages.', 'type' => 2));
        Power::create(array('name' => 'BLADESTORM', 'description' => 'Blade swing dealing zone physical damages.', 'type' => 2));
        Power::create(array('name' => 'ENHANCED_SWORD', 'description' => 'The next attack ignores armor and resilience and deal additional magic damages.', 'type' => 2));
        Power::create(array('name' => 'PENETRATION', 'description' => 'Attacks ignore a part of the targets armor.', 'type' => 1));
        Power::create(array('name' => 'AVENGER', 'description' => 'Increases attack depending on health lost.', 'type' => 1));

        Power::create(array('name' => 'SHIELD_BREAK', 'description' => 'Pushes back the entities around the player.', 'type' => 2));
        Power::create(array('name' => 'SHIELD_BUMP', 'description' => 'Pushes back an enemy.', 'type' => 2));
        Power::create(array('name' => 'GREAT_WALL', 'description' => 'The character takes a defensive stance, gaining armor but losing movement points.', 'type' => 2));
        Power::create(array('name' => 'LAST_MAN_STANDING', 'description' => 'Increases armor depending on health lost.', 'type' => 1));
        Power::create(array('name' => 'WAY_OF_THE_SHIELD', 'description' => 'Halve physical damages taken and damages dealt. Reduces movement points by 1.', 'type' => 1));

        Power::create(array('name' => 'HOLY_HAND', 'description' => 'Heals a character.', 'type' => 2));
        Power::create(array('name' => 'DIVINE_PROTECTION', 'description' => 'Applies a shield on all the entities within a zone. Also works on enemies.', 'type' => 2));
        Power::create(array('name' => 'SHIELDIFY', 'description' => 'Slightly increases the armor of an ally.', 'type' => 2));
        Power::create(array('name' => 'PHOENIX', 'description' => 'Revives on time with 10% HP.', 'type' => 1));
        Power::create(array('name' => 'HOLY_WELL', 'description' => 'Heals every allies within range each turn.', 'type' => 1));
    }
}
