<?php namespace App\AppCore\Admin\Users\Jobs;
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

use App\AppCore\Admin\Mailers\Jobs\UserApprovedNotification;

class AfterUserApproval extends Job
{
	public $userEntity;


	function __construct($userEntity)
	{
		$this->userEntity = $userEntity;
	}


	public function handle()
	{
		$user = $this->userEntity;

		//sends mail
		if (appCon()->email_account_approved)
		{
			$this->dispatchNow(new UserApprovedNotification($user));
		}
	}

}