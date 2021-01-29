<?php namespace App\AppCore\Front\ListingPhotos\Jobs;
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

use App\AppCore\Miscellaneous\Traits\ListingPhotosTrait;

class DeletePhotoFile extends Job
{
	use ListingPhotosTrait;

	public $fileName;

	
	public function __construct($fileName)
	{
		$this->fileName = $fileName;
	}


	public function handle()
	{
		//deletes file
		$this->deleteListingPhoto($this->fileName);
	}

}