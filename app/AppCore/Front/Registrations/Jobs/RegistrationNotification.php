<?php namespace App\AppCore\Front\Registrations\Jobs;
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
use App\AppCore\Front\Mailers\Jobs\SendWelcomeNotification;
use App\AppCore\Front\Mailers\Jobs\SendAccountVerificationToken;

class RegistrationNotification extends Job
{
	public $userEntity;


	public function __construct($userEntity)
	{
		$this->userEntity = $userEntity;
	}


	public function handle()
	{
		$userEntity = $this->userEntity;

		//sends welcome notification
		if (appCon()->email_welcome)
		{
			$this->dispatchNow(new SendWelcomeNotification($userEntity->id));
		}

		//if email confirmation is required, email token is being created and confirmation email sent
		if (appCon()->requireEmailConfirmation())
		{
			$token = $this->dispatchNow(new GenerateToken($userEntity->id, $userEntity->email));
			$this->dispatchNow(new SendAccountVerificationToken($userEntity->id, $token));
		}
	}

}