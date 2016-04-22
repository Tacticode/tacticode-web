<?php

use Illuminate\Database\Seeder;
use App\Http\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(array('login' => 'GDF', 'email' => 'gdf@tacticode.fr', 'password' => '1234', 'group_id' => 1));
        User::create(array('login' => 'Poney', 'email' => 'poney@tacticode.fr', 'password' => '1234', 'group_id' => 1));
    }
}
