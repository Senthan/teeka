<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@index']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
// Chat room

$router->group(['prefix' => 'chat'], function ($router) {
    $router->get('/', ['as' => 'chat.index', 'uses' => 'ChatController@index']);
    $router->get('/{staff}', ['as' => 'chat.staff', 'uses' => 'ChatController@index']);
    $router->post('/group', ['as' => 'group.chat', 'uses' => 'ChatController@groupChat']);
});

// User
$router->get('user', ['as' => 'user.index', 'uses' => 'UserController@index']);
$router->get('user/search', ['as' => 'user.search', 'uses' => 'UserController@search']);
$router->get('user/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
$router->post('user', ['as' => 'resource.store', 'uses' => 'UserController@store']);

// Notes
$router->get('notes', ['as' => 'note.index', 'uses' => 'NoteController@index']);
$router->get('notes/create', ['as' => 'note.create', 'uses' => 'NoteController@create']);
$router->get('notes/{note}/share', ['as' => 'note.share', 'uses' => 'NoteController@share']);
$router->post('notes/{note}/share', ['as' => 'note.share.do', 'uses' => 'NoteController@doShare']);
$router->get('notes/{note}/edit', ['as' => 'note.edit', 'uses' => 'NoteController@edit']);
$router->get('notes/{note}', ['as' => 'note.show', 'uses' => 'NoteController@show']);
$router->get('notes/{note}/delete', ['as' => 'note.delete', 'uses' => 'NoteController@delete']);
$router->delete('notes/{note}/delete', ['as' => 'note.destroy', 'uses' => 'NoteController@destroy']);
$router->patch('notes/{note}', ['as' => 'note.update', 'uses' => 'NoteController@update']);
$router->post('notes', ['as' => 'note.store', 'uses' => 'NoteController@store']);