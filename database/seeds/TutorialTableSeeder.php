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

        Tutorial::create(array('title' => 'Welcome!', 'message' => 'Welcome on Tacticode!<br>Start your adventure by creating your first character with the menu on your left.'));
        Tutorial::create(array('title' => 'Script', 'message' => 'Now that you have a character, you need to create a script.<br>Go to the script menu and create a new script.<br>You can use the default script for now.'));
        Tutorial::create(array('title' => 'Preparation', 'message' => 'You have now a character almost ready to fight.<br>Go to the character interface and assign your script to your character.'));
        Tutorial::create(array('title' => 'Fight!', 'message' => 'This is it, your character is finally ready to make his first battle!<br>Go to the arena and launch a solo fight.'));
        Tutorial::create(array('title' => 'Together you are stronger.', 'message' => 'Now that your first fight is over, you may want to go further.<br>Go create a second character and make your first team.'));
        Tutorial::create(array('title' => 'This, is, sparta!!', 'message' => 'Your team is thirsty for blood, go to the arena and perform your first team fight!'));
        Tutorial::create(array('title' => 'After all it\'s just magic', 'message' => 'Characters and scripts are a good thing, but they are not really effective as they are.<br>Go on the menu of one of your character and choose him at least one power in the "Manage Power" menu.'));
        Tutorial::create(array('title' => 'But where are the others?', 'message' => 'You are now a master of tacticode, go scream it on the chat on your right!'));
        Tutorial::create(array('title' => 'Congratulations!', 'message' => 'Congrats!<br>The tutorial is over, it is now time for you to fly with your own wings, good luck and have fun on Tacticode!'));
    }
}
