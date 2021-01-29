<?php namespace App\AppCore\Miscellaneous\Traits;
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

use Image, File;

trait ListingPhotosTrait {

	//for uploading listing photos
	public function uploadListingPhoto(
		$photo_object,
		$photo_size = [],
		$thumbnail_size = []
	)
	{
		//photo size
		if (empty($photo_size))
		{
			$photo_size = ['x' => appCon()->size_photo_x, 'y' => appCon()->size_photo_y];
		}
		//thumbnail size
		if (empty($thumbnail_size))
		{
			$thumbnail_size = ['x' => appCon()->size_thumb_x, 'y' => appCon()->size_thumb_y];
		}

		//The file must be an image (jpeg, png, bmp, or gif)
		$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'];

		//checks MIME type
		if (in_array($photo_object->getMimeType(), $allowedMimeTypes))
		{
			//generates random number. used for file structure later on
			$photoName = '';
			for ($i = 1; $i <= 4; $i++)
			{
				$photoName .= rand(0,9);
			}
			$photoName .= time();

			$path = $this->imagePath($photoName);
			//creates directory for an image
			File::makeDirectory($path, 0775, true, true);

			//Image processing
			$image = Image::make($photo_object->getRealPath());
			$image->fit($photo_size['x'], $photo_size['y'])
				->save($path . $photoName . '_large.jpg')
				->fit($thumbnail_size['x'], $thumbnail_size['y'])
				->save($path . $photoName . '_thumb.jpg');

			return $photoName;
		}

		return 'WRONG_FILE_TYPE';
	}


	//delete listing image
	public function deleteListingPhoto($photoName)
	{
		$path = $this->imagePath($photoName);
		$anc = str_replace('/'.substr($photoName, 2, 2).'/', '/', $path);
		$large = $path . $photoName . '_large.jpg';
		$thumb = $path . $photoName . '_thumb.jpg';

		//deleting files
		if (File::exists($large)) File::delete($large);
		if (File::exists($thumb)) File::delete($thumb);

		//deletes directories if they are empty
		if (! count(File::allFiles($path))) { //if child dir is empty
			File::deleteDirectory($path);
			if (! count(File::directories($anc))) File::deleteDirectory($anc); //deletes parent dir if child dir is empty thus parent has no other dirs (children)
		}
	}


	##HELPERS##
	protected function imagePath($photoName)
	{
		return public_path('uploads/listings/' . substr($photoName, 0, 2) . '/' . substr($photoName, 2, 2) . '/');
	}

} 