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

Route::get('/terms', function() {
	return view('welcome.terms');
});

Route::post('/login', 'AuthController@login');

Route::get('/logout', 'AuthController@logout');

Route::get('/register', 'UsersController@create');
Route::post('/register', 'UsersController@store');
Route::get('/dashboard', 'UsersController@index');

Route::get('/checkloginexists/{login}', 'UsersController@loginexists');
Route::get('/checkemailexists/{email}', 'UsersController@emailexists');

Route::get('/user', 'UsersController@edit');
Route::get('/users/{id}', 'UsersController@show');
Route::post('/user', 'UsersController@update');
Route::post('/changepassword', 'UsersController@updatePassword');

Route::get('/messages', 'MessagesController@index');
Route::get('/messages/add', 'MessagesController@create');
Route::post('/messages/add', 'MessagesController@store');

Route::get('/leaderboard', 'UsersController@leaderboard');

Route::get('/characters', 'CharactersController@index');
Route::get('/characters/add', 'CharactersController@create');
Route::post('/characters/add', 'CharactersController@store');
Route::get('/characters/delete/{id}', 'CharactersController@delete');
Route::post('/characters/buynode', 'PowersController@buyNode');
Route::post('/characters/sellnode', 'PowersController@sellNode');
Route::post('/characters/resetpower', 'PowersController@resetPower');
Route::post('/characters/setvisibility', 'CharactersController@setVisibility');
Route::get('/characters/{id}', 'CharactersController@view');
Route::get('/characters/{id}', 'CharactersController@view');
Route::post('/characters/{id}', 'CharactersController@update');
Route::get('/characters/{id}/powers', 'PowersController@view');
Route::get('/characters/{id}/powersinfos', 'PowersController@powersInfos');

Route::get('/teams', 'TeamsController@index');
Route::get('/teams/add', 'TeamsController@create');
Route::post('/teams/add', 'TeamsController@store');
Route::post('/teams/setvisibility', 'TeamsController@setVisibility');
Route::get('/teams/{id}', 'TeamsController@view');
Route::post('/teams/{id}', 'TeamsController@update');
Route::get('/teams/delete/{id}', 'TeamsController@delete');

Route::get('/arena', 'FightsController@arena');
Route::get('/arena/solofight', 'FightsController@soloFight');
Route::get('/arena/solofight/{characterId}', 'FightsController@launchSoloFight');
Route::get('/arena/teamfight', 'FightsController@teamFight');
Route::get('/arena/teamfight/{teamId}', 'FightsController@launchTeamFight');
Route::get('/arena/viewfight/{fightId}', 'FightsController@viewFight');
Route::get('/arena/contentfight/{fightId}', 'FightsController@contentFight');

Route::get('/scripts', 'ScriptsController@index');
Route::get('/scripts/add', 'ScriptsController@create');
Route::post('/scripts/add', 'ScriptsController@store');
Route::get('/scripts/delete/{id}', 'ScriptsController@delete');
Route::get('/scripts/{id}', 'ScriptsController@view');
Route::post('/scripts/{id}', 'ScriptsController@update');

Route::get('/administration', 'AdministrationController@index');
Route::get('/administration/logas/{id}', 'AdministrationController@logAs');
Route::get('/administration/logback', 'AdministrationController@logBack');
Route::get('/administration/bann/{id}', 'AdministrationController@bann');
Route::get('/administration/unbann/{id}', 'AdministrationController@unbann');
