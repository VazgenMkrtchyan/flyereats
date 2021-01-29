<?php namespace App\AppCore\Front\ListingPhotos\Repositories;
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
use Photo;

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


	public function changeOrder($photoId, $targetId)
	{
		$photo = $this->getById($photoId);
		$target = $this->getById($targetId);
		$photo_name = $photo->name;
		$target_name = $target->name;

		$photo->name = $target_name;
		$photo->save();

		$target->name = $photo_name;
		$target->save();
	}

	//returns listing photos count
	public function listingPhotosCount($listingId)
	{
		return $this->model->where('listing_id', $listingId)->count();
	}

} 