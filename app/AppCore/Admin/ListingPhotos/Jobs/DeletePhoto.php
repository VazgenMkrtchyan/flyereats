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

use App\AppCore\Admin\ListingPhotos\Jobs\DeletePhotoFile;
use App\AppCore\Admin\ListingPhotos\Repositories\PhotoRepository;

class DeletePhoto extends Job
{
	public $photoId;


	public function __construct($photoId)
	{
		$this->photoId = $photoId;
	}


	public function handle(PhotoRepository $photoRepository)
	{
		$photo = $photoRepository->getById($this->photoId);

		//deletes file
		$this->dispatchNow(new DeletePhotoFile($photo->name));

		//deleting record from database
		$photo->delete();
	}

}