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

Route::get('/', 'PagesController@index');
Route::get('home', 'PagesController@home');

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

/** Registration routes */
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

/** Questions routes */
Route::group(['prefix' => 'question'], function(){
	Route::get('posts', 'ForumController@getPost');
	Route::post('posts', 'ForumController@postQuestion');
	Route::delete('posts', 'ForumController@deleteQuestion');
	Route::get('{slug}', 'ForumController@viewPost');
	Route::post('reply', 'ForumController@saveReply');
	Route::delete('reply', 'ForumController@deleteReply');
});



