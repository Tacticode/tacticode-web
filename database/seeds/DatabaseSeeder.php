<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(GroupTableSeeder::class);
        $this->call(RaceTableSeeder::class);

        $this->call(PowerTableSeeder::class);
        $this->call(NodeTableSeeder::class);
        $this->call(PathTableSeeder::class);

        $this->call(StatsTableSeeder::class);

        $this->call(UserTableSeeder::class);
        $this->call(ScriptTableSeeder::class);
        $this->call(CharacterTableSeeder::class);
        $this->call(TeamTableSeeder::class);
        $this->call(NotificationTableSeeder::class);

        $this->call(TutorialTableSeeder::class);

        Model::reguard();
    }
}
