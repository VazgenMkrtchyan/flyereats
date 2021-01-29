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

	//CHANGE WEBSITE TYPE
	Route::post('admin/web-options/change-website-type',
		[
			'as' => 'admin.settings.changeType',
			'uses' => 'Admin\WebOptionsController@changeWebsiteType',
			'middleware' => 'notDemo'
		]);
	
//WEBSITE LOGO
	Route::post('admin/web-options/website-logo/upload',
		[
			'as' => 'admin.settings.uploadLogo',
			'uses' => 'Admin\WebOptionsController@uploadLogo',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/website-logo/delete',
		[
			'as' => 'admin.settings.deleteLogo',
			'uses' => 'Admin\WebOptionsController@deleteLogo',
			'middleware' => 'notDemo'
		]);

	//IMPORT ZIPS
	Route::post('admin/web-options/zips/import',
		[
			'as' => 'admin.settings.importZips',
			'uses' => 'Admin\WebOptionsController@importZips',
			'middleware' => 'notDemo'
		]);

	//ROUTES TO SETTINGS
	Route::get('admin/web-options/site-pref',
		[
			'as' => 'admin.settings.site-pref',
			'uses' => 'Admin\WebOptionsController@sitePrefIndex'
		]);

	Route::patch('admin/web-options/site-pref',
		[
			'as' => 'admin.settings.site-pref.update',
			'uses' => 'Admin\WebOptionsController@sitePrefUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/front-interface',
		[
			'as' => 'admin.settings.front-int',
			'uses' => 'Admin\WebOptionsController@frontIntIndex',
		]);

	Route::patch('admin/web-options/front-interface',
		[
			'as' => 'admin.settings.front-int.update',
			'uses' => 'Admin\WebOptionsController@frontIntUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/admin-interface',
		[
			'as' => 'admin.settings.admin-int',
			'uses' => 'Admin\WebOptionsController@adminIntIndex'
		]);

	Route::patch('admin/web-options/admin-interface',
		[
			'as' => 'admin.settings.admin-int.update',
			'uses' => 'Admin\WebOptionsController@adminIntUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/mail',
		[
			'as' => 'admin.settings.mail',
			'uses' => 'Admin\WebOptionsController@mailIndex'
		]);

	Route::patch('admin/web-options/mail',
		[
			'as' => 'admin.settings.mail.update',
			'uses' => 'Admin\WebOptionsController@mailUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/payment',
		[
			'as' => 'admin.settings.payment',
			'uses' => 'Admin\WebOptionsController@paymentIndex'
		]);

	Route::patch('admin/web-options/payment',
		[
			'as' => 'admin.settings.payment.update',
			'uses' => 'Admin\WebOptionsController@paymentUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/localization',
		[
			'as' => 'admin.settings.local',
			'uses' => 'Admin\WebOptionsController@localIndex'
		]);

	Route::patch('admin/web-options/localization',
		[
			'as' => 'admin.settings.local.update',
			'uses' => 'Admin\WebOptionsController@localUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/image',
		[
			'as' => 'admin.settings.image',
			'uses' => 'Admin\WebOptionsController@imageIndex'
		]);

	Route::patch('admin/web-options/image',
		[
			'as' => 'admin.settings.image.update',
			'uses' => 'Admin\WebOptionsController@imageUpdate',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/web-options/email-notifications',
		[
			'as' => 'admin.settings.email-not',
			'uses' => 'Admin\WebOptionsController@emailNotIndex'
		]);

	Route::patch('admin/web-options/email-notifications',
		[
			'as' => 'admin.settings.email-not.update',
			'uses' => 'Admin\WebOptionsController@emailNotUpdate',
			'middleware' => 'notDemo'
		]);

});

 