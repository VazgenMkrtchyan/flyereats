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

Route::get('/', [
	'as' => 'index',
	'uses' => 'Front\PagesController@index'
]);

Route::get('/advanced-search', [
	'as' => 'advanced-search.index',
	'uses' => 'Front\PagesController@advancedSearch'
]);

# CONTACT US PAGE ROUTES
Route::get('contact-us',
	[
		'as' => 'contactus.index',
		'uses' => 'Front\PagesController@contactUsIndex'
	]);

Route::post('contact-us',
	[
		'as' => 'contactus.send',
		'uses' => 'Front\PagesController@contactUsSend'
	]);

Route::post('sell-your-car',
	[
		'as' => 'sel.car',
		'uses' => 'Front\PagesController@selYourCar'
	]);

##PRICING INFO
Route::get('sell-your-car',
	[
		'as' => 'sell-your-car.info',
		'uses' => 'Front\PagesController@pricingIndex'
	]);

Route::get('sell-your-car/listingPlansAjax',
	[
		'as' => 'sell-your-car.listingPlans',
		'uses' => 'Front\PagesController@listingPlansAjax'
	]);

Route::get('part-exchange',
	[
		'as' => 'pages.part-exchange',
		'uses' => 'Front\PagesController@faq'
	]);

Route::get('about-us',
	[
		'as' => 'pages.about-us',
		'uses' => 'Front\PagesController@aboutUs'
	]);