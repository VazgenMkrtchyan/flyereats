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

Route::group(['middleware' => ['admin.auth', 'admin.allowed']], function() {

	//USERS
	generateResourceURLS(['in', 'cr', 'st', 'ed', 'up'], 'Admin\UsersController', 'admin/users', 'admin.users');

	//approves user
	Route::get('admin/users/{userId}/approve', [
		'as' => 'admin.users.approve',
		'uses' => 'Admin\UsersController@approveUser',
		'middleware' => 'notDemo'
	]);
	//rejects user
	Route::get('admin/users/{userId}/reject', [
		'as' => 'admin.users.reject',
		'uses' => 'Admin\UsersController@rejectUser',
		'middleware' => 'notDemo'
	]);
	//undoes user reject
	Route::get('admin/users/{userId}/undoreject', [
		'as' => 'admin.users.undoreject',
		'uses' => 'Admin\UsersController@undoRejectUser',
		'middleware' => 'notDemo'
	]);
	//delete user page
	Route::get('admin/users/{userId}/delete', [
		'as' => 'admin.users.delete',
		'uses' => 'Admin\UsersController@deleteUser'
	]);
	//delete user request
	Route::delete('admin/users/{userId}/delete', [
		'as' => 'admin.users.destroy',
		'uses' => 'Admin\UsersController@destroy',
		'middleware' => 'notDemo'
	]);

});
 