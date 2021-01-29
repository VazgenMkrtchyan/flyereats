<?php
/**
 *
 * This file is part of the software provided by AppsWWW <http://www.appswww.com>
 *
 * Reproduce, re-sell, distribute, sublicense, disclose, market,
 * rent, lease or transfer the Licensed Software is not permitted
 * by this Agreement
 *
 *
 * For full copyright and license information, please visit
 * http://www.appswww.com/license-agreement/
 *
 * @copyright (c) Laimonas Prei (l.preisas@gmail.com)
 */

# Authentication
Route::get('login',
	[
		'as' => 'sessions.create',
		'uses' => 'Front\SessionsController@create',
		'middleware' => 'guest'
	]);

Route::post('login',
	[
		'as' => 'sessions.store',
		'uses' => 'Front\SessionsController@store',
		'middleware' => 'guest'
	]);

Route::get('logout',[
	'as' => 'sessions.destroy',
	'uses' => 'Front\SessionsController@destroy',
	'middleware' => 'auth'
]);

## PASSWORD RESETS ##
Route::get('password/remind',[
	'as' => 'password.getRemind',
	'uses' => 'Front\PasswordResetsController@getEmail',
	'middleware' => 'guest'
]);

Route::post('password/remind',[
	'as' => 'password.postRemind',
	'uses' => 'Front\PasswordResetsController@postEmail',
	'middleware' => 'guest'
]);

Route::get('password/reset/{token}',[
	'as' => 'password.getReset',
	'uses' => 'Front\PasswordResetsController@getReset',
	'middleware' => 'guest'
]);

Route::post('password/reset',[
	'as' => 'password.postReset',
	'uses' => 'Front\PasswordResetsController@postReset',
	'middleware' => 'guest'
]);