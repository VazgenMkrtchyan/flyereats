<?php namespace App\AppCore\Miscellaneous\Repositories;
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

use ListingPlan, UserGroup, MembershipPlan, Make, Listing;
use DB, Carbon;

class DetailRepository {

	public function getMakes($countOf = null)
	{
		$makes = Make::ordered();

		if ($countOf) {
			$makes =
				Listing::listingsFilter([
					'listingStatus' => ($countOf == 'activeL') ? 'active': ''
				])
					->join('makes', 'makes.id', '=', 'listings.make_id')
				->selectRaw("`makes`.`id` AS id, CONCAT(`makes`.`name`, ' (', COUNT(`listings`.`id`), ')' ) AS name")
				->orderBy('makes.order')
				->orderBy('makes.name')
				->groupBy('makes.id');
		}

		return $makes
			->pluck('name', 'id')
			->all();
	}

	public function getConditions()
	{
		return $this->generateDetListData('det_conditions');
	}

	public function getBodyStyles()
	{
		return $this->generateDetListData('det_bodystyles');
	}

	public function getExtColors()
	{
		return $this->generateDetListData('det_extcolors');
	}

	public function getIntColors()
	{
		return $this->generateDetListData('det_intcolors');
	}

	public function getTransmissions()
	{
		return $this->generateDetListData('det_transmissions');
	}

	public function getDriveTypes()
	{
		return $this->generateDetListData('det_drivetypes');
	}

	public function getFuelTypes()
	{
		return $this->generateDetListData('det_fueltypes');
	}

	public function getFeatures()
	{
		return $this->generateDetListData('features');
	}

	public function getStates()
	{
		return $this->generateDetListData('det_states');
	}


	public function getListingPlans($countOf = null)
	{
		$listingPlan = ListingPlan::orderBy('name');
		if ($countOf == 'listings')
		{
			$listingPlan->leftJoin('listings', 'listings.listing_plan_id', '=', 'listing_plans.id')
				->groupBy('listing_plans.id')
				->select(['listing_plans.id', DB::raw("CONCAT(`listing_plans`.`name`, ' (', COUNT(`listings`.`id`), ')') AS name")]);
		}
		return $listingPlan->pluck('name', 'id')->all();
	}

	public function getUserGroups($countOf = null)
	{
		$userGroup = UserGroup::orderBy('order')->orderBy('name');

		if ($countOf == 'users')
		{
			$userGroup->leftJoin('users', 'users.user_group_id', '=', 'user_groups.id')
				->groupBy('user_groups.id')
				->select(['user_groups.id', DB::raw("CONCAT(`user_groups`.`name`, ' (', COUNT(`users`.`id`), ')') AS name")]);
		}
		elseif ($countOf == 'listings')
		{
			$userGroup->leftJoin('users', 'users.user_group_id', '=', 'user_groups.id')
				->leftJoin('listings', 'listings.user_id', '=', 'users.id')
				->groupBy('user_groups.id')
				->select(['user_groups.id', DB::raw("CONCAT(`user_groups`.`name`, ' (', COUNT(`listings`.`id`), ')') AS name")]);
		}
		return $userGroup->pluck('name', 'id')->all();
	}


	public function getMembershipPlans($countOf = null)
	{
		$membershipPlan = MembershipPlan::orderby('order')->orderBy('name');
		if ($countOf == 'users')
		{
			$membershipPlan
				->leftJoin('users', 'users.membership_plan_id', '=', 'membership_plans.id')
				->select(['membership_plans.id', DB::raw("CONCAT(`membership_plans`.`name`, ' (', COUNT(`users`.`id`), ')') AS name")])
				->groupBy('membership_plans.id');
		}
		return $membershipPlan->pluck('name', 'id')->all();
	}


	##### HELPERS #####
	###################
	protected function generateDetListData($table)
	{
		return DB::table($table)->where('active', true)->orderBy('order')->orderBy('name')->pluck('name', 'id');
	}
	###################
}