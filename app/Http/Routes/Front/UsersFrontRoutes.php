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
Route::group(['middleware' => ['auth', 'simple']],
	function() {

		Route::get('account-summary', [
			'as' => 'account_summary',
			'uses' => 'Front\UsersController@accountSummary'
		]);

		Route::get('profile/edit',
			[
				'as' => 'profile.edit',
				'uses' => 'Front\UsersController@editProfile'
			]);

		Route::patch('profile',
			[
				'as' => 'profile.update',
				'uses' => 'Front\UsersController@updateProfile',
				'middleware' => 'notDemo'
			]);

		##CHANGE EMAIL ROUTES
		Route::get('profile/change-email', [
			'as' => 'changeemail',
			'uses' => 'Front\UsersController@editEmail'
		]);

		Route::post('profile/change-email', [
			'as' => 'change_email_request',
			'uses' => 'Front\UsersController@updateEmail'
		]);

		##USER PAYMENTS
		Route::get('my-payments',
			[
				'as' => 'userpayments.index',
				'uses' => 'Front\UsersController@userPayments'
			]);

		//PAYMENT STATUS AFTER RETURN
		//do not change this url, because Verify Csrf Token Middleware will fail.
		Route::match(['get', 'post'], 'my-payment-status',
			[
				'as' => 'userpayments.payment_status',
				'uses' => 'Front\UsersController@paymentStatus'
			]);
	});


##EMAIL CHANGE CONFIRMATION ROUTE
Route::get('emailconfirm/{token}', [
		'as' => 'email.confirm',
		'uses' => 'Front\UsersController@confirmNewEmail'
	]
);

//MANAGE MEMBERSHIP PLAN
Route::get('manage-membership',[
	'as' => 'membershipplans.manage',
	'uses' => 'Front\UsersController@manageMembership',
	'middleware' => ['auth', 'simple']
]);

Route::get('membership-plan/proceed-to-payment/{membershipPlanId}',[
	'as' => 'membershipplans.proceed',
	'uses' => 'Front\PaymentsController@proceedToMembershipPayment',
	'middleware' => ['auth', 'simple', 'allowedMP', 'notDemo']
]);
