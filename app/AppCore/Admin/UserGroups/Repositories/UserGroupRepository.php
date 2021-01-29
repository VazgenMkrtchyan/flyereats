<?php namespace App\AppCore\Admin\UserGroups\Repositories;
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
use UserGroup;
use MembershipPlan;
use DB;

class UserGroupRepository extends EloquentRepository {

	use UpdateOrderTrait;

	protected $model;
	function __construct(UserGroup $userGroup)
	{
		$this->model = $userGroup;
	}

	public function getUserGroups()
	{
		return $this->model->ordered()->get();
	}

	//updates order
	public function updateOrder($data)
	{
		$this->updateOrderFunction('user_groups', $data);
	}


}