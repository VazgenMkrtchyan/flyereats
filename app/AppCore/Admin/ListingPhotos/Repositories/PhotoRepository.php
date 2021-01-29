<?php namespace App\AppCore\Admin\ListingPhotos\Repositories;
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

use App\AppCore\Miscellaneous\Abstractions\EloquentRepository;
use Illuminate\Support\Facades\Artisan;
use Photo, Listing;

class PhotoRepository extends EloquentRepository {

	protected $model;
	function __construct(Photo $model)
	{
		$this->model = $model;
	}


	public function deleteListingPhotos($listingId)
	{
		$this->model->where('listing_id', $listingId)->delete();
	}


	public function getAllListingPhotos($listingId)
	{
		$photos = $this->model->where('listing_id', $listingId)->get();

		return $photos;
	}

    public function rotate($photoId)
    {
        $photo = $this->model = $this->getById($photoId);
        $present = $photo->present();
        $imagePath = $present->photoUrl();
        $imageThumbUrl = $present->thumbUrl();

        try {
            $this->rotateFunction($imagePath);
            $this->rotateFunction($imageThumbUrl);

            $this->model->name = intval($this->model->name)+1;;
            $this->model->save();
        }catch (\Exception $e){
        }
    }

    public function rotateFunction($imagePath)
    {
        $uploadPath = str_replace($_SERVER['HTTP_HOST'].'/', '', substr($imagePath, strripos($imagePath, $_SERVER['HTTP_HOST'])));

        $newName = intval($this->model->name)+1;

        $source = imagecreatefromjpeg($imagePath);
        //$source = imagecreatefromstring(file_get_contents($imagePath));

        $img = imagerotate($source, 270, 0);

        $filePath = public_path($uploadPath);

        if(is_file($filePath))
        {
            unlink($filePath);
        }

        $newPath = str_replace($this->model->name, $newName, public_path($uploadPath));

        imagejpeg($img, $newPath);

        chmod($newPath, 0777);
    }

	public function changeOrder($photoId, $targetId)
	{
		$photo = $this->getById($photoId);
		$target = $this->getById($targetId);
		$photoName = $photo->name;
		$targetName = $target->name;

		$photo->name = $targetName;
		$photo->save();

		$target->name = $photoName;
		$target->save();
	}


	public function getListing($listingId)
	{
		return Listing::findOrFail($listingId);
	}

} 