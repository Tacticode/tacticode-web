<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Notification;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->delete();

        Notification::create(array('user_id' => 1, 'title' => 'Welcome !', 'content' => 'Welcome on the site', 'seen' => 0, 'date' => '2016-04-20 16:43:46'));
        Notification::create(array('user_id' => 2, 'title' => 'Welcome !', 'content' => 'Welcome on the site', 'seen' => 0, 'date' => '2016-04-20 16:43:46'));

        Notification::create(array('user_id' => 3, 'title' => 'Welcome !', 'content' => 'Welcome on the site', 'seen' => 0, 'date' => '2016-04-20 16:43:46'));
        Notification::create(array('user_id' => 4, 'title' => 'Welcome !', 'content' => 'Welcome on the site', 'seen' => 0, 'date' => '2016-04-20 16:43:46'));
    }
}
