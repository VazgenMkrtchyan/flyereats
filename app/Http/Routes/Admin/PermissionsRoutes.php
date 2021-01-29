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


	generateResourceURLS(['in', 'cr', 'st', 'ed', 'up'], 'Admin\PermissionsController', 'admin/permissions/{permissionGroupId}', 'admin.permissions');

	//destroy
	Route::delete('admin/permissions/destroy/{permissionId}', [
		'uses' => 'Admin\PermissionsController@destroy',
		'as' => 'admin.permissions.destroy',
		'middleware' => 'notDemo'
	]);

	//update order
	Route::patch('admin/permissions/{permissionGroupId}/updateorder', [
		'uses' => 'Admin\PermissionsController@updateOrder',
		'as' => 'admin.permissions.update_order',
		'middleware' => 'notDemo'
	]);

});