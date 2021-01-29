<?php namespace App\AppCore\Front\ListingPlans\Repositories;
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
use ListingPlan, Listing, HighfeatPlan;
use Carbon, Auth;

class ListingPlanRepository extends EloquentRepository {

	protected $model;
	function __construct(ListingPlan $model)
	{
		$this->model = $model;
	}


	public function highFeatPlans()
	{
		$highPlans = Auth::user()
			->userGroup
			->highfeatPlans()
			->highlighting()
			->ordered()
			->get();

		$featPlans = Auth::user()
			->userGroup
			->highfeatPlans()
			->featuring()
			->ordered()
			->get();

		return ['high' => $highPlans, 'feat' => $featPlans];
	}


	//gets listing
	public function getListing($listingId)
	{
		return Listing::findOrFail($listingId);
	}


	//applies listing plan
	public function applyListingPlan($listingId, $listingPlanId)
	{
		$listing = Listing::findOrFail($listingId);
		$listingPlan = $this->getById($listingPlanId);

		//expiration date
		if ($listingPlan->duration)
		{
			//if listing plan is not free, if listing has the same plan and plan is not expired yet, then plan is extended
			if ($listingPlan->price //saves from manipulation by adding and adding days
				AND $listingPlan->isCurrent($listing)
				AND ! $listing->isExpired())
			{
				$data['expires_on'] = $listing->expires_on->addDays($listingPlan->duration);
			}
			else
			{
				$data['expires_on'] = Carbon::now()->addDays($listingPlan->duration);
			}
		}
		else
		{
			$data['expires_on'] = null;
		}

		//st_moderation (if listing is not yet approved)
		if ($listing->isApproved()
			OR $listingPlan->auto_conf)
		{
			$data['st_moderation'] = 'approved';
		}
		else
		{
			$data['st_moderation'] = 'pending';
		}

		//listing plan id
		$data['listing_plan_id'] = $listingPlanId;

		//updates listing data
		$listing->update($data);
	}


	public function applyHighOrFeatPlan($listingId, $planId)
	{
		$listing = Listing::findOrFail($listingId);
		$plan = HighfeatPlan::findOrFail($planId);

		switch ($plan->for)
		{
			case 'highlighting':
				$data['st_highlighted'] = true;
				$data['st_featured'] = false;
				if ($listing->isHighlighted()
					AND ! $listing->enhancementExpired())
				{
					$data['high_or_feat_till'] = $listing->high_or_feat_till->addDays($plan->duration);
				}
				else
				{
					$data['high_or_feat_till'] = Carbon::now()->addDays($plan->duration);
				}
				break;

			case 'featuring':
				$data['st_highlighted'] = false;
				$data['st_featured'] = true;
				if ($listing->isFeatured()
					AND ! $listing->enhancementExpired())
				{
					$data['high_or_feat_till'] = $listing->high_or_feat_till->addDays($plan->duration);
				}
				else
				{
					$data['high_or_feat_till'] = Carbon::now()->addDays($plan->duration);
				}
				break;
		}

		//updates listing
		$listing->update($data);
	}

} 