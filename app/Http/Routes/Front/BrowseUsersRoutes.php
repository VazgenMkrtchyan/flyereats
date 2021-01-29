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

Route::get('sellers',
	[
		'as' => 'browseusers.index',
		'uses' => 'Front\BrowseUsersController@index'
	]);


Route::get('sellers/{userId}',
	[
		'as' => 'browseusers.view',
		'uses' => 'Front\BrowseUsersController@view'
	]);


##Contact User Form
Route::post('contact-user/{userId}',
	[
		'as' => 'contactuser.send',
		'uses' => 'Front\BrowseUsersController@contactUserSend'
	]);

# performs search
Route::post('do-users-search',
	[
		'as' => 'do_users_search',
		'uses' => 'Front\BrowseUsersController@doUsersSearch'
	]);