<?php namespace App\AppCore\Front\MembershipPlans\Repostitories;
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
use MembershipPlan, User;
use Carbon;

class MembershipPlanRepository extends EloquentRepository {

	public $model;
	function __construct(MembershipPlan $membershipPlan)
	{
		$this->model = $membershipPlan;
	}

	//applies membership plan settings
	public function applyMembershipPlan($userId, $membershipPlanId)
	{
		$user = User::findOrFail($userId);
		$membershipPlan = $this->getById($membershipPlanId);

		//archives all user listings if membership plan is changed
		if (! $membershipPlan->isCurrent($user))
		{
			$user->listings()->update(['st_archived' => true]);
		}

		//expiration date
		if ($membershipPlan->duration)
		{
			//if membership plan is not free, if user has the same plan and plan is not expired yet, then plan is extended
			if ($membershipPlan->price //saves from manipulation by adding and adding days
				AND $membershipPlan->isCurrent($user)
				AND ! $user->isExpired())
			{
				$data['expires_on'] = $user->expires_on->addDays($membershipPlan->duration);
			}
			else
			{
				$data['expires_on'] = Carbon::now()->addDays($membershipPlan->duration);
			}
		}
		else
		{
			$data['expires_on'] = null;
		}

		//membership plan id
		$data['membership_plan_id'] = $membershipPlanId;


		//updates user
		$user->update($data);
	}

}