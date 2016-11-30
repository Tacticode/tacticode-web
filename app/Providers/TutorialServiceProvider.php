<?php

namespace App\Providers;

use App\Http\Models\Tutorial;

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
        if (!\Session::has('showTuto'))
            \Session::set('showTuto', true);

        view()->composer('layouts.dashboard', function($view) {

            $user = auth()->user();
            $max = Tutorial::count();
            if ($user->tutorial_id < 0)
                return;

            $function = "tuto" . $user->tutorial_id;
            if ($this->$function($user))
            {
                $user->tutorial_id += 1;
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
    public function tuto0($user)
    {
        return true;
    }

    /**
     * Step1 of the tutorial
     *
     * @return boolean
     */
    public function tuto1($user)
    {
        return false;
    }  
}
