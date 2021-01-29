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

## PHOTOS MANAGER ##
Route::post('manage-photos-{listingId}/upload',
	[
		'as' => 'photomanager.upload',
		'uses' => 'Front\ListingPhotosController@upload',
		'middleware' => ['auth', 'owner', 'notArchived', 'notDemo']
	]);


Route::delete('manage-photos/destroy',
	[
		'as' => 'photomanager.destroy',
		'uses' => 'Front\ListingPhotosController@destroy',
		'middleware' => ['auth', 'notDemo']
	]);

Route::post('manage-photos/movephoto',
	[
		'as' => 'photomanager.move',
		'uses' => 'Front\ListingPhotosController@move',
		'middleware' => ['auth', 'notDemo']
	]);

//for photos AJAX loading
Route::get('manage-photos/photos/{listingId}',
	[
		'as' => 'photomanager.photos',
		'uses' => 'Front\ListingPhotosController@listingPhotosAJAX',
		'middleware' => ['auth', 'owner']
	]);