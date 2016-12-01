<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Tutorial;

class TutorialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tutorials')->delete();

        Tutorial::create(array('title' => 'Welcome!', 'message' => 'Welcome on Tacticode!<br>Firstly, create a character with the link on your left.'));
        Tutorial::create(array('title' => 'Scripts!', 'message' => 'Good!<br>Now that you have a character, you can create a script.<br>Go to the script interface and create a script with the exemple script.'));
        Tutorial::create(array('title' => 'Ready?', 'message' => 'Yeah! You now have a character almost ready to fight, go to the character interface and asign your script to your character.'));
        Tutorial::create(array('title' => 'Fight!', 'message' => 'This is it, your character is finally ready to make his first battle!<br>Go to the arena and launch a solo fight.'));
        Tutorial::create(array('title' => 'Together you are stronger.', 'message' => 'Now that your first fight is over, you may wanna go to the serious level.<br>Go create a second character and make your first team.'));
        Tutorial::create(array('title' => 'This, is, sparta!!', 'message' => 'Your team is thirsty for blood, go to the arena and perform your first team fight!'));
        Tutorial::create(array('title' => 'After all it\'s just magic', 'message' => 'Characters and scripts are a good thing, but not very effective alone. Go to one of your character edition and choose him at least one power.'));
        Tutorial::create(array('title' => 'But where are the others?', 'message' => 'You are now a master of tacticode, go scream it on the chat on your right!'));
        Tutorial::create(array('title' => 'Congratulations!', 'message' => 'Congrats!<br>The tutorial is over, it is now time for you to fly with your own wings, good luck and have fun on Tacticode!'));
    }
}
