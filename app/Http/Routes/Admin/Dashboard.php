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

Route::get('admin', function() {
	return redirect()->route('admin.dashboard');
});

//DASHBOARD
Route::get('admin/dashboard', [
	'as' => 'admin.dashboard',
	'middleware' => ['admin.auth'],

	function () {
		return view('admin.dashboard', [
			'pendingUsers' => User::usersFilter(['moderationStatus' => 'pending'])->count(),
			'pendingListings' => Listing::listingsFilter(['moderationStatus' => 'pending'])->count()
		]);
	}]);


//STATISTICS
Route::get('admin/statistics',
	[
		'as' => 'admin.statistics.index',
		'uses' => 'Admin\StatisticsController@index',
		'middleware' => ['admin.auth', 'admin.allowed'],
	]);