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

class UploadSiteLogo extends Job
{
	use LogosTrait;

	public $newLogo;


	public function __construct($newLogo)
	{
		$this->newLogo = $newLogo;
	}


	public function handle(WebConfigRepository $webConfigRepository)
	{
		$newLogo = $this->newLogo;
		$currentLogo = $webConfigRepository->currentLogo();

		$response = $this->checkLogo($newLogo);

		if ($response == 'GOOD_TO_GO')
		{
			//deleting current file if exists
			if ($currentLogo)
			{
				$this->deleteLogo($currentLogo, public_path('/uploads/logos/'));
			}
			//uploading image
			$fileName = $this->uploadLogo($newLogo, public_path('uploads/logos/'));
			//writing info to database
			$webConfigRepository->uploadLogo($fileName);

			//returning response
			return responseData('success', 'logo_uploaded');
		}
		else return responseData('error', $response);

	}

}