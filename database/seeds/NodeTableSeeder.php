<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Node;

class NodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nodes')->delete();

        Node::create(array('race_id' => 1, 'power_id' => null, 'pos_x' => 50, 'pos_y' => 50));
        Node::create(array('race_id' => 2, 'power_id' => null, 'pos_x' => 50, 'pos_y' => 100));
        Node::create(array('race_id' => 3, 'power_id' => null, 'pos_x' => 100, 'pos_y' => 50));
        Node::create(array('race_id' => 4, 'power_id' => null, 'pos_x' => 100, 'pos_y' => 100));

        Node::create(array('race_id' => null, 'power_id' => 1, 'pos_x' => 0, 'pos_y' => 0));
        Node::create(array('race_id' => null, 'power_id' => 2, 'pos_x' => 0, 'pos_y' => 20));
    }
}
