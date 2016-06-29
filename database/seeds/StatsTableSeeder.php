<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Stat;

class StatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stats')->delete();

        Stat::create(array('name' => 'HP', 'default' => 50, 'increase' => 5));
        Stat::create(array('name' => 'FORCE', 'default' => 10, 'increase' => 5));
        Stat::create(array('name' => 'INTELLIGENCE', 'default' => 10, 'increase' => 5));
        Stat::create(array('name' => 'DEFENCE', 'default' => 0, 'increase' => 5));
        Stat::create(array('name' => 'RESILIENCE', 'default' => 0, 'increase' => 5));
        Stat::create(array('name' => 'LUCK', 'default' => 5, 'increase' => 0.1));
        Stat::create(array('name' => 'SPEED', 'default' => 0, 'increase' => 0));
        Stat::create(array('name' => 'MOVEMENT', 'default' => 5, 'increase' => 0));
    }
}
