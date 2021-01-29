<?php namespace App\AppCore\Front\Mailers\Jobs;
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

use App\AppCore\Front\Mailers\UserMailer;
use App\AppCore\Front\Users\Repositories\UserFrontRepository;

class SendEmailChangeToken extends Job
{
	public $userId;
	public $newEmail;
	public $token;

	
	public function __construct($userId, $newEmail, $token)
	{
		$this->userId = $userId;
		$this->newEmail = $newEmail;
		$this->token = $token;
	}


	public function handle(UserMailer $userMailer, UserFrontRepository $repository)
	{
		//gets user entity
		$user = $repository->getById($this->userId);

		//sending confirmation email
		$userMailer->changeEmail($user, $this->newEmail, $this->token);
	}

}