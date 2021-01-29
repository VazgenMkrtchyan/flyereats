<?php namespace App\AppCore\Front\CompanyProfiles\Jobs;
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

use App\AppCore\Front\CompanyProfiles\Repositories\CompanyProfileRepository;
use App\AppCore\Miscellaneous\Traits\LogosTrait;

class UploadCompanyLogo extends Job
{
	use LogosTrait;
	
	public $newLogo, $companyProfileId;

	
	public function __construct($newLogo, $companyProfileId)
	{
		$this->newLogo = $newLogo;
		$this->companyProfileId = $companyProfileId;
	}


	public function handle(CompanyProfileRepository $companyProfileRepository)
	{
		$companyProfileId = $this->companyProfileId;
		$newLogo = $this->newLogo;

		$response = $this->checkLogo($newLogo);

		if ($response == 'GOOD_TO_GO')
		{
			$currentLogo = $companyProfileRepository->currentLogo($companyProfileId);
			//deletes current file if exists
			if ($currentLogo)
			{
				$this->deleteLogo($currentLogo, public_path('uploads/logos/compprofiles/'), true);
			}

			//uploads logo image
			$fileName = $this->uploadLogo($newLogo, public_path('uploads/logos/compprofiles/'), null, true, true);
			//writes info to database
			$companyProfileRepository->uploadLogo($companyProfileId, $fileName);

			//returns response
			return responseData('success', 'logo_uploaded');
		}
		else return responseData('error', $response);
	}

}