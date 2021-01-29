<?php namespace App\AppCore\Admin\ListingPhotos\Jobs;
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

use App\AppCore\Miscellaneous\Abstractions\Job;

use App\AppCore\Admin\ListingPhotos\Repositories\PhotoRepository;
use App\AppCore\Miscellaneous\Traits\ListingPhotosTrait;

class UploadPhoto extends Job
{
	use ListingPhotosTrait;

	public $listingId;
	public $photo;

	
	public function __construct($listingId, $photo)
	{
		$this->listingId = $listingId;
		$this->photo = $photo;
	}


	public function handle(PhotoRepository $photoRepository)
	{
		$filename = $this->uploadListingPhoto($this->photo);

		//writing info to database
		if ($filename != 'WRONG_FILE_TYPE')
		{
			$photoRepository->create([
				'listing_id' => $this->listingId,
				'name' => $filename
			]);
		}
	}

}