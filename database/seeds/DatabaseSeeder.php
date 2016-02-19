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

        Model::reguard();
    }
}
