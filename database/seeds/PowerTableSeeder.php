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
    }
}
