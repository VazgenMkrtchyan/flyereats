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

//LISTINGS
	generateResourceURLS(['in', 'cr', 'st', 'ed', 'up', 'de'], 'Admin\ListingsController', 'admin/listings', 'admin.listings');

//approves listing
	Route::get('admin/listings/{listingId}/approve',
		[
			'as' => 'admin.listings.approve',
			'uses' => 'Admin\ListingsController@approveListing',
			'middleware' => 'notDemo'
		]);
//rejects listing
	Route::get('admin/listings/{listingId}/reject',
		[
			'as' => 'admin.listings.reject',
			'uses' => 'Admin\ListingsController@rejectListing',
			'middleware' => 'notDemo'
		]);
//undoes listing reject
	Route::get('admin/listings/{listingId}/undoreject',
		[
			'as' => 'admin.listings.undoreject',
			'uses' => 'Admin\ListingsController@undoRejectListing',
			'middleware' => 'notDemo'
		]);
});