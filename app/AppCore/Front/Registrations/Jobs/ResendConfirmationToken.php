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
use App\AppCore\Front\Mailers\Jobs\SendAccountVerificationToken;
use App\AppCore\Front\Users\Repositories\UserFrontRepository;

class ResendConfirmationToken extends Job
{
	public $email;

	
	public function __construct($email)
	{
		$this->email = $email;
	}


	public function handle(UserFrontRepository $userFrontRepository)
	{
		$user = $userFrontRepository->findByEmail($this->email);

		if ($user)
		{
			if (! $user->emailConfirmed())
			{
				//creates new email confirmation token
				$token = $this->dispatchNow(new GenerateToken($user->id, $user->email));

				//sends email
				$this->dispatchNow(new SendAccountVerificationToken($user->id, $token));

				return ['response' => 'sent'];
			}
			else
			{
				return ['response' => 'email_is_confirmed'];
			}
		}

		return ['response' => 'user_not_found'];
	}

}