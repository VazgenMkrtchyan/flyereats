<?php namespace App\AppCore\Admin\ListingPlans\Repositories;
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
use App\AppCore\Miscellaneous\Traits\UpdateOrderTrait;
use ListingPlan, UserGroup, MembershipPlan;

class ListingPlanRepository extends EloquentRepository {

	use UpdateOrderTrait;

	protected $model;
	function __construct(ListingPlan $model)
	{
		$this->model = $model;
	}

	//gets user groups
	public function getUserGroups()
	{
		return UserGroup::ordered()->get();
	}


	public function getMembershipPlan($membershipPlanId)
	{
		return MembershipPlan::findOrFail($membershipPlanId);
	}

	//updates order
	public function updateOrder($data)
	{
		$this->updateOrderFunction('listing_plans', $data);
	}

}