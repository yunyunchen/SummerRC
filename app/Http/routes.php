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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('home', 'HomeController@index');*/

Route::get('/', 'HomeController@index');

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/

Route::get('auth/login','Manage\AuthController@getLogin');
Route::post('auth/login','Manage\AuthController@postLogin');
Route::get('auth/logout','Manage\AuthController@getLogout');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'admin_login'],function(){
	Route::get('/','AdminHomeController@index');
	Route::resource('pages', 'PagesController');
	Route::resource('comments','CommentsController');
});

Route::post('comment/store', 'CommentsController@store');


Route::group(['prefix'=>'admin','namespace'=>'IM','middleware'=>'admin_login'],function(){
	Route::resource('story', 'StoryController');
	/*Route::get('story/delStatus', [
			'as' => 'delStatus', 'uses' => 'StoryController@delStatus'
	]);*/

	Route::get('story/{id}/delStatus', 'StoryController@delStatus');

});

/*Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth'],function(){
	Route::get('/','AdminHomeController');
	Route::resource('pages','PagesController');
	Route::resource('comments','CommentsController');
});*/
