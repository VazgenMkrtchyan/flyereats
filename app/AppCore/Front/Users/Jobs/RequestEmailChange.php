<?php namespace App\AppCore\Front\Users\Jobs;
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

use App\AppCore\Front\EmailTokens\Jobs\GenerateToken;
use App\AppCore\Front\Mailers\Jobs\SendEmailChangeToken;
use App\AppCore\Front\Users\Jobs\UpdateEmail;


class RequestEmailChange extends Job
{
	public $userId;
	public $newEmail;


	public function __construct($userId, $newEmail)
	{
		$this->userId = $userId;
		$this->newEmail = $newEmail;
	}


	public function handle()
	{
		$userId = $this->userId;
		$newEmail = $this->newEmail;

		//checks if email confirmation is required
		if (appCon()->requireEmailConfirmation())
		{
			//creates token
			$token = $this->dispatchNow(new GenerateToken($userId, $newEmail));

			//sends email confirmation
			$this->dispatchNow(new SendEmailChangeToken($userId, $newEmail, $token));

			return 'PLEASE_CONFIRM';
		}

		else
		{
			$this->dispatchNow(new UpdateEmail($userId, $newEmail));

			return 'CHANGED';
		}
	}

}