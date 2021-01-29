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

	//LISTING PLANS
	generateResourceURLS(['in', 'cr', 'st', 'ed', 'up', 'de'], 'Admin\ListingPlansController', 'admin/listing-plans', 'admin.listing-plans');

	//updates order
	Route::patch('admin/update-order/listing-plans',
		[
		'as' => 'admin.listing-plans.updateorder',
		'uses' => 'Admin\ListingPlansController@updateOrder'
	]);

});
 