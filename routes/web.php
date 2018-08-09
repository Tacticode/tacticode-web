<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'AppController@index');

Route::get('/terms', function() {
	return view('welcome.terms');
});

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'UsersController@create');
Route::post('/register', 'UsersController@store');
Route::get('/dashboard', 'UsersController@index');

Route::get('/checkloginexists/{login}', 'UsersController@loginexists');
Route::get('/checkemailexists/{email}', 'UsersController@emailexists');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@beforePostEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/user', 'UsersController@edit');
Route::get('/user/{id}', 'UsersController@show');
Route::post('/user', 'UsersController@update');
Route::post('/changepassword', 'UsersController@updatePassword');

Route::get('/notifications/see', 'NotificationsController@see');
Route::get('/notifications/all', 'NotificationsController@all');

Route::get('/messages', 'MessagesController@index');
Route::get('/messages/delete/{id}', 'MessagesController@delete');
Route::get('/messages/add', 'MessagesController@create');
Route::get('/messages/add/{id}', 'MessagesController@create');
Route::post('/messages/add/', 'MessagesController@store');
Route::post('/messages/add/{id}', 'MessagesController@store');
Route::get('/messages/{id}', 'MessagesController@view');

Route::get('/tactichat/lasts', 'ChatsController@lastMessages');
Route::post('/tactichat/write/{lastMessage}', 'ChatsController@write');
Route::get('/tactichat/lastfrom/{lastMessage}', 'ChatsController@lastFrom');

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

Route::get('/adventure', 'AdventureController@index');
Route::get('/adventure/dungeons', 'AdventureController@dungeons');
Route::get('/adventure/customdungeons', 'AdventureController@customDungeons');

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

Route::get('/tools/nodebuilder', 'Tools\NodeBuilderController@index');
Route::get('/tools/nodebuilder/getTalentTree', 'Tools\NodeBuilderController@getTalentTree');
Route::post('/tools/nodebuilder/saveTalentTree', 'Tools\NodeBuilderController@saveTalentTree');