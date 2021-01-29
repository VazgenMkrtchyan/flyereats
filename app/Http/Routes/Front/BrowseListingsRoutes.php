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

Route::get('/listings',
	[
		'as' => 'browselistings.index',
		'uses' => 'Front\BrowseListingsController@index'
	]);

Route::get('/listing/{any}_{listingId}',
	[
		'as' => 'browselistings.view',
		'uses' => 'Front\BrowseListingsController@view'
	]);

# LISTING ENQUIRY ROUTES
Route::post('/listing-enquiry/{listingId}',
	[
		'as' => 'enquiry.send',
		'uses' => 'Front\BrowseListingsController@listingEnquirySend'
	]);


# PRINTABLE PAGE
Route::get('/print/listing-{listingId}',
	[
		'as' => 'listing_print',
		'uses' => 'Front\BrowseListingsController@listingPrint'
	]);


# performs search
Route::post('/do-search',
	[
		'as' => 'do_search',
		'uses' => 'Front\BrowseListingsController@doListingsSearch'
	]);


//stars or unstars listing
Route::post('/love-listing/{listing_id}', [
	'as' => 'love_listing',
	'uses' => 'Front\BrowseListingsController@loveListing'
]);