<?php namespace App\AppCore\Admin\HighfeatPlans\Repositories;
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
use HighfeatPlan, UserGroup;

class HighfeatPlanRepository extends EloquentRepository {

	use UpdateOrderTrait;

	protected $model;
	function __construct(HighfeatPlan $model)
	{
		$this->model = $model;
	}

	//gets user groups
	public function getUserGroups()
	{
		return UserGroup::ordered()->get();
	}

	public function getUserGroup($userGroupId)
	{
		return UserGroup::findOrFail($userGroupId);
	}

	//updates order
	public function updateOrder($data)
	{
		$this->updateOrderFunction('highfeat_plans', $data);
	}
}