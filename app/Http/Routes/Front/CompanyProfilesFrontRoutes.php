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

//FILTERS
Route::group([
	'middleware' => ['auth', 'simple']],
	function() {

		//company profile routes
		generateResourceURLS(['cr', 'st'], 'Front\CompanyProfilesController', 'company-profile', 'compprofile');


		Route::get('company-profile/edit',
			[
				'as' => 'compprofile.edit',
				'uses' => 'Front\CompanyProfilesController@edit',
				'middleware' => 'notDemo'
			]);

		//updates
		Route::patch('company-profile',
			[
				'as' => 'compprofile.update',
				'uses' => 'Front\CompanyProfilesController@update',
				'middleware' => 'notDemo'
			]);

		//deletes
		Route::delete('company-profile',
			[
				'as' => 'compprofile.destroy',
				'uses' => 'Front\CompanyProfilesController@destroy',
				'middleware' => 'notDemo'
			]);

		//COMPANY PROFILE LOGO ROUTES
		Route::post('company-profile/logo/upload',
			[
				'as' => 'compprofilelogo.upload',
				'uses' => 'Front\CompanyProfilesController@uploadLogo',
				'middleware' => 'notDemo'
			]);

		Route::get('company-profile/logo/delete',
			[
				'as' => 'compprofilelogo.delete',
				'uses' => 'Front\CompanyProfilesController@deleteLogo',
				'middleware' => 'notDemo'
			]);

	});