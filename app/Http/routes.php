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

Route::group(['middleware' => ['web']], function () {

  	Route::get('/{author?}', [
   		 'as' => 'home', 'uses' => 'QuoteController@getIndex'
	]);

    Route::post('/new', [
   		 'as' => 'create', 'uses' => 'QuoteController@postCreate'
	]);

	Route::get('/new/{id}', [
   		 'as' => 'delete', 'uses' => 'QuoteController@getDelete'
	]);

	Route::get('/admin/login', [
   		 'as' => 'admin.login', 'uses' => 'AdminController@getLogin'
	]);

	Route::post('/admin/login', [
   		 'as' => 'admin.userlogin', 'uses' => 'AdminController@postLogin'
	]);

	Route::get('/admin/dashboard', [
   		 'as' => 'admin.dashboard',
   		 'middleware' => 'auth',
   		 'uses' => 'AdminController@getDashboard'
	]);

	Route::get('/admin/logout', [
   		 'as' => 'admin.logout', 'uses' => 'AdminController@getLogout'
	]);
	


});
