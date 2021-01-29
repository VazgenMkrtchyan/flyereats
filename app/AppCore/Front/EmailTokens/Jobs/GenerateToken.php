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

class GenerateToken extends Job
{
	public $userId;
	public $email;

	public function __construct($userId, $email)
	{
		$this->userId = $userId;
		$this->email = $email;
	}


	public function handle(EmailTokenRepository $emailTokenRepository)
	{
		//random token
		$token = str_random(25);
		//creates record in database
		$emailTokenRepository->createToken($this->userId, $this->email, $token);

		return $token;
	}

}