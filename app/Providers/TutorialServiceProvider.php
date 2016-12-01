<?php

namespace App\Providers;

use App\Http\Models\Tutorial;
use App\Http\Models\Fight;

use Illuminate\Support\ServiceProvider;

class TutorialServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.dashboard', function($view) {

            if (!\Session::has('showTuto'))
                \Session::set('showTuto', false);

            $user = \Auth::user();
            if ($user->tutorial_id < 0)
                return;

            $max = Tutorial::count();

            $function = "tuto" . $user->tutorial_id;
            if (!\Session::get('showTuto') && $this->$function())
            {
                $user->tutorial_id++;
                if ($user->tutorial_id > $max)
                    $user->tutorial_id = -1;
                $user->save();
                \Session::set('showTuto', true);
            }
            if (isset($user->tutorial->id))
            {
                $tutorial = [
                    'title' => $user->tutorial->title,
                    'message' => $user->tutorial->message,
                    'step' => $user->tutorial->id,
                    'totalStep' => $max
                ];
                $view->with('tutorial', $tutorial);                
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Start of the tutorial
     *
     * @return boolean
     */
    private function tuto0()
    {
        return true;
    }

    /**
     * Step1 of the tutorial
     * Goal is to create a character
     *
     * @return boolean
     */
    private function tuto1()
    {
        if (count(\Auth::user()->character) > 0)
            return true;
        return false;
    }

    /**
     * Step2 of the tutorial
     * Goal is to create a script
     *
     * @return boolean
     */
    private function tuto2()
    {
        if (count(\Auth::user()->script) > 0)
            return true;
        return false;
    }

    /**
     * Step3 of the tutorial
     * Goal is to assign a script to a character
     *
     * @return boolean
     */
    private function tuto3()
    {
        foreach (\Auth::user()->character as $character) {
            if ($character->script_id)
                return true;
        }
        return false;
    }

    /**
     * Step4 of the tutorial
     * Goal is to do a fight
     *
     * @return boolean
     */
    private function tuto4()
    {
        if (Fight::userFights(\Auth::user()->id)->count() > 0)
            return true;
        return false;
    }

    /**
     * Step5 of the tutorial
     * Goal is to do a team with two characters
     *
     * @return boolean
     */
    private function tuto5()
    {
        foreach (\Auth::user()->team as $team) {
            if (count($team->character) > 1)
                return true;
        }
        return false;
    }

    /**
     * Step6 of the tutorial
     * Goal is to do a fight in team
     *
     * @return boolean
     */
    private function tuto6()
    {
        foreach (Fight::select([
            'fights.id',
            'fights.result',
            'fights.created_at',
            'character_fight.elo_change',
            'character_fight.elo_result'
        ])->userFights(\Auth::user()->id)->get()->all() as $fight) {
            if (count($fight->team))
                return true;
        }
        return false;
    }

    /**
     * Step7 of the tutorial
     * Goal is to buy a node
     *
     * @return boolean
     */
    private function tuto7()
    {
        foreach (\Auth::user()->character as $character) {
            if (count($character->node) > 1)
                return true;
        }
        return false;
    }

    /**
     * Step8 of the tutorial
     * Goal is to post a message on the chat
     *
     * @return boolean
     */
    private function tuto8()
    {
        if (count(\Auth::user()->chat) > 0)
            return true;
        return false;
    }

    /**
     * Step9 of the tutorial
     * Goal is end the tutorial
     *
     * @return boolean
     */
    private function tuto9()
    {
        return true;
    }
}
