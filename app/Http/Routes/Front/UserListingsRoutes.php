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

Route::get('my-listings',
	[
		'as' => 'userlistings.index',
		'uses' => 'Front\UserListingsController@index',
		'middleware' => ['auth', 'simple']
	]);

Route::get('add-listing',
	[
		'as' => 'userlistings.create',
		'uses' => 'Front\UserListingsController@create',
		'middleware' => ['auth', 'simple', 'hasActiveMP', 'allowedListingsNo']
	]);

Route::post('add-listing',
	[
		'as' => 'userlistings.store',
		'uses' => 'Front\UserListingsController@store',
		'middleware' => ['auth', 'simple', 'hasActiveMP', 'allowedListingsNo', 'notDemo']
	]);

Route::get('edit-listing-{listingId}',
	[
		'as' => 'userlistings.edit',
		'uses' => 'Front\UserListingsController@edit',
		'middleware' => ['auth', 'simple', 'owner', 'hasActiveMP', 'notArchived']
	]);

Route::patch('edit-listing-{listingId}',
	[
		'as' => 'userlistings.update',
		'uses' => 'Front\UserListingsController@update',
		'middleware' => ['auth', 'simple', 'owner', 'hasActiveMP', 'notArchived', 'notDemo']
	]);

//delete listing
Route::delete('my-listings/{listingId}/destroy',
	[
		'as' => 'userlistings.destroy',
		'uses' => 'Front\UserListingsController@destroy',
		'middleware' => ['auth', 'simple', 'owner', 'notDemo']
	]);

//archives listing
Route::get('my-listings/{listingId}/archive',
	[
		'as' => 'userlistings.archive',
		'uses' => 'Front\UserListingsController@archiveListing',
		'middleware' => ['auth', 'simple', 'owner', 'hasActiveMP', 'notDemo']
	]);

//restores listing
Route::get('my-listings/{listingId}/restore',
	[
		'as' => 'userlistings.restore',
		'uses' => 'Front\UserListingsController@restoreListing',
		'middleware' => ['auth', 'simple', 'owner', 'hasActiveMP', 'allowedListingsNo', 'notDemo']
	]);


//MANAGE LISTING PLAN
//Proceed To Payment
Route::get('listing-plans/proceed-to-payment/{listingId}-{forId}/{for}', [
	'as' => 'listingplans.proceed',
	'uses' => 'Front\PaymentsController@proceedToListingPlanPayment',
	'middleware' => ['auth', 'owner', 'hasActiveMP', 'notArchived', 'allowedLP', 'notDemo']
]);
