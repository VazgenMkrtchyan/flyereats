<?php namespace App\AppCore\Front\ListingPlans\Jobs;
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
use App\AppCore\Front\ListingPlans\Repositories\ListingPlanRepository;

class HighFeatListing extends Job
{
	public $listingId;
	public $highFeatPlanId;


	public function __construct($listingId, $highFeatPlanId)
	{
		$this->listingId = $listingId;
		$this->highFeatPlanId = $highFeatPlanId;
	}


	public function handle(ListingPlanRepository $listingPlanRepository)
	{
		$listingId = $this->listingId;

		//applies plan settings
		$listingPlanRepository->applyHighOrFeatPlan($listingId, $this->highFeatPlanId);
	}

}