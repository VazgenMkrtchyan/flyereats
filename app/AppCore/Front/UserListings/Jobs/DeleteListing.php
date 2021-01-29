<?php namespace App\AppCore\Front\UserListings\Jobs;
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

use App\AppCore\Front\ListingPhotos\Jobs\DeletePhotoFile;
use App\AppCore\Front\UserListings\Repositories\UserListingRepository;

class DeleteListing extends Job
{
	public $listingId;

	
	public function __construct($listingId)
	{
		$this->listingId = $listingId;
	}


	public function handle(UserListingRepository $userListingRepository)
	{
		//retrieves listing entity
		$listing = $userListingRepository->getById($this->listingId);
		//deletes listing record from database
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