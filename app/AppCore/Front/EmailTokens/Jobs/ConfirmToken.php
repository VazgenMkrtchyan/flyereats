<?php namespace App\AppCore\Front\EmailTokens\Jobs;
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

use App\AppCore\Front\EmailTokens\Repositories\EmailTokenRepository;

class ConfirmToken extends Job
{
	public $token;

	
	public function __construct($token)
	{
		$this->token = $token;
	}


	public function handle(EmailTokenRepository $emailTokenRepository)
	{
		$tokenObject = $emailTokenRepository->findToken($this->token);
		//returns token object if token is found and null if token is not found
		return $tokenObject;
	}

}