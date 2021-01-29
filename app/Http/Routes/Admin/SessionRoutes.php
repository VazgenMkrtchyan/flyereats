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
Route::get('admin/login',
	[
		'as' => 'admin.sessions.create',
		'uses' => 'Admin\SessionsController@create',
		'middleware' => ['admin.guest']
	]);

Route::post('admin/login',
	[
		'as' => 'admin.sessions.store',
		'uses' => 'Admin\SessionsController@store',
		'middleware' => ['admin.guest']
	]);

Route::get('admin/logout',
	[
		'as' => 'admin.sessions.destroy',
		'uses' => 'Admin\SessionsController@destroy',
		'middleware' => ['admin.auth']
	]);