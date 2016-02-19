<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        Group::create(array('name' => 'ADMIN'));
        Group::create(array('name' => 'USER'));
    }
}
