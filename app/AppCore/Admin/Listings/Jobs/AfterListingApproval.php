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

use App\AppCore\Admin\Mailers\Jobs\ListingApprovedNotification;

class AfterListingApproval extends Job
{
	public $listingEntity;
	

	function __construct($listingEntity)
	{
		$this->listingEntity = $listingEntity;
	}


	public function handle()
	{
		$listing = $this->listingEntity;

		//sends mail
		if (appCon()->email_listing_approved)
		{
			$this->dispatchNow(new ListingApprovedNotification($listing));
		}
	}

}