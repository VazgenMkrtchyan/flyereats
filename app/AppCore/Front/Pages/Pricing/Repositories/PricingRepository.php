<?php namespace App\AppCore\Front\Pages\Pricing\Repositories;
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

use UserGroup, MembershipPlan;

class PricingRepository {


	public function userGroups()
	{
		$userGroups = UserGroup::ordered()->get();

		return $userGroups;
	}


	public function membershipPlans($userGroupId)
	{
		$membershipPlans = UserGroup::findOrFail($userGroupId)->membershipPlans()->ordered()->get();

		return $membershipPlans;
	}


	public function packages($membershipPlanId)
	{
		$packages = MembershipPlan::findOrFail($membershipPlanId)->packages()->ordered()->get();

		return $packages;
	}


	public function userGroup($userGroupId)
	{
		return UserGroup::findOrFail($userGroupId);
	}


	public function membershipPlan($membershipPlanId)
	{
		return MembershipPlan::findOrFail($membershipPlanId);
	}

}