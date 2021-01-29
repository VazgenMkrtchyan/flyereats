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

class SelCar extends Job
{
	public $inputData;

	
	public function __construct($inputData)
	{
		$this->inputData = $inputData;
	}


	public function handle(UserMailer $userMailer)
	{
		//sends email
		$userMailer->selCar($this->inputData);
	}

}