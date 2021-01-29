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

trait LogosTrait {

	//upload logo
	public function uploadLogo(
		$file,
		$path,
		$dimensions = ['x' => 400, 'y' => 140],
		$insert = false,
		$smartDirs = false
	)
	{
		//sets default dimensions
		if (! $dimensions) $dimensions = ['x' => 400, 'y' => 140];

		$fileName = '';
		for ($i = 1; $i <= 4; $i++)
		{
			$fileName .= rand(0,9);
		}
		$fileName .= time() . '.png';

		if ($smartDirs)
		{
			$path .=  substr($fileName, 0, 2) . DIRECTORY_SEPARATOR . substr($fileName, 2, 2) . DIRECTORY_SEPARATOR;
			File::makeDirectory($path, 0775, true, true);
		}
		
		$logo = $path . $fileName;

		//Image processing
		$image = Image::make($file->getRealPath());
		if (isset($dimensions)) {
			$image->resize($dimensions['x'], $dimensions['y'], function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
		}
		if ($insert) {
			//generates final image (makes all images same width and centered)
			Image::make(public_path('templates/misc/transparent.png'))
				->resize($dimensions['x'] + 20, $dimensions['y'] + 10)
				->insert($image, 'center')
				->save($logo);
		} else {
			$image->save($logo);
		}

		//returns filename
		return $fileName;
	}

	//delete logo
	public function deleteLogo($fileName, $path, $smartDirs = false)
	{
		if ($smartDirs)
		{
			$path .=  substr($fileName, 0, 2) . '/' . substr($fileName, 2, 2) . '/';
			
		}
		
		$logo = $path . $fileName;
		$anc = str_replace('/'.substr($fileName, 2, 2).'/', '/', $path);;

		if (File::exists($logo)) {

			File::delete($logo);

			if ($smartDirs) {
				//deletes directories if they are empty
				if (! count(File::allFiles($path))) { //if child dir is empty
					File::deleteDirectory($path);
					if (! count(File::directories($anc))) File::deleteDirectory($anc); //deletes parent dir if child dir is empty thus parent has no other dirs (children)
				}
			}

		}

		return 'LOGO_DELETED';
	}


	//checks selected file (if it's not empty and if it has correct type)
	public function checkLogo($file)
	{
		if ($file == null)
		{
			return 'NO_FILE_SELECTED';
		}

		//allowed file types
		$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'];
		//checking if valid file type is selected
		if (! in_array($file->getMimeType(), $allowedMimeTypes))
		{
			return 'WRONG_FILE_TYPE';
		}

		return 'GOOD_TO_GO';
	}

}