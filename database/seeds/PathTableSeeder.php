<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Path;

class PathTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paths')->delete();

        Path::create(array('node_from' => 1, 'node_to' => 11));
        Path::create(array('node_from' => 2, 'node_to' => 12));
        Path::create(array('node_from' => 3, 'node_to' => 9));
        Path::create(array('node_from' => 4, 'node_to' => 10));
        Path::create(array('node_from' => 11, 'node_to' => 7));
        Path::create(array('node_from' => 7, 'node_to' => 12));
        Path::create(array('node_from' => 12, 'node_to' => 6));
        Path::create(array('node_from' => 6, 'node_to' => 10));
        Path::create(array('node_from' => 10, 'node_to' => 8));
        Path::create(array('node_from' => 8, 'node_to' => 9));
        Path::create(array('node_from' => 9, 'node_to' => 5));
        Path::create(array('node_from' => 5, 'node_to' => 11));
        Path::create(array('node_from' => 7, 'node_to' => 15));
        Path::create(array('node_from' => 5, 'node_to' => 13));
        Path::create(array('node_from' => 6, 'node_to' => 14));
        Path::create(array('node_from' => 8, 'node_to' => 16));
    }
}
