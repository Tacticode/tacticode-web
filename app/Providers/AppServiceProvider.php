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
                    return $unique;
                }
                $user = Auth::user();
                return ($user[$attribute] == $value) || $unique;
            }
        );

        Validator::extend(
            'script_from_user', function($attribute, $value, $parameters)
            {
                if (!Auth::check())
                {
                    return false;
                }
                $user = Auth::user();
                return ($value == 0 || \DB::table('scripts')->where(['user_id' => $user['id'], 'id' => $value]) != null);
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
