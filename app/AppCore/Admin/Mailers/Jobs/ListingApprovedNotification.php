<?php namespace App\AppCore\Admin\Mailers\Jobs;
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

use App\AppCore\Admin\Mailers\UserMailer;

class ListingApprovedNotification extends Job
{
	public $listingEntity;

	
	public function __construct($listingEntity)
	{
		$this->listingEntity = $listingEntity;
	}


	public function handle(UserMailer $userMailer)
	{
		//sends notification
		$userMailer->listingApprovedNotification($this->listingEntity);
	}

}