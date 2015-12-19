<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Validator::extend(
            'auth_password', function($attribute, $value, $parameters)
            {
                if (!Auth::check())
                {
                    return false;
                }
                return \Hash::check($value, Auth::user()->password);
            }
        );

        Validator::extend(
            'unique_if_different_than_user', function($attribute, $value, $parameters)
            {
                $unique = \DB::table('users')->where($attribute, $value)->first() == null;
                if (!Auth::check())
                {
                    return $exist;
                }
                $user = Auth::user();
                return ($user[$attribute] == $value) || $unique;
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
