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

        Node::create(array('race_id' => 1, 'power_id' => null, 'pos_x' => 320, 'pos_y' => 220));
        Node::create(array('race_id' => 2, 'power_id' => null, 'pos_x' => 480, 'pos_y' => 220));
        Node::create(array('race_id' => 3, 'power_id' => null, 'pos_x' => 320, 'pos_y' => 380));
        Node::create(array('race_id' => 4, 'power_id' => null, 'pos_x' => 480, 'pos_y' => 380));

        Node::create(array('race_id' => null, 'power_id' => 1, 'pos_x' => 350, 'pos_y' => 300));
        Node::create(array('race_id' => null, 'power_id' => 2, 'pos_x' => 450, 'pos_y' => 300));
        Node::create(array('race_id' => null, 'power_id' => 3, 'pos_x' => 400, 'pos_y' => 250));
        Node::create(array('race_id' => null, 'power_id' => 4, 'pos_x' => 400, 'pos_y' => 350));
        Node::create(array('race_id' => null, 'power_id' => 5, 'pos_x' => 375, 'pos_y' => 325));
        Node::create(array('race_id' => null, 'power_id' => 6, 'pos_x' => 425, 'pos_y' => 325));
        Node::create(array('race_id' => null, 'power_id' => 7, 'pos_x' => 375, 'pos_y' => 275));
        Node::create(array('race_id' => null, 'power_id' => 8, 'pos_x' => 425, 'pos_y' => 275));
        Node::create(array('race_id' => null, 'power_id' => 9, 'pos_x' => 300, 'pos_y' => 300));
        Node::create(array('race_id' => null, 'power_id' => 10, 'pos_x' => 500, 'pos_y' => 300));
        Node::create(array('race_id' => null, 'power_id' => 11, 'pos_x' => 400, 'pos_y' => 200));
        Node::create(array('race_id' => null, 'power_id' => 12, 'pos_x' => 400, 'pos_y' => 400));
    }
}
