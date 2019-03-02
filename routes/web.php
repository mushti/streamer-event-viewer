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

Route::group([
	'prefix' => 'login',
], function () {
	Route::get('/', 'LoginController@showLoginForm')->name('login');
	Route::get('twitch', 'LoginController@redirectToTwitchProvider')->name('login.twitch');
	Route::get('twitch/callback', 'LoginController@handleTwitchProviderCallback')->name('login.twitch.callback');
});

Route::post('logout', 'LoginController@logout')->name('logout');

Route::get('/{any}', 'PanelController@index')
	->where('any', '.*')->name('panel');
