<?php namespace App\AppCore\Admin\Listings\Jobs;
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

use App\AppCore\Admin\Listings\Repositories\ListingRepository;
use App\AppCore\Admin\ListingPhotos\Jobs\DeletePhotoFile;

class DeleteListing extends Job
{
	public $listingId;

	
	public function __construct($listingId)
	{
		$this->listingId = $listingId;
	}


	public function handle(ListingRepository $listingRepository)
	{
		//retrieves listing entity
		$listing = $listingRepository->getById($this->listingId);
		//deletes listing from database
		$listing->delete();

		//deletes listing photos from server
		foreach ($listing->photos as $photo)
		{
			//deletes photo file
			$this->dispatchNow(new DeletePhotoFile($photo->name));
		}
		//deletes photos from database
		$listing->photos()->delete();
	}

}