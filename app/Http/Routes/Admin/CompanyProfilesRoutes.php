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

//COMPANY PROFILE ROUTES

	//COMPANY PROFILES
	generateResourceURLS(['in', 'cr', 'st', 'ed', 'up', 'de'], 'Admin\CompanyProfilesController', 'admin/company-profiles', 'admin.company-profiles');

	//COMPANY PROFILE LOGO ROUTES
	Route::post('admin/company-profiles/{companyProfileId}/uploadlogo',
		[
			'as' => 'admin.company-profiles.uploadlogo',
			'uses' => 'Admin\CompanyProfilesController@uploadLogo',
			'middleware' => 'notDemo'
		]);

	Route::get('admin/company-profiles/{companyProfileId}/deletelogo',
		[
			'as' => 'admin.company-profiles.deletelogo',
			'uses' => 'Admin\CompanyProfilesController@deleteLogo',
			'middleware' => 'notDemo'
		]);

});