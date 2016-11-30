<?php

namespace App\Providers;

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
        $tutorial = [
            'title' => 'Welcome!',
            'message' => 'Welcome, go create your first character lol',
            'step' => 1,
            'totalStep' => 12
        ];
        \View::share('tutorial', $tutorial);
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
}
