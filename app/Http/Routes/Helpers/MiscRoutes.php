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

Route::get('misc/prefToSession', [
	'as' => 'misc.pref_to_session',
	'uses' => 'Helpers\MiscController@preferencesToSession'
]);

Route::post('misc/changeTheme', [
	'as' => 'misc.change_theme',
	'uses' => 'Helpers\MiscController@changeTheme'
]);

/*Route::get('misc/cr', function() {
	File::makeDirectory(public_path('test'), null, false, true);
	echo 'sss';
});*/

/*Route::get('misc/images', function() {
	foreach (Photo::all() as $photo)
	{
		$photoName = '';
		for ($i = 1; $i <= 4; $i++)
		{
			$photoName .= rand(0,9);
		}
		$photoName .= time();
		$path = public_path('uploads/listings/' . substr($photoName, 0, 2) . '/' . substr($photoName, 2, 2) . '/');
		File::makeDirectory($path, 0755, true, true);
		File::move(public_path('uploads/listings/enlarge/'.$photo->name), $path.$photoName.'_large.jpg');
		File::move(public_path('uploads/listings/thumbs/').$photo->name, $path.$photoName.'_thumb.jpg');
		$photo->update(['name' => $photoName]);
		echo '+';
	}
});*/