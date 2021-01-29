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

//PHOTOS MANAGER
	Route::post('admin/listing-photos/{listingId}',
		[
			'as' => 'admin.listing-photos.upload',
			'uses' => 'Admin\ListingPhotosController@upload',
			'middleware' => 'notDemo'
		]);

    //delete photo
	Route::delete('admin/listing-photos/destroy/photo',
		[
			'as' => 'admin.listing-photos.destroy',
			'uses' => 'Admin\ListingPhotosController@destroy',
			'middleware' => 'notDemo'
		]);

	Route::post('admin/listing-photos/action/movephoto',
		[
			'as' => 'admin.listing-photos.move',
			'uses' => 'Admin\ListingPhotosController@move',
			'middleware' => 'notDemo'
		]);


    Route::post('admin/listing-photos/action/rotate',
        [
            'as' => 'admin.listing-photos.rotate',
            'uses' => 'Admin\ListingPhotosController@rotate',
            'middleware' => 'notDemo'
        ]);

    //loads uploaded photos via ajax
	Route::get('admin/listing-photos/photos/{listingId}',
		[
			'as' => 'admin.listing-photos.photos',
			'uses' => 'Admin\ListingPhotosController@listingPhotosAJAX'
		]);
});