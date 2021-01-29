<?php namespace App\AppCore\Miscellaneous\AJAX\Repositories;
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

use Carbon;
use UserGroup, ListingPlan, MembershipPlan, User, Model, Listing;

class AJAXDataRepository {

	//used whenever user selects make to get models of that make
	public function getModelsOfMake($makeId, $countOf = null)
	{
		$models = Model::where('models.make_id', $makeId)->ordered();

		//if count is set
		if ($countOf) {
			$models =
				Listing::listingsFilter([
					'listingStatus' => $countOf == 'activeL' ? 'active' : '',
					'make' => $makeId
				])
					->join('models', 'models.id', '=', 'listings.model_id')
					->selectRaw("`models`.`id`, CONCAT(`models`.`name`, ' (', COUNT(`listings`.`id`), ')') AS name")
					->orderBy('models.order')
					->orderBy('models.name')
					->groupBy('models.id');
		}

		return $models;
	}

	//used when adding/editing listing
	public function getListingPlans($userId)
	{
		return User::find($userId)->listingPlans()->pluck('name', 'id')->all();
	}

	//used when adding a user or changing user's user group
	public function getMembershipPlansForUserGroup($userGroupId)
	{
		$membershipPlans = UserGroup::findOrFail($userGroupId)
			->membershipPlans
			->pluck('name', 'id')->all();

		return $membershipPlans;
	}

	//used for auto populating user address when adding a listing (admin side)
	public function getUserAddressData($userId)
	{
		return User::findOrFail($userId, ['state_id', 'city', 'addr_1', 'zip']);
	}

	//used for auto populating listing plan data when adding a listing (admin side)
	public function getListingPlanData($listingPlanId)
	{
		$listingPlan = ListingPlan::findOrFail($listingPlanId);

		//formats expiration
		if ($listingPlan->duration) {
			$listingPlan->formatted_expiration = Carbon::now()->addDays($listingPlan->duration)->format('Y-m-d');
		}
		else $listingPlan->formatted_expiration = '';

		return $listingPlan;
	}

	//used for auto populating membership plan data when adding a user (admin side)
	public function getMembershipPlanData($membershipPlanId)
	{
		$membershipPlan = MembershipPlan::findOrFail($membershipPlanId);

		//formats expiration
		if ($membershipPlan->duration) {
			$membershipPlan->formatted_expiration = '';
		}
		else $membershipPlan->formatted_expiration = Carbon::now()->addDays($membershipPlan->duration)->format('Y-m-d');

		return $membershipPlan;
	}


	//loads more listings
	public function getLoadMoreData($loadedNo, $loadStep)
	{
		$listings = Listing::listingsFilter(['listingStatus' => 'active'])->skip($loadedNo)->take($loadStep)->orderBy('created_at', 'desc')->get();
		
		return $listings;
	}

}