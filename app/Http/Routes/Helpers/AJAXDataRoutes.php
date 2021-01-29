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

//DEPENDENT (AJAX) DROPDOWNS
//Gets Car Models
Route::get('api/models', [
	'as' => 'api_models',
	'uses' => 'Helpers\AJAXDataController@getModels'
]);

//Gets Listing Plans
Route::get('api/listing-plans', [
	'as' => 'api_listing_plans',
	'uses' => 'Helpers\AJAXDataController@getListingPlans'
]);

//Gets User Address
Route::get('api/user_address', [
	'as' => 'api_user_address',
	'uses' => 'Helpers\AJAXDataController@getUserAddress'
]);

//Gets Membership Plans (depending on user's group)
Route::get('api/membership-plans', [
	'as' => 'api_membership_plans',
	'uses' => 'Helpers\AJAXDataController@getMembershipPlans'
]);

##GETS DATA##
Route::get('api/listing-plan/data', [
	'as' => 'api_listing_plan_data',
	'uses' => 'Helpers\AJAXDataController@getListingPlanData'
]);

Route::get('api/membershipplan/data', [
	'as' => 'api_membershipplan_data',
	'uses' => 'Helpers\AJAXDataController@getMembershipPlanData'
]);

##LOADS MORE DATA##
Route::get('api/load-more/data', [
	'as' => 'api_load_more',
	'uses' => 'Helpers\AJAXDataController@getLoadMoreData'
]);