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

Route::get('/', 'AppController@index');

Route::post('/login', 'AuthController@login');

Route::get('/logout', 'AuthController@logout');

Route::get('/register', 'UsersController@create');
Route::post('/register', 'UsersController@store');
Route::get('/dashboard', 'UsersController@index');

Route::get('/checkloginexists/{login}', 'UsersController@loginexists');
Route::get('/checkemailexists/{email}', 'UsersController@emailexists');

Route::get('/user', 'UsersController@edit');
Route::post('/user', 'UsersController@update');
Route::post('/changepassword', 'UsersController@updatePassword');

Route::get('/characters', 'CharactersController@index');
Route::get('/characters/add', 'CharactersController@create');
Route::post('/characters/add', 'CharactersController@store');
Route::get('/characters/delete/{id}', 'CharactersController@delete');
Route::get('/characters/{id}', 'CharactersController@view');
Route::post('/characters/{id}', 'CharactersController@update');

Route::get('/scripts', 'ScriptsController@index');
Route::get('/scripts/add', 'ScriptsController@create');
Route::post('/scripts/add', 'ScriptsController@store');
Route::get('/scripts/delete/{id}', 'ScriptsController@delete');
Route::get('/scripts/{id}', 'ScriptsController@view');
Route::post('/scripts/{id}', 'ScriptsController@update');