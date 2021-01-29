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

Route::get('register', [
	'as' => 'register',
	'uses' => 'Front\RegistrationsController@create',
	'middleware' => 'guest'
]);

Route::post('register', [
		'as' => 'register.post',
		'uses' => 'Front\RegistrationsController@store',
		'middleware' => 'notDemo'
	]
);

##CONFIRM ACCOUNT ROUTE
Route::get('confirmaccount/{token}', [
	'as' => 'account.confirm',
	'uses' => 'Front\RegistrationsController@confirmAccount'
]);

##RESEND CONFIRMATION EMAIL##
Route::get('resendconfirmation', [
	'as' => 'resend_confirmation',
	'uses' => 'Front\RegistrationsController@ResendConfirmation'
]);
Route::post('resendconfirmation', [
	'as' => 'resend_confirmation.post',
	'uses' => 'Front\RegistrationsController@ResendConfirmationPost'
]);