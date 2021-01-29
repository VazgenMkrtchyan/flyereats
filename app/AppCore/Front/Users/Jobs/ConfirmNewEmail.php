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

use App\AppCore\Front\EmailTokens\Jobs\ConfirmToken;
use App\AppCore\Front\Users\Jobs\UpdateEmail;

class ConfirmNewEmail extends Job
{
	public $token;

	
	public function __construct($token)
	{
		$this->token = $token;
	}


	public function handle()
	{
		//checks if token exists
		$tokenObject = $this->dispatchNow(new ConfirmToken($this->token));

		//checks if given token is valid
		if ($tokenObject)
		{
			//updates user's email
			$this->dispatchNow(new UpdateEmail($tokenObject->user_id, $tokenObject->email));

			//removes token from database
			$tokenObject->delete();

			return true;
		}

		return false;
	}

}