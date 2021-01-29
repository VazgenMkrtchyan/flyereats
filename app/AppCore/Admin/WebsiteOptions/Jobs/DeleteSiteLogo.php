<?php namespace App\AppCore\Admin\WebsiteOptions\Jobs;
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

use App\AppCore\Admin\WebsiteOptions\Repositories\WebConfigRepository;
use App\AppCore\Miscellaneous\Traits\LogosTrait;

class DeleteSiteLogo extends Job
{
	use LogosTrait;


	public function __construct()
	{
	}


	public function handle(WebConfigRepository $webConfigRepository)
	{
		$currentLogo = $webConfigRepository->currentLogo();

		//deletes file
		$this->deleteLogo($currentLogo, public_path('uploads/logos/'));

		//updates database
		$webConfigRepository->deleteLogo();
	}

}