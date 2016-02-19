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

        Path::create(array('node_from' => 1, 'node_to' => 5));
    }
}
