<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome/welcome');
});

Route::post('/login', function() {

	return view('welcome/welcome', ['error' => 'Cannot login, method is not implemented']);
});

Route::get('/logout', function() {

	return redirect('/');
});

Route::get('/register', function() {

	return view('welcome/register');
});

Route::post('/register', function() {

	return view('welcome/register', ['error' => 'Cannot register, method is not implemented', 'formError' => ['login' => 'lol'], 'fields' => ['login' => 'toto']]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
});