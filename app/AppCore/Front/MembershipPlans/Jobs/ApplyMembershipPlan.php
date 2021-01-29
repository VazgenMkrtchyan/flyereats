<?php namespace App\AppCore\Front\MembershipPlans\Jobs;
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

use App\AppCore\Front\MembershipPlans\Repostitories\MembershipPlanRepository;

class ApplyMembershipPlan extends Job
{
	public $userId;
	public $membershipPlanId;

	
	public function __construct($userId, $membershipPlanId)
	{
		$this->userId = $userId;
		$this->membershipPlanId = $membershipPlanId;
	}


	public function handle(MembershipPlanRepository $membershipPlanRepository)
	{
		$userId = $this->userId;

		//applies membership plan settings
		$membershipPlanRepository->applyMembershipPlan($userId, $this->membershipPlanId);
	}

}